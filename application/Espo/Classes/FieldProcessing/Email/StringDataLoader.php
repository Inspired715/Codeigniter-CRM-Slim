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

namespace Espo\Classes\FieldProcessing\Email;

use Espo\ORM\Entity;
use Espo\Repositories\EmailAddress as EmailAddressRepository;
use Espo\Core\FieldProcessing\Loader;
use Espo\Core\FieldProcessing\Loader\Params;
use Espo\Core\ORM\EntityManager;
use Espo\Entities\Email;
use Espo\Entities\User;

/**
 * @implements Loader<Email>
 */
class StringDataLoader implements Loader
{
    private EntityManager $entityManager;
    private User $user;

    /** @var array<string, string> */
    private $fromEmailAddressNameCache = [];

    public function __construct(EntityManager $entityManager, User $user)
    {
        $this->entityManager = $entityManager;
        $this->user = $user;
    }

    public function process(Entity $entity, Params $params): void
    {
        /** @var Email $entity */

        $userEmailAddressIdList = [];

        $emailAddressCollection = $this->entityManager
            ->getRDBRepository(User::ENTITY_TYPE)
            ->getRelation($this->user, 'emailAddresses')
            ->select(['id'])
            ->find();

        foreach ($emailAddressCollection as $emailAddress) {
            $userEmailAddressIdList[] = $emailAddress->getId();
        }

        if (
            in_array($entity->get('fromEmailAddressId'), $userEmailAddressIdList) ||
            $entity->get('createdById') === $this->user->getId() &&
            $entity->getStatus() === Email::STATUS_SENT
        ) {
            $entity->loadLinkMultipleField('toEmailAddresses');

            $idList = $entity->get('toEmailAddressesIds');
            $names = $entity->get('toEmailAddressesNames');

            if (empty($idList)) {
                return;
            }

            $list = [];

            foreach ($idList as $emailAddressId) {
                $person = $this->getEmailAddressRepository()->getEntityByAddressId($emailAddressId, null, true);

                $list[] = $person ? $person->get('name') : $names->$emailAddressId;
            }

            $entity->set('personStringData', 'To: ' . implode(', ', $list));

            return;
        }

        /**  @var ?string $fromEmailAddressId */
        $fromEmailAddressId = $entity->get('fromEmailAddressId');

        if (!$fromEmailAddressId) {
            return;
        }

        if (!array_key_exists($fromEmailAddressId, $this->fromEmailAddressNameCache)) {
            $person = $this->getEmailAddressRepository()->getEntityByAddressId($fromEmailAddressId, null, true);

            $fromName = $person?->get('name');

            $this->fromEmailAddressNameCache[$fromEmailAddressId] = $fromName;
        }

        $fromName =
            $this->fromEmailAddressNameCache[$fromEmailAddressId] ??
            $entity->get('fromName') ??
            $entity->get('fromEmailAddressName');

        $entity->set('personStringData', $fromName);
    }

    private function getEmailAddressRepository(): EmailAddressRepository
    {
        /** @var EmailAddressRepository */
        return $this->entityManager->getRepository('EmailAddress');
    }
}
