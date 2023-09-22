<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2023 Yurii Kuznietsov, Taras Machyshyn, Oleksii Avramenko
 * Website: https://www.espocrm.com
 *
 * EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

namespace Espo\Core\FieldProcessing\PhoneNumber;

use Espo\Core\ORM\Repository\Option\SaveOption;
use Espo\Entities\PhoneNumber;
use Espo\Repositories\PhoneNumber as PhoneNumberRepository;

use Espo\ORM\Entity;
use Espo\ORM\EntityManager;
use Espo\ORM\Mapper\BaseMapper;

use Espo\Core\ApplicationState;
use Espo\Core\FieldProcessing\Saver as SaverInterface;
use Espo\Core\FieldProcessing\Saver\Params;
use Espo\Core\Utils\Metadata;

/**
 * @implements SaverInterface<Entity>
 */
class Saver implements SaverInterface
{
    public function __construct(
        private EntityManager $entityManager,
        private ApplicationState $applicationState,
        private AccessChecker $accessChecker,
        private Metadata $metadata
    ) {}

    public function process(Entity $entity, Params $params): void
    {
        $entityType = $entity->getEntityType();

        $defs = $this->entityManager->getDefs()->getEntity($entityType);

        if (!$defs->hasField('phoneNumber')) {
            return;
        }

        if ($defs->getField('phoneNumber')->getType() !== 'phone') {
            return;
        }

        $phoneNumberData = null;

        if ($entity->has('phoneNumberData')) {
            $phoneNumberData = $entity->get('phoneNumberData');
        }

        if ($phoneNumberData !== null) {
            $this->storeData($entity);

            return;
        }

        if ($entity->has('phoneNumber')) {
            $this->storePrimary($entity);

            return;
        }
    }

    private function storeData(Entity $entity): void
    {
        $phoneNumberValue = $entity->get('phoneNumber');

        if (is_string($phoneNumberValue)) {
            $phoneNumberValue = trim($phoneNumberValue);
        }

        $phoneNumberData = null;

        if ($entity->has('phoneNumberData')) {
            $phoneNumberData = $entity->get('phoneNumberData');
        }

        if (is_null($phoneNumberData)) {
            return;
        }

        if (!is_array($phoneNumberData)) {
            return;
        }

        $keyList = [];

        $keyPreviousList = [];

        $previousPhoneNumberData = [];

        if (!$entity->isNew()) {
            /** @var PhoneNumberRepository $repository */
            $repository = $this->entityManager->getRepository(PhoneNumber::ENTITY_TYPE);

            $previousPhoneNumberData = $repository->getPhoneNumberData($entity);
        }

        $hash = (object) [];
        $hashPrevious = (object) [];

        foreach ($phoneNumberData as $row) {
            $key = trim($row->phoneNumber);

            if (empty($key)) {
                continue;
            }

            if (isset($row->type)) {
                $type = $row->type;
            }
            else {
                $type = $this->metadata
                    ->get(['entityDefs', $entity->getEntityType(), 'fields', 'phoneNumber', 'defaultType']);
            }

            $hash->$key = [
                'primary' => !empty($row->primary) ? true : false,
                'type' => $type,
                'optOut' => !empty($row->optOut) ? true : false,
                'invalid' => !empty($row->invalid) ? true : false,
            ];

            $keyList[] = $key;
        }

        if (
            $entity->has('phoneNumberIsOptedOut') && (
                $entity->isNew() ||
                (
                    $entity->hasFetched('phoneNumberIsOptedOut') &&
                    $entity->get('phoneNumberIsOptedOut') !== $entity->getFetched('phoneNumberIsOptedOut')
                )
            ) &&
            $phoneNumberValue
        ) {
            $key = $phoneNumberValue;

            if (isset($hash->$key)) {
                $hash->{$key}['optOut'] = (bool) $entity->get('phoneNumberIsOptedOut');
            }
        }

        if (
            $entity->has('phoneNumberIsInvalid') && (
                $entity->isNew() ||
                (
                    $entity->hasFetched('phoneNumberIsInvalid') &&
                    $entity->get('phoneNumberIsInvalid') !== $entity->getFetched('phoneNumberIsInvalid')
                )
            ) &&
            $phoneNumberValue
        ) {
            $key = $phoneNumberValue;

            if (isset($hash->$key)) {
                $hash->{$key}['invalid'] = (bool) $entity->get('phoneNumberIsInvalid');
            }
        }

        foreach ($previousPhoneNumberData as $row) {
            $key = $row->phoneNumber;

            if (empty($key)) {
                continue;
            }

            $hashPrevious->$key = [
                'primary' => $row->primary ? true : false,
                'type' => $row->type,
                'optOut' => $row->optOut ? true : false,
                'invalid' => $row->invalid ? true : false,
            ];

            $keyPreviousList[] = $key;
        }

        $primary = false;

        $toCreateList = [];
        $toUpdateList = [];
        $toRemoveList = [];

        $revertData = [];

        foreach ($keyList as $key) {
            $data = $hash->$key;

            $new = true;
            $changed = false;

            if ($hash->{$key}['primary']) {
                $primary = $key;
            }

            if (property_exists($hashPrevious, $key)) {
                $new = false;

                $changed =
                    $hash->{$key}['type'] != $hashPrevious->{$key}['type'] ||
                    $hash->{$key}['optOut'] != $hashPrevious->{$key}['optOut'] ||
                    $hash->{$key}['invalid'] != $hashPrevious->{$key}['invalid'];

                if ($hash->{$key}['primary']) {
                    if ($hash->{$key}['primary'] == $hashPrevious->{$key}['primary']) {
                        $primary = false;
                    }
                }
            }

            if ($new) {
                $toCreateList[] = $key;
            }
            if ($changed) {
                $toUpdateList[] = $key;
            }
        }

        foreach ($keyPreviousList as $key) {
            if (!property_exists($hash, $key)) {
                $toRemoveList[] = $key;
            }
        }

        foreach ($toRemoveList as $number) {
            $phoneNumber = $this->getByNumber($number);

            if (!$phoneNumber) {
                continue;
            }

            $delete = $this->entityManager->getQueryBuilder()
                ->delete()
                ->from('EntityPhoneNumber')
                ->where([
                    'entityId' => $entity->getId(),
                    'entityType' => $entity->getEntityType(),
                    'phoneNumberId' => $phoneNumber->getId(),
                ])
                ->build();

            $this->entityManager->getQueryExecutor()->execute($delete);
        }

        foreach ($toUpdateList as $number) {
            $phoneNumber = $this->getByNumber($number);

            if ($phoneNumber) {
                $skipSave = $this->checkChangeIsForbidden($phoneNumber, $entity);

                if (!$skipSave) {
                    $phoneNumber->set([
                        'type' => $hash->{$number}['type'],
                        'optOut' => $hash->{$number}['optOut'],
                        'invalid' => $hash->{$number}['invalid'],
                    ]);

                    $this->entityManager->saveEntity($phoneNumber);
                }
                else {
                    $revertData[$number] = [
                        'type' => $phoneNumber->get('type'),
                        'optOut' => $phoneNumber->get('optOut'),
                        'invalid' => $phoneNumber->get('invalid'),
                    ];
                }
            }
        }

        foreach ($toCreateList as $number) {
            $phoneNumber = $this->getByNumber($number);

            if (!$phoneNumber) {
                $phoneNumber = $this->entityManager->getNewEntity(PhoneNumber::ENTITY_TYPE);

                $phoneNumber->set([
                    'name' => $number,
                    'type' => $hash->{$number}['type'],
                    'optOut' => $hash->{$number}['optOut'],
                    'invalid' => $hash->{$number}['invalid'],
                ]);

                $this->entityManager->saveEntity($phoneNumber);
            }
            else {
                $skipSave = $this->checkChangeIsForbidden($phoneNumber, $entity);

                if (!$skipSave) {
                    if (
                        $phoneNumber->get('type') != $hash->{$number}['type'] ||
                        $phoneNumber->get('optOut') != $hash->{$number}['optOut'] ||
                        $phoneNumber->get('invalid') != $hash->{$number}['invalid']
                    ) {
                        $phoneNumber->set([
                            'type' => $hash->{$number}['type'],
                            'optOut' => $hash->{$number}['optOut'],
                            'invalid' => $hash->{$number}['invalid'],
                        ]);

                        $this->entityManager->saveEntity($phoneNumber);
                    }
                }
                else {
                    $revertData[$number] = [
                        'type' => $phoneNumber->get('type'),
                        'optOut' => $phoneNumber->get('optOut'),
                        'invalid' => $phoneNumber->get('invalid'),
                    ];
                }
            }

            $entityPhoneNumber = $this->entityManager->getNewEntity('EntityPhoneNumber');

            $entityPhoneNumber->set([
                'entityId' => $entity->getId(),
                'entityType' => $entity->getEntityType(),
                'phoneNumberId' => $phoneNumber->getId(),
                'primary' => $number === $primary,
                'deleted' => false,
            ]);

            /** @var BaseMapper $mapper */
            $mapper = $this->entityManager->getMapper();

            $mapper->insertOnDuplicateUpdate($entityPhoneNumber, [
                'primary',
                'deleted',
            ]);
        }

        if ($primary) {
            $phoneNumber = $this->getByNumber($primary);

            if ($phoneNumber) {
                $update1 = $this->entityManager
                    ->getQueryBuilder()
                    ->update()
                    ->in('EntityPhoneNumber')
                    ->set(['primary' => false])
                    ->where([
                        'entityId' => $entity->getId(),
                        'entityType' => $entity->getEntityType(),
                        'primary' => true,
                        'deleted' => false,
                    ])
                    ->build();

                $this->entityManager->getQueryExecutor()->execute($update1);

                $update2 = $this->entityManager
                    ->getQueryBuilder()
                    ->update()
                    ->in('EntityPhoneNumber')
                    ->set(['primary' => true])
                    ->where([
                        'entityId' => $entity->getId(),
                        'entityType' => $entity->getEntityType(),
                        'phoneNumberId' => $phoneNumber->getId(),
                        'deleted' => false,
                    ])
                    ->build();

                $this->entityManager->getQueryExecutor()->execute($update2);
            }
        }

        if (!empty($revertData)) {
            foreach ($phoneNumberData as $row) {
                if (empty($revertData[$row->phoneNumber])) {
                    continue;
                }

                $row->type = $revertData[$row->phoneNumber]['type'];
                $row->optOut = $revertData[$row->phoneNumber]['optOut'];
                $row->invalid = $revertData[$row->phoneNumber]['invalid'];
            }

            $entity->set('phoneNumberData', $phoneNumberData);
        }
    }

    private function storePrimary(Entity $entity): void
    {
        if (!$entity->has('phoneNumber')) {
            return;
        }

        $phoneNumberValue = trim($entity->get('phoneNumber') ?? '');

        $entityRepository = $this->entityManager->getRDBRepository($entity->getEntityType());

        if (!empty($phoneNumberValue)) {
            if ($phoneNumberValue !== $entity->getFetched('phoneNumber')) {

                $phoneNumberNew = $this->entityManager
                    ->getRDBRepository(PhoneNumber::ENTITY_TYPE)
                    ->where([
                        'name' => $phoneNumberValue,
                    ])
                    ->findOne();

                if (!$phoneNumberNew) {
                    $phoneNumberNew = $this->entityManager->getNewEntity(PhoneNumber::ENTITY_TYPE);

                    $phoneNumberNew->set('name', $phoneNumberValue);

                    if ($entity->has('phoneNumberIsOptedOut')) {
                        $phoneNumberNew->set('optOut', (bool) $entity->get('phoneNumberIsOptedOut'));
                    }

                    if ($entity->has('phoneNumberIsInvalid')) {
                        $phoneNumberNew->set('invalid', (bool) $entity->get('phoneNumberIsInvalid'));
                    }

                    $defaultType = $this->metadata
                        ->get('entityDefs.' .  $entity->getEntityType() . '.fields.phoneNumber.defaultType');

                    $phoneNumberNew->set('type', $defaultType);

                    $this->entityManager->saveEntity($phoneNumberNew);
                }

                $phoneNumberValueOld = $entity->getFetched('phoneNumber');

                if (!empty($phoneNumberValueOld)) {
                    $phoneNumberOld = $this->getByNumber($phoneNumberValueOld);

                    if ($phoneNumberOld) {
                        $entityRepository
                            ->getRelation($entity, 'phoneNumbers')
                            ->unrelate($phoneNumberOld, [SaveOption::SKIP_HOOKS => true]);
                    }
                }

                $entityRepository
                    ->getRelation($entity, 'phoneNumbers')
                    ->relate($phoneNumberNew, null, [SaveOption::SKIP_HOOKS => true]);

                if ($entity->has('phoneNumberIsOptedOut')) {
                    $this->markNumberOptedOut($phoneNumberValue, (bool) $entity->get('phoneNumberIsOptedOut'));
                }

                if ($entity->has('phoneNumberIsInvalid')) {
                    $this->markNumberInvalid($phoneNumberValue, (bool) $entity->get('phoneNumberIsInvalid'));
                }

                $update = $this->entityManager
                    ->getQueryBuilder()
                    ->update()
                    ->in('EntityPhoneNumber')
                    ->set(['primary' => true])
                    ->where([
                        'entityId' => $entity->getId(),
                        'entityType' => $entity->getEntityType(),
                        'phoneNumberId' => $phoneNumberNew->getId(),
                    ])
                    ->build();

                $this->entityManager->getQueryExecutor()->execute($update);

                return;

            }

            if (
                $entity->has('phoneNumberIsOptedOut') &&
                (
                    $entity->isNew() ||
                    (
                        $entity->hasFetched('phoneNumberIsOptedOut') &&
                        $entity->get('phoneNumberIsOptedOut') !== $entity->getFetched('phoneNumberIsOptedOut')
                    )
                )
            ) {
                $this->markNumberOptedOut($phoneNumberValue, (bool) $entity->get('phoneNumberIsOptedOut'));
            }

            if (
                $entity->has('phoneNumberIsInvalid') &&
                (
                    $entity->isNew() ||
                    (
                        $entity->hasFetched('phoneNumberIsInvalid') &&
                        $entity->get('phoneNumberIsInvalid') !== $entity->getFetched('phoneNumberIsInvalid')
                    )
                )
            ) {
                $this->markNumberInvalid($phoneNumberValue, (bool) $entity->get('phoneNumberIsInvalid'));
            }

            return;
        }

        $phoneNumberValueOld = $entity->getFetched('phoneNumber');

        if (!empty($phoneNumberValueOld)) {
            $phoneNumberOld = $this->getByNumber($phoneNumberValueOld);

            if ($phoneNumberOld) {
                $entityRepository
                    ->getRelation($entity, 'phoneNumbers')
                    ->unrelate($phoneNumberOld, [SaveOption::SKIP_HOOKS => true]);
            }
        }
    }

    private function getByNumber(string $number): ?PhoneNumber
    {
        /** @var PhoneNumberRepository $repository */
        $repository = $this->entityManager->getRepository(PhoneNumber::ENTITY_TYPE);

        return $repository->getByNumber($number);
    }

    private function markNumberOptedOut(string $number, bool $isOptedOut = true): void
    {
        /** @var PhoneNumberRepository $repository */
        $repository = $this->entityManager->getRepository(PhoneNumber::ENTITY_TYPE);

        $repository->markNumberOptedOut($number, $isOptedOut);
    }

    private function markNumberInvalid(string $number, bool $isInvalid = true): void
    {
        /** @var PhoneNumberRepository $repository */
        $repository = $this->entityManager->getRepository(PhoneNumber::ENTITY_TYPE);

        $repository->markNumberInvalid($number, $isInvalid);
    }

    private function checkChangeIsForbidden(PhoneNumber $phoneNumber, Entity $entity): bool
    {
        if (!$this->applicationState->hasUser()) {
            return true;
        }

        $user = $this->applicationState->getUser();

        // @todo Check if not modified by system.

        return !$this->accessChecker->checkEdit($user, $phoneNumber, $entity);
    }
}
