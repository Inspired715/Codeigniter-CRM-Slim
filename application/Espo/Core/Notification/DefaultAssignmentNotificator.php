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

namespace Espo\Core\Notification;

use Espo\Core\ORM\Entity as CoreEntity;
use Espo\ORM\Entity;
use Espo\ORM\EntityManager;
use Espo\Entities\User;
use Espo\Entities\Notification;
use Espo\Core\Notification\AssignmentNotificator\Params;

/**
 * @implements AssignmentNotificator<Entity>
 */
class DefaultAssignmentNotificator implements AssignmentNotificator
{
    public function __construct(
        protected User $user,
        protected EntityManager $entityManager,
        protected UserEnabledChecker $userChecker
    ) {}

    public function process(Entity $entity, Params $params): void
    {
        if (!$entity instanceof CoreEntity) {
            return;
        }

        if ($entity->hasLinkMultipleField('assignedUsers')) {
            /** @var string[] $userIdList */
            $userIdList = $entity->getLinkMultipleIdList('assignedUsers');
            /** @var string[] $fetchedAssignedUserIdList */
            $fetchedAssignedUserIdList = $entity->getFetched('assignedUsersIds') ?? [];

            foreach ($userIdList as $userId) {
                if (in_array($userId, $fetchedAssignedUserIdList)) {
                    continue;
                }

                $this->processForUser($entity, $userId);
            }

            return;
        }

        if (!$entity->get('assignedUserId')) {
            return;
        }

        if (!$entity->isAttributeChanged('assignedUserId')) {
            return;
        }

        $assignedUserId = $entity->get('assignedUserId');

        $this->processForUser($entity, $assignedUserId);
    }

    protected function processForUser(Entity $entity, string $assignedUserId): void
    {
        if (!$this->userChecker->checkAssignment($entity->getEntityType(), $assignedUserId)) {
            return;
        }

        if ($entity->hasAttribute('createdById') && $entity->hasAttribute('modifiedById')) {
            $isSelfAssignment = $entity->isNew() ?
                $assignedUserId === $entity->get('createdById') :
                $assignedUserId === $entity->get('modifiedById');

            if ($isSelfAssignment) {
                return;
            }
        }

        $isSelfAssignment = $assignedUserId === $this->user->getId();

        if ($isSelfAssignment) {
            return;
        }

        $this->entityManager->createEntity(Notification::ENTITY_TYPE, [
            'type' => Notification::TYPE_ASSIGN,
            'userId' => $assignedUserId,
            'data' => [
                'entityType' => $entity->getEntityType(),
                'entityId' => $entity->getId(),
                'entityName' => $entity->get('name'),
                'isNew' => $entity->isNew(),
                'userId' => $this->user->getId(),
                'userName' => $this->user->getName(),
            ],
            'relatedType' => $entity->getEntityType(),
            'relatedId' => $entity->getId(),
        ]);
    }
}
