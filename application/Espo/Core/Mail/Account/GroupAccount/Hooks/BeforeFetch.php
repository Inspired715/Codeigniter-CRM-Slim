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

namespace Espo\Core\Mail\Account\GroupAccount\Hooks;

use Espo\Core\Mail\Account\Hook\BeforeFetch as BeforeFetchInterface;
use Espo\Core\Mail\Account\Hook\BeforeFetchResult;
use Espo\Core\Mail\Account\Account;
use Espo\Core\Mail\Message;
use Espo\Core\Mail\Account\GroupAccount\BouncedRecognizer;
use Espo\Core\Utils\Log;
use Espo\Entities\EmailAddress;
use Espo\ORM\EntityManager;
use Espo\Repositories\EmailAddress as EmailAddressRepository;
use Espo\Modules\Crm\Entities\MassEmail;
use Espo\Modules\Crm\Entities\EmailQueueItem;
use Espo\Modules\Crm\Tools\Campaign\LogService as CampaignService;

use Throwable;

class BeforeFetch implements BeforeFetchInterface
{
    private Log $log;
    private EntityManager $entityManager;
    private BouncedRecognizer $bouncedRecognizer;
    private CampaignService $campaignService;

    public function __construct(
        Log $log,
        EntityManager $entityManager,
        BouncedRecognizer $bouncedRecognizer,
        CampaignService $campaignService
    ) {
        $this->log = $log;
        $this->entityManager = $entityManager;
        $this->bouncedRecognizer = $bouncedRecognizer;
        $this->campaignService = $campaignService;
    }

    public function process(Account $account, Message $message): BeforeFetchResult
    {
        if ($this->bouncedRecognizer->isBounced($message)) {
            try {
                $toSkip = $this->processBounced($message);
            }
            catch (Throwable $e) {
                $this->log->error(
                    'InboundEmail ' . $account->getId() . ' ' .
                    'Process Bounced Message; ' . $e->getCode() . ' ' . $e->getMessage()
                );

                return BeforeFetchResult::create()->withToSkip();
            }

            if ($toSkip) {
                return BeforeFetchResult::create()->withToSkip();
            }
        }

        return BeforeFetchResult::create()
            ->with('skipAutoReply', $this->checkMessageCannotBeAutoReplied($message))
            ->with('isAutoReply', $this->checkMessageIsAutoReply($message));
    }

    private function processBounced(Message $message): bool
    {
        $isHard = $this->bouncedRecognizer->isHard($message);
        $queueItemId = $this->bouncedRecognizer->extractQueueItemId($message);

        if (!$queueItemId) {
            return false;
        }

        /** @var ?EmailQueueItem $queueItem */
        $queueItem = $this->entityManager->getEntityById(EmailQueueItem::ENTITY_TYPE, $queueItemId);

        if (!$queueItem) {
            return false;
        }

        $massEmail = null;
        $campaignId = null;
        $massEmailId = $queueItem->getMassEmailId();

        if ($massEmailId) {
            /** @var ?MassEmail $massEmail */
            $massEmail = $this->entityManager->getEntityById(MassEmail::ENTITY_TYPE, $massEmailId);
        }

        if ($massEmail) {
            $campaignId = $massEmail->getCampaignId();
        }

        $emailAddress = $queueItem->getEmailAddress();

        if (!$emailAddress) {
            return true;
        }

        /** @var EmailAddressRepository $emailAddressRepository */
        $emailAddressRepository = $this->entityManager->getRepository(EmailAddress::ENTITY_TYPE);

        if ($isHard) {
            $emailAddressEntity = $emailAddressRepository->getByAddress($emailAddress);

            if ($emailAddressEntity) {
                $emailAddressEntity->set('invalid', true);

                $this->entityManager->saveEntity($emailAddressEntity);
            }
        }

        $targetType = $queueItem->getTargetType();
        $targetId = $queueItem->getTargetId();

        $target = $this->entityManager->getEntityById($targetType, $targetId);

        if ($campaignId && $target) {
            $this->campaignService->logBounced($campaignId, $queueItem, $isHard);
        }

        return true;
    }

    private function checkMessageIsAutoReply(Message $message): bool
    {
        if ($message->getHeader('X-Autoreply')) {
            return true;
        }

        if ($message->getHeader('X-Autorespond')) {
            return true;
        }

        if (
            $message->getHeader('Auto-submitted') &&
            strtolower($message->getHeader('Auto-submitted')) !== 'no'
        ) {
            return true;
        }

        return false;
    }

    private function checkMessageCannotBeAutoReplied(Message $message): bool
    {
        if ($message->getHeader('X-Auto-Response-Suppress') === 'AutoReply') {
            return true;
        }

        if ($message->getHeader('X-Auto-Response-Suppress') === 'All') {
            return true;
        }

        if ($this->checkMessageIsAutoReply($message)) {
            return true;
        }

        return false;
    }
}
