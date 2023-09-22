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

namespace Espo\Services;

use Espo\Core\Acl\Table;
use Espo\ORM\Collection;
use Espo\ORM\Entity;

use Espo\Core\Acl\Table as AclTable;
use Espo\Core\Exceptions\Error;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Exceptions\NotFound;
use Espo\Core\Record\UpdateParams;
use Espo\Core\Select\SearchParams;
use Espo\Core\Select\Where\Item as WhereItem;

use Espo\Core\Acl\Exceptions\NotImplemented;

use ArrayAccess;
use Espo\ORM\Query\Part\Order;
use stdClass;

/**
 * @template TEntity of Entity
 * @extends Record<TEntity>
 */
class RecordTree extends Record
{
    private const MAX_DEPTH = 2;

    private ?Entity $seed = null;
    /** @var ?string */
    protected $subjectEntityType = null;
    /** @var ?string */
    protected $categoryField = null;

    public function __construct(string $entityType = '')
    {
        parent::__construct($entityType);

        if (!$this->subjectEntityType) {
            $this->subjectEntityType = substr($this->entityType, 0, strlen($this->entityType) - 8);
        }

        $this->readOnlyLinkList[] = 'children';
    }

    /**
     * @param array<string, mixed> $params
     * @return ?Collection<Entity>
     * @throws Forbidden
     */
    public function getTree(
        string $parentId = null,
        array $params = [],
        ?int $maxDepth = null
    ): ?Collection {

        if (!$this->acl->check($this->entityType, Table::ACTION_READ)) {
            throw new Forbidden();
        }

        return $this->getTreeInternal($parentId, $params, $maxDepth, 0);
    }

    /**
     * @param array<string, mixed> $params
     * @return ?Collection<Entity>
     */
    protected function getTreeInternal(
        string $parentId = null,
        array $params = [],
        ?int $maxDepth = null,
        int $level = 0
    ): ?Collection {

        if (!$maxDepth) {
            $maxDepth = self::MAX_DEPTH;
        }

        if ($level === $maxDepth) {
            return null;
        }

        $searchParams = SearchParams::fromRaw($params);

        $selectBuilder = $this->selectBuilderFactory
            ->create()
            ->from($this->entityType)
            ->withStrictAccessControl()
            ->withSearchParams($searchParams)
            ->buildQueryBuilder()
            ->where([
                'parentId' => $parentId,
            ]);

        $selectBuilder->order([]);

        if ($this->hasOrder()) {
            $selectBuilder->order('order', Order::ASC);
        }

        $selectBuilder->order('name', Order::ASC);

        $filterItems = false;

        if ($this->checkFilterOnlyNotEmpty()) {
            $filterItems = true;
        }

        $collection = $this->getRepository()
            ->clone($selectBuilder->build())
            ->find();

        if (
            (!empty($params['onlyNotEmpty']) || $filterItems) &&
            $collection instanceof ArrayAccess
        ) {
            foreach ($collection as $i => $entity) {
                if ($this->checkItemIsEmpty($entity)) {
                    unset($collection[$i]);
                }
            }
        }

        foreach ($collection as $entity) {
            $childList = $this->getTreeInternal($entity->getId(), $params, $maxDepth, $level + 1);

            $entity->set('childList', $childList ? $childList->getValueMapList() : null);
        }

        return $collection;
    }

    protected function checkFilterOnlyNotEmpty(): bool
    {
        assert($this->subjectEntityType !== null);

        try {
            if (!$this->acl->checkScope($this->subjectEntityType, Table::ACTION_CREATE)) {
                return true;
            }
        }
        catch (NotImplemented) {
            return false;
        }

        return false;
    }

    protected function checkItemIsEmpty(Entity $entity): bool
    {
        if (!$this->categoryField) {
            return false;
        }

        assert($this->subjectEntityType !== null);

        $query = $this->selectBuilderFactory
            ->create()
            ->from($this->subjectEntityType)
            ->withStrictAccessControl()
            ->withWhere(
                WhereItem::fromRaw([
                    'type' => 'inCategory',
                    'attribute' => $this->categoryField,
                    'value' => $entity->getId(),
                ])
            )
            ->build();

        $one = $this->entityManager
            ->getRDBRepository($this->subjectEntityType)
            ->clone($query)
            ->findOne();

        if ($one) {
            return false;
        }

        return true;
    }

    /**
     * @throws Forbidden
     * @throws NotFound
     */
    public function getCategoryData(?string $id): ?stdClass
    {
        if (!$this->acl->check($this->entityType, AclTable::ACTION_READ)) {
            throw new Forbidden();
        }

        if ($id === null) {
            return null;
        }

        $category = $this->entityManager->getEntity($this->entityType, $id);

        if (!$category) {
            throw new NotFound();
        }

        if (!$this->acl->check($category, AclTable::ACTION_READ)) {
            throw new Forbidden();
        }

        return (object) [
            'upperId' => $category->get('parentId'),
            'upperName' => $category->get('parentName'),
            'id' => $id,
            'name' => $category->get('name'),
        ];
    }

    /**
     * @return string[]
     * @throws Forbidden
     */
    public function getTreeItemPath(?string $parentId = null): array
    {
        if (!$this->acl->check($this->entityType, AclTable::ACTION_READ)) {
            throw new Forbidden();
        }

        $arr = [];

        while (1) {
            if (empty($parentId)) {
                break;
            }

            $parent = $this->entityManager->getEntityById($this->entityType, $parentId);

            if ($parent) {
                $parentId = $parent->get('parentId');

                array_unshift($arr, $parent->getId());
            }
            else {
                $parentId = null;
            }
        }

        return $arr;
    }

    protected function getSeed(): Entity
    {
        if (empty($this->seed)) {
            $this->seed = $this->entityManager->getNewEntity($this->entityType);
        }

        return $this->seed;
    }

    protected function hasOrder(): bool
    {
        $seed = $this->getSeed();

        if ($seed->hasAttribute('order')) {
            return true;
        }

        return false;
    }

    protected function beforeCreateEntity(Entity $entity, $data)
    {
        parent::beforeCreateEntity($entity, $data);

        if (!empty($data->parentId)) {
            $parent = $this->entityManager->getEntityById($this->entityType, $data->parentId);

            if (!$parent) {
                throw new Error("Tried to create tree item entity with not existing parent.");
            }

            if (!$this->acl->check($parent, Table::ACTION_EDIT)) {
                throw new Forbidden();
            }
        }
    }

    public function update(string $id, stdClass $data, UpdateParams $params): Entity
    {
        if (!empty($data->parentId) && $data->parentId === $id) {
            throw new Forbidden();
        }

        return parent::update($id, $data, $params);
    }

    public function link(string $id, string $link, string $foreignId): void
    {
        if ($id == $foreignId) {
            throw new Forbidden();
        }

        parent::link($id, $link, $foreignId);
    }

    /**
     * @return string[]
     * @throws Forbidden
     */
    public function getLastChildrenIdList(?string $parentId = null): array
    {
        if (!$this->acl->check($this->entityType, Table::ACTION_READ)) {
            throw new Forbidden();
        }

        $query = $this->selectBuilderFactory
            ->create()
            ->from($this->entityType)
            ->withStrictAccessControl()
            ->buildQueryBuilder()
            ->where([
                'parentId' => $parentId,
            ])
            ->build();

        $idList = [];

        $includingRecords = false;

        if ($this->checkFilterOnlyNotEmpty()) {
            $includingRecords = true;
        }

        $collection = $this->getRepository()
            ->clone($query)
            ->select(['id'])
            ->find();

        foreach ($collection as $entity) {
            $subQuery = $this->selectBuilderFactory
                ->create()
                ->from($this->entityType)
                ->withStrictAccessControl()
                ->buildQueryBuilder()
                ->where([
                    'parentId' => $entity->getId(),
                ])
                ->build();

            $count = $this->getRepository()
                ->clone($subQuery)
                ->count();

            if (!$count) {
                $idList[] = $entity->getId();

                continue;
            }

            if ($includingRecords) {
                $isNotEmpty = false;

                $subCollection = $this->getRepository()
                    ->clone($subQuery)
                    ->find();

                foreach ($subCollection as $subEntity) {
                    if (!$this->checkItemIsEmpty($subEntity)) {
                        $isNotEmpty = true;

                        break;
                    }
                }

                if (!$isNotEmpty) {
                    $idList[] = $entity->getId();
                }
            }
        }

        return $idList;
    }
}
