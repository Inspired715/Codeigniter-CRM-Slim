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

namespace Espo\Tools\Notification;

use Espo\Core\Acl;
use Espo\Core\Exceptions\Error;
use Espo\Core\Record\Collection as RecordCollection;
use Espo\Core\Select\SearchParams;
use Espo\Core\Select\SelectBuilderFactory;
use Espo\Core\Utils\Metadata;
use Espo\Entities\Note;
use Espo\Entities\Notification;
use Espo\Entities\User;
use Espo\ORM\EntityCollection;
use Espo\ORM\EntityManager;
use Espo\Tools\Stream\NoteAccessControl;

class RecordService
{
    private EntityManager $entityManager;
    private Acl $acl;
    private Metadata $metadata;
    private NoteAccessControl $noteAccessControl;
    private SelectBuilderFactory $selectBuilderFactory;

    public function __construct(
        EntityManager $entityManager,
        Acl $acl,
        Metadata $metadata,
        NoteAccessControl $noteAccessControl,
        SelectBuilderFactory $selectBuilderFactory
    ) {
        $this->entityManager = $entityManager;
        $this->acl = $acl;
        $this->metadata = $metadata;
        $this->noteAccessControl = $noteAccessControl;
        $this->selectBuilderFactory = $selectBuilderFactory;
    }

    /**
     * Get notifications for a user.
     *
     * @return RecordCollection<Notification>
     * @throws Error
     */
    public function get(string $userId, SearchParams $searchParams): RecordCollection
    {
        $queryBuilder = $this->selectBuilderFactory
            ->create()
            ->from(Notification::ENTITY_TYPE)
            ->withSearchParams($searchParams)
            ->buildQueryBuilder()
            ->where(['userId' => $userId])
            ->order('number', SearchParams::ORDER_DESC);

        $offset = $searchParams->getOffset();
        $limit = $searchParams->getMaxSize();

        if ($limit) {
            $queryBuilder->limit($offset, $limit + 1);
        }

        $user = $this->entityManager
            ->getRDBRepositoryByClass(User::class)
            ->getById($userId);

        if (!$user) {
            throw new Error("User not found.");
        }

        $ignoreScopeList = $this->getIgnoreScopeList();

        if ($ignoreScopeList !== []) {
            $queryBuilder->where([
                'OR' => [
                    'relatedParentType' => null,
                    'relatedParentType!=' => $ignoreScopeList,
                ],
            ]);
        }

        $query = $queryBuilder->build();

        $collection = $this->entityManager
            ->getRDBRepositoryByClass(Notification::class)
            ->clone($query)
            ->find();

        if (!$collection instanceof EntityCollection) {
            throw new Error("Collection is not instance of EntityCollection.");
        }

        $ids = [];

        foreach ($collection as $k => $entity) {
            if ($k === $limit) {
                break;
            }

            $ids[] = $entity->getId();

            $this->prepareListItem($entity, $k, $collection, $limit, $user);
        }

        $collection = new EntityCollection([...$collection], Notification::ENTITY_TYPE);

        $this->markAsRead($ids);

        return RecordCollection::createNoCount($collection, $limit);
    }

    /**
     * @param string[] $ids
     */
    private function markAsRead(array $ids): void
    {
        if ($ids === []) {
            return;
        }

        $query = $this->entityManager
            ->getQueryBuilder()
            ->update()
            ->in(Notification::ENTITY_TYPE)
            ->set(['read' => true])
            ->where(['id' => $ids])
            ->build();

        $this->entityManager->getQueryExecutor()->execute($query);
    }

    /**
     * @param EntityCollection<Notification> $collection
     */
    private function prepareListItem(
        Notification $entity,
        int $index,
        EntityCollection $collection,
        int &$count,
        User $user
    ): void {

        $data = $entity->getData();

        if ($data === null) {
            return;
        }

        $noteId = $data->noteId ?? null;

        if (!$noteId) {
            return;
        }

        $type = $entity->getType();

        if (!in_array($type, [Notification::TYPE_NOTE, Notification::TYPE_MENTION_IN_POST])) {
            return;
        }

        /** @var ?Note $note */
        $note = $this->entityManager
            ->getRDBRepositoryByClass(Note::class)
            ->getById($noteId);

        if (!$note) {
            unset($collection[$index]);
            $count--;

            $this->entityManager->removeEntity($entity);

            return;
        }

        $this->noteAccessControl->apply($note, $user);

        $parentId = $note->getParentId();
        $parentType = $note->getParentType();

        if ($parentId && $parentType) {
            $parent = $this->entityManager->getEntityById($parentType, $parentId);

            if ($parent) {
                $note->set('parentName', $parent->get('name'));
            }
        }
        else if (!$note->isGlobal()) {
            $targetType = $note->getTargetType();

            if (!$targetType || $targetType === Note::TARGET_USERS) {
                $note->loadLinkMultipleField('users');
            }

            if ($targetType !== Note::TARGET_USERS) {
                if (!$targetType || $targetType === Note::TARGET_TEAMS) {
                    $note->loadLinkMultipleField('teams');
                }
                else if ($targetType === Note::TARGET_PORTALS) {
                    $note->loadLinkMultipleField('portals');
                }
            }
        }

        $relatedId = $note->getRelatedId();
        $relatedType = $note->getRelatedType();

        if ($relatedId && $relatedType) {
            $related = $this->entityManager->getEntityById($relatedType, $relatedId);

            if ($related) {
                $note->set('relatedName', $related->get('name'));
            }
        }

        $note->loadLinkMultipleField('attachments');

        $entity->set('noteData', $note->getValueMap());
    }

    public function getNotReadCount(string $userId): int
    {
        $whereClause = [
            'userId' => $userId,
            'read' => false,
        ];

        $ignoreScopeList = $this->getIgnoreScopeList();

        if (count($ignoreScopeList)) {
            $whereClause[] = [
                'OR' => [
                    'relatedParentType' => null,
                    'relatedParentType!=' => $ignoreScopeList,
                ]
            ];
        }

        return $this->entityManager
            ->getRDBRepositoryByClass(Notification::class)
            ->where($whereClause)
            ->count();
    }

    public function markAllRead(string $userId): bool
    {
        $update = $this->entityManager
            ->getQueryBuilder()
            ->update()
            ->in(Notification::ENTITY_TYPE)
            ->set(['read' => true])
            ->where([
                'userId' => $userId,
                'read' => false,
            ])
            ->build();

        $this->entityManager->getQueryExecutor()->execute($update);

        return true;
    }

    /**
     * @return string[]
     */
    private function getIgnoreScopeList(): array
    {
        $ignoreScopeList = [];

        $scopes = $this->metadata->get('scopes', []);

        foreach ($scopes as $scope => $item) {
            if (empty($item['entity'])) {
                continue;
            }

            if (empty($item['object'])) {
                continue;
            }

            if (!$this->acl->checkScope($scope)) {
                $ignoreScopeList[] = $scope;
            }
        }

        return $ignoreScopeList;
    }
}
