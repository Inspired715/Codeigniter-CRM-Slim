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

namespace Espo\Tools\LeadCapture;

use Espo\Core\Job\JobSchedulerFactory;
use Espo\Core\Exceptions\BadRequest;
use Espo\Core\Exceptions\Error;
use Espo\Core\Exceptions\NotFound;
use Espo\Core\FieldValidation\FieldValidationManager;
use Espo\Core\FieldValidation\FieldValidationParams;
use Espo\Core\HookManager;
use Espo\Core\Job\QueueName;
use Espo\Core\ORM\EntityManager;
use Espo\Core\Utils\DateTime as DateTimeUtil;
use Espo\Core\Utils\FieldUtil;
use Espo\Core\Utils\Language;
use Espo\Core\Utils\Log;
use Espo\ORM\Entity;
use Espo\Entities\UniqueId;
use Espo\Entities\LeadCapture as LeadCaptureEntity;
use Espo\Entities\LeadCaptureLogRecord;
use Espo\Modules\Crm\Entities\Campaign;
use Espo\Modules\Crm\Entities\TargetList;
use Espo\Modules\Crm\Tools\Campaign\LogService as CampaignService;
use Espo\Modules\Crm\Entities\Contact;
use Espo\Modules\Crm\Entities\Lead;
use Espo\Tools\LeadCapture\Jobs\OptInConfirmation;
use stdClass;
use DateTime;

class CaptureService
{
    private EntityManager $entityManager;
    private FieldUtil $fieldUtil;
    private Language $defaultLanguage;
    private HookManager $hookManager;
    private Log $log;

    private FieldValidationManager $fieldValidationManager;
    private JobSchedulerFactory $jobSchedulerFactory;
    private CampaignService $campaignService;

    public function __construct(
        EntityManager $entityManager,
        FieldUtil $fieldUtil,
        Language $defaultLanguage,
        HookManager $hookManager,
        Log $log,
        FieldValidationManager $fieldValidationManager,
        JobSchedulerFactory $jobSchedulerFactory,
        CampaignService $campaignService
    ) {
        $this->entityManager = $entityManager;
        $this->fieldUtil = $fieldUtil;
        $this->defaultLanguage = $defaultLanguage;
        $this->hookManager = $hookManager;
        $this->log = $log;
        $this->fieldValidationManager = $fieldValidationManager;
        $this->jobSchedulerFactory = $jobSchedulerFactory;
        $this->campaignService = $campaignService;
    }

    /**
     * Capture a lead. A main entry method.
     *
     * @param string $apiKey An API key.
     * @param stdClass $data A payload.
     * @throws BadRequest
     * @throws Error
     * @throws NotFound
     */
    public function capture(string $apiKey, stdClass $data): void
    {
        /** @var ?LeadCaptureEntity $leadCapture */
        $leadCapture = $this->entityManager
            ->getRDBRepositoryByClass(LeadCaptureEntity::class)
            ->where([
                'apiKey' => $apiKey,
                'isActive' => true,
            ])
            ->findOne();

        if (!$leadCapture) {
            throw new NotFound('Api key is not valid.');
        }

        if (!$leadCapture->optInConfirmation()) {
            $this->proceed($leadCapture, $data);

            return;
        }

        if (empty($data->emailAddress)) {
            throw new Error('LeadCapture: No emailAddress passed in the payload.');
        }

        if (!$leadCapture->getOptInConfirmationEmailTemplateId()) {
            throw new Error('LeadCapture: No optInConfirmationEmailTemplate specified.');
        }

        $lead = $this->getLeadWithPopulatedData($leadCapture, $data);

        $target = $lead;

        $duplicateData = $this->findLeadDuplicates($leadCapture, $lead);

        if ($duplicateData['lead']) {
            $target = $duplicateData['lead'];
        }

        if ($duplicateData['contact']) {
            $target = $duplicateData['contact'];
        }

        $hasDuplicate = $duplicateData['lead'] || $duplicateData['contact'];

        $isLogged = false;

        if ($hasDuplicate) {
            $this->log($leadCapture, $target, $data, false);

            $isLogged = true;

            $targetListId = $leadCapture->getTargetListId();

            if ($leadCapture->skipOptInConfirmationIfSubscribed() && $targetListId) {
                $isAlreadyOptedIn = $this->isTargetOptedIn($target, $targetListId);

                if ($isAlreadyOptedIn) {
                    $this->log->debug("LeadCapture: Already opted in. Skipped.");

                    return;
                }
            }
        }

        if ($leadCapture->createLeadBeforeOptInConfirmation() && !$hasDuplicate) {
            $this->entityManager->saveEntity($lead);

            $this->log($leadCapture, $target, $data, true);

            $isLogged = true;
        }

        $lifetime = $leadCapture->getOptInConfirmationLifetime();

        if (!$lifetime) {
            $lifetime = 100;
        }

        $dt = new DateTime();

        $dt->modify('+' . $lifetime . ' hours');

        $terminateAt = $dt->format(DateTimeUtil::SYSTEM_DATE_TIME_FORMAT);

        /** @var UniqueId $uniqueId */
        $uniqueId = $this->entityManager->getNewEntity(UniqueId::ENTITY_TYPE);

        $uniqueId->set([
            'terminateAt' => $terminateAt,
            'data' => (object) [
                'leadCaptureId' => $leadCapture->getId(),
                'data' => $data,
                'leadId' => $lead->hasId() ? $lead->getId() : null,
                'isLogged' => $isLogged,
            ],
        ]);

        $this->entityManager->saveEntity($uniqueId);

        $this->jobSchedulerFactory
            ->create()
            ->setClassName(OptInConfirmation::class)
            ->setData([
                'id' => $uniqueId->getIdValue(),
            ])
            ->setQueue(QueueName::E0)
            ->schedule();
    }

    /**
     * @throws BadRequest
     * @throws NotFound
     * @throws Error
     */
    protected function proceed(
        LeadCaptureEntity $leadCapture,
        stdClass $data,
        ?string $leadId = null,
        bool $isLogged = false
    ): void {

        if ($leadId) {
            /** @var ?Lead $lead */
            $lead = $this->entityManager->getEntityById(Lead::ENTITY_TYPE, $leadId);

            if (!$lead) {
                throw new NotFound("Lead '{$leadId}' not found.");
            }
        }
        else {
            $lead = $this->getLeadWithPopulatedData($leadCapture, $data);
        }

        $campaign = null;

        /** @var ?string $campaignId */
        $campaignId = $leadCapture->getCampaignId();

        if ($campaignId) {
            $campaign = $this->entityManager->getEntityById(Campaign::ENTITY_TYPE, $campaignId);
        }

        $toRelateLead = false;

        $target = $lead;

        $duplicateData = $this->findLeadDuplicates($leadCapture, $lead);

        $duplicate = $duplicateData['lead'];
        $contact = $duplicateData['contact'];

        $targetLead = $duplicateData['lead'] ?? $lead;

        if ($contact) {
            assert($contact instanceof Contact);

            $target = $contact;
        }

        if ($duplicate) {
            assert($duplicate instanceof Lead);

            $lead = $duplicate;

            if (!$contact) {
                $target = $lead;
            }
        }

        $isContactOptedIn = false;

        $targetListId = $leadCapture->getTargetListId();

        if ($leadCapture->subscribeToTargetList() && $targetListId) {
            $isAlreadyOptedIn = false;

            if ($contact && $leadCapture->subscribeContactToTargetList()) {
                $isAlreadyOptedIn = $this->isTargetOptedIn($contact, $targetListId);

                $isContactOptedIn = $isAlreadyOptedIn;

                if (!$isAlreadyOptedIn) {
                    $this->entityManager
                        ->getRDBRepository(Contact::ENTITY_TYPE)
                        ->getRelation($contact, 'targetLists')
                        ->relateById($targetListId, ['optedOut' => false]);

                    $isAlreadyOptedIn = true;

                    if ($campaign) {
                        $this->campaignService->logOptedIn($campaign->getId(), null, $contact);
                    }

                    $targetList = $this->entityManager->getEntityById(TargetList::ENTITY_TYPE, $targetListId);

                    if ($targetList) {
                        $this->hookManager->process(TargetList::ENTITY_TYPE, 'afterOptIn', $targetList, [], [
                           'link' => 'contacts',
                           'targetId' => $contact->getId(),
                           'targetType' => Contact::ENTITY_TYPE,
                           'leadCaptureId' => $leadCapture->getId(),
                        ]);
                    }
                }
            }

            if (!$isAlreadyOptedIn) {
                if ($targetLead->isNew()) {
                    $toRelateLead = true;
                }
                else {
                    $isAlreadyOptedIn = $this->isTargetOptedIn($targetLead, $targetListId);

                    if (!$isAlreadyOptedIn) {
                        $toRelateLead = true;
                    }
                }
            }
        }

        if (
            $contact &&
            (!$isContactOptedIn || !$leadCapture->subscribeToTargetList()) &&
            $leadCapture->subscribeContactToTargetList()
        ) {
            $this->hookManager->process(LeadCaptureEntity::ENTITY_TYPE, 'afterLeadCapture', $leadCapture, [], [
               'targetId' => $contact->getId(),
               'targetType' => Contact::ENTITY_TYPE,
            ]);

            $this->hookManager->process(Contact::ENTITY_TYPE, 'afterLeadCapture', $contact, [], [
               'leadCaptureId' => $leadCapture->getId(),
            ]);
        }

        $isNew = !$duplicate && !$contact;

        if (!$contact || !$leadCapture->subscribeContactToTargetList()) {
            $targetTeamId = $leadCapture->getTargetTeamId();

            if ($targetTeamId) {
                $lead->addLinkMultipleId('teams', $targetTeamId);
            }

            $this->entityManager->saveEntity($lead);

            if (!$duplicate && $campaign) {
                $this->campaignService->logLeadCreated($campaign->getId(), $lead);
            }
        }

        if ($toRelateLead && $targetLead->hasId() && $targetListId) {
            $this->entityManager
                ->getRDBRepository(Lead::ENTITY_TYPE)
                ->getRelation($targetLead, 'targetLists')
                ->relateById($targetListId, ['optedOut' => false]);

            if ($campaign) {
                $this->campaignService->logOptedIn($campaign->getId(), null, $targetLead);
            }

            $targetList = $this->entityManager->getEntityById(TargetList::ENTITY_TYPE, $targetListId);

            if ($targetList) {
                $this->hookManager->process(TargetList::ENTITY_TYPE, 'afterOptIn', $targetList, [], [
                   'link' => 'leads',
                   'targetId' => $targetLead->getId(),
                   'targetType' => Lead::ENTITY_TYPE,
                   'leadCaptureId' => $leadCapture->getId(),
                ]);
            }
        }

        if ($toRelateLead  || !$leadCapture->subscribeToTargetList()) {
            $this->hookManager->process(
                LeadCaptureEntity::ENTITY_TYPE,
                'afterLeadCapture',
                $leadCapture,
                [],
                [
                   'targetId' => $targetLead->getId(),
                   'targetType' => Lead::ENTITY_TYPE,
                ]
            );

            $this->hookManager->process(
                Lead::ENTITY_TYPE,
                'afterLeadCapture',
                $targetLead,
                [],
                [
                   'leadCaptureId' => $leadCapture->getId(),
                ]
            );
        }

        if (!$isLogged) {
            $this->log($leadCapture, $target, $data, $isNew);
        }
    }

    /**
     * Confirm opt-in.
     *
     * @throws BadRequest
     * @throws Error
     * @throws NotFound
     * @param string $id A unique ID.
     */
    public function confirmOptIn(string $id): ConfirmResult
    {
        /** @var ?UniqueId $uniqueId */
        $uniqueId = $this->entityManager
            ->getRDBRepository(UniqueId::ENTITY_TYPE)
            ->where(['name' => $id])
            ->findOne();

        if (!$uniqueId) {
            throw new NotFound("LeadCapture Confirm: UniqueId not found.");
        }

        $uniqueIdData = $uniqueId->getData();

        if (empty($uniqueIdData->data)) {
            throw new Error("LeadCapture Confirm: data not found.");
        }

        if (empty($uniqueIdData->leadCaptureId)) {
            throw new Error("LeadCapture Confirm: leadCaptureId not found.");
        }

        $data = $uniqueIdData->data;
        $leadCaptureId = $uniqueIdData->leadCaptureId;
        $leadId = $uniqueIdData->leadId ?? null;
        $isLogged = $uniqueIdData->isLogged ?? false;

        $terminateAt = $uniqueId->getTerminateAt();

        if ($terminateAt && time() > strtotime($terminateAt->getString())) {
            return new ConfirmResult(
                ConfirmResult::STATUS_EXPIRED,
                $this->defaultLanguage
                    ->translateLabel('optInConfirmationExpired', 'messages', LeadCaptureEntity::ENTITY_TYPE)
            );
        }

        /** @var ?LeadCaptureEntity $leadCapture */
        $leadCapture = $this->entityManager->getEntityById(LeadCaptureEntity::ENTITY_TYPE, $leadCaptureId);

        if (!$leadCapture) {
            throw new Error("LeadCapture Confirm: LeadCapture not found.");
        }

        if (empty($uniqueIdData->isProcessed)) {
            $this->proceed($leadCapture, $data, $leadId, $isLogged);

            $uniqueIdData->isProcessed = true;

            $uniqueId->set('data', $uniqueIdData);

            $this->entityManager->saveEntity($uniqueId);
        }

        return new ConfirmResult(
            ConfirmResult::STATUS_SUCCESS,
            $leadCapture->getOptInConfirmationSuccessMessage(),
            $leadCapture->getId(),
            $leadCapture->getName()
        );
    }

    /**
     * @throws BadRequest
     * @throws Error
     */
    protected function getLeadWithPopulatedData(LeadCaptureEntity $leadCapture, stdClass $data): Lead
    {
        /** @var Lead $lead */
        $lead = $this->entityManager->getNewEntity(Lead::ENTITY_TYPE);

        $fieldList = $leadCapture->getFieldList();

        if ($fieldList === []) {
            throw new Error('No field list specified.');
        }

        $isEmpty = true;

        foreach ($fieldList as $field) {
            if ($field === 'name') {
                if (property_exists($data, 'name') && $data->name) {
                    $value = trim($data->name);

                    $parts = explode(' ', $value);

                    $lastName = array_pop($parts);
                    $firstName = implode(' ', $parts);

                    $lead->set('firstName', $firstName);
                    $lead->set('lastName', $lastName);

                    $isEmpty = false;
                }

                continue;
            }

            $attributeList = $this->fieldUtil->getActualAttributeList(Lead::ENTITY_TYPE, $field);

            if (empty($attributeList)) {
                continue;
            }

            foreach ($attributeList as $attribute) {
                if (!property_exists($data, $attribute)) {
                    continue;
                }

                $lead->set($attribute, $data->$attribute);

                if (!empty($data->$attribute)) {
                    $isEmpty = false;
                }
            }
        }

        if ($isEmpty) {
            throw new BadRequest('noRequiredFields');
        }

        if ($leadCapture->getLeadSource()) {
            $lead->set('source', $leadCapture->getLeadSource());
        }

        if ($leadCapture->getCampaignId()) {
            $lead->set('campaignId', $leadCapture->getCampaignId());
        }

        $teamId = $leadCapture->getTargetTeamId();

        if ($teamId) {
            $lead->addLinkMultipleId('teams', $teamId);
        }

        // Skipping the 'required' validation.
        $validationParams = FieldValidationParams::create()->withTypeSkipFieldList('required', $fieldList);

        $this->fieldValidationManager->process($lead, $data, $validationParams);

        return $lead;
    }

    /**
     * @return array{
     *   contact: ?Contact,
     *   lead: ?Lead,
     * }
     */
    protected function findLeadDuplicates(LeadCaptureEntity $leadCapture, Lead $lead): array
    {
        $duplicate = null;
        $contact = null;

        $emailAddress = $lead->getEmailAddress();
        $phoneNumber = $lead->getPhoneNumber();

        if ($emailAddress || $phoneNumber) {
            $groupOr = [];

            if ($emailAddress) {
                $groupOr['emailAddress'] = $emailAddress;
            }

            if ($phoneNumber) {
                $groupOr['phoneNumber'] = $phoneNumber;
            }

            if ($lead->isNew() && $leadCapture->duplicateCheck()) {
                $duplicate = $this->entityManager
                    ->getRDBRepository(Lead::ENTITY_TYPE)
                    ->where(['OR' => $groupOr])
                    ->findOne();
            }

            if ($leadCapture->subscribeToTargetList() && $leadCapture->subscribeContactToTargetList()) {
                $contact = $this->entityManager
                    ->getRDBRepository(Contact::ENTITY_TYPE)
                    ->where(['OR' => $groupOr])
                    ->findOne();
            }
        }

        return [
            'contact' => $contact,
            'lead' => $duplicate,
        ];
    }

    protected function isTargetOptedIn(Entity $target, string $targetListId): bool
    {
        $targetList = $this->entityManager->getEntityById(TargetList::ENTITY_TYPE, $targetListId);

        if (!$targetList) {
            return false;
        }

        $isAlreadyOptedIn = $this->entityManager
            ->getRDBRepository($target->getEntityType())
            ->getRelation($target, 'targetLists')
            ->isRelated($targetList);

        if (!$isAlreadyOptedIn) {
            return false;
        }

        $link = null;

        if ($target->getEntityType() === Contact::ENTITY_TYPE) {
            $link = 'contacts';
        }

        if ($target->getEntityType() === Lead::ENTITY_TYPE) {
            $link = 'leads';
        }

        if (!$link) {
            return false;
        }

        $targetFound = $this->entityManager
            ->getRDBRepository(TargetList::ENTITY_TYPE)
            ->getRelation($targetList, $link)
            ->where([
                'id' => $target->getId(),
            ])
            ->findOne();

        if ($targetFound && $targetFound->get('targetListIsOptedOut')) {
            return false;
        }

        return true;
    }

    protected function log(
        LeadCaptureEntity $leadCapture,
        Entity $target,
        stdClass $data,
        bool $isNew = true
    ): void {

        $logRecord = $this->entityManager->getNewEntity(LeadCaptureLogRecord::ENTITY_TYPE);

        $logRecord->set([
            'targetId' => $target->hasId() ? $target->getId() : null,
            'targetType' => $target->getEntityType(),
            'leadCaptureId' => $leadCapture->getId(),
            'isCreated' => $isNew,
            'data' => $data,
        ]);

        if (!empty($data->description)) {
            $logRecord->set('description', $data->description);
        }

        $this->entityManager->saveEntity($logRecord);
    }
}
