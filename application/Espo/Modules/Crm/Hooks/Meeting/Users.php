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

namespace Espo\Modules\Crm\Hooks\Meeting;

use Espo\Core\Hook\Hook\BeforeSave;
use Espo\Core\ORM\Entity as CoreEntity;
use Espo\Core\Utils\Config;
use Espo\Entities\User;
use Espo\Modules\Crm\Entities\Meeting;
use Espo\ORM\Entity;
use Espo\ORM\Repository\Option\SaveOptions;

/**
 * @implements BeforeSave<CoreEntity>
 */
class Users implements BeforeSave
{
    public static int $order = 12;

    public function __construct(
        private Config $config,
        private User $user
    ) {}

    /**
     * @param CoreEntity $entity
     */
    public function beforeSave(Entity $entity, SaveOptions $options): void
    {
        if (!$this->config->get('eventAssignedUserIsAttendeeDisabled')) {
            if ($entity->hasLinkMultipleField('assignedUsers')) {
                $assignedUserIdList = $entity->getLinkMultipleIdList('assignedUsers');

                foreach ($assignedUserIdList as $assignedUserId) {
                    $entity->addLinkMultipleId('users', $assignedUserId);
                    $entity->setLinkMultipleName(
                        'users',
                        $assignedUserId,
                        $entity->getLinkMultipleName('assignedUsers', $assignedUserId)
                    );
                }
            }
            else {
                $assignedUserId = $entity->get('assignedUserId');

                if ($assignedUserId) {
                    $entity->addLinkMultipleId('users', $assignedUserId);
                    $entity->setLinkMultipleName('users', $assignedUserId, $entity->get('assignedUserName'));
                }
            }
        }

        if (!$entity->isNew()) {
            return;
        }

        $currentUserId = $this->user->getId();

        if (!$entity->hasLinkMultipleId('users', $currentUserId)) {
            return;
        }

        $status = $entity->getLinkMultipleColumn('users', 'status', $currentUserId);

        if (!$status || $status === Meeting::ATTENDEE_STATUS_NONE) {
            $entity->setLinkMultipleColumn('users', 'status', $currentUserId, Meeting::ATTENDEE_STATUS_ACCEPTED);
        }
    }
}
