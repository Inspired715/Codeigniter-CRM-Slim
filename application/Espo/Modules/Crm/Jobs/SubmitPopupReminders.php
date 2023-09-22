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

namespace Espo\Modules\Crm\Jobs;

use Espo\Core\ORM\Entity as CoreEntity;
use Espo\Modules\Crm\Entities\Meeting;
use Espo\Modules\Crm\Entities\Reminder;
use Espo\Core\Job\JobDataLess;
use Espo\Core\ORM\EntityManager;
use Espo\Core\Utils\Config;
use Espo\Core\Utils\DateTime as DateTimeUtil;
use Espo\Core\Utils\Log;
use Espo\Core\WebSocket\Submission as WebSocketSubmission;

use Throwable;
use DateTime;

class SubmitPopupReminders implements JobDataLess
{
    private const REMINDER_PAST_HOURS = 24;

    public function __construct(
        private EntityManager $entityManager,
        private Config $config,
        private WebSocketSubmission $webSocketSubmission,
        private Log $log
    ) {}

    public function run(): void
    {
        if (!$this->config->get('useWebSocket')) {
            return;
        }

        $dt = new DateTime();
        $now = $dt->format(DateTimeUtil::SYSTEM_DATE_TIME_FORMAT);

        $pastHours = $this->config->get('reminderPastHours', self::REMINDER_PAST_HOURS);

        $nowShifted = $dt
            ->modify('-' . $pastHours . ' hours')
            ->format(DateTimeUtil::SYSTEM_DATE_TIME_FORMAT);

        $reminderList = $this->entityManager
            ->getRDBRepository(Reminder::ENTITY_TYPE)
            ->where([
                'type' => Reminder::TYPE_POPUP,
                'remindAt<=' => $now,
                'startAt>' => $nowShifted,
                'isSubmitted' => false,
            ])
            ->find();

        $submitData = [];

        foreach ($reminderList as $reminder) {
            $userId = $reminder->getUserId();
            $entityType = $reminder->getTargetEntityType();
            $entityId = $reminder->getTargetEntityId();

            if (
                !$userId ||
                !$entityType ||
                !$entityId ||
                !$this->entityManager->hasRepository($entityType)
            ) {
                $this->deleteReminder($reminder);

                continue;
            }

            $entity = $this->entityManager->getEntityById($entityType, $entityId);

            if (!$entity) {
                $this->deleteReminder($reminder);

                continue;
            }

            if (
                $entity instanceof CoreEntity &&
                $entity->hasLinkMultipleField('users')
            ) {
                $entity->loadLinkMultipleField('users', ['status' => 'acceptanceStatus']);

                $status = $entity->getLinkMultipleColumn('users', 'status', $userId);

                if ($status === Meeting::ATTENDEE_STATUS_DECLINED) {
                    $this->deleteReminder($reminder);

                    continue;
                }
            }

            $dateAttribute = 'dateStart';

            $entityDefs = $this->entityManager->getDefs()->getEntity($entityType);

            if ($entityDefs->hasField('reminders')) {
                $dateAttribute = $entityDefs
                    ->getField('reminders')
                    ->getParam('dateField') ?? $dateAttribute;
            }

            $submitData[$userId] ??= [];

            $submitData[$userId][] = [
                'id' => $reminder->getId(),
                'data' => (object) [
                    'id' => $entity->getId(),
                    'entityType' => $entityType,
                    $dateAttribute => $entity->get($dateAttribute),
                    'name' => $entity->get('name'),
                ],
            ];;

            $reminder->set('isSubmitted', true);
            $this->entityManager->saveEntity($reminder);
        }

        foreach ($submitData as $userId => $list) {
            try {
                $this->webSocketSubmission
                    ->submit('popupNotifications.event', $userId, (object) ['list' => $list]);
            }
            catch (Throwable $e) {
                $this->log->error('Job SubmitPopupReminders: [' . $e->getCode() . '] ' .$e->getMessage());
            }
        }
    }

    private function deleteReminder(Reminder $reminder): void
    {
        $this->entityManager
            ->getRDBRepository(Reminder::ENTITY_TYPE)
            ->deleteFromDb($reminder->getId());
    }
}
