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

namespace Espo\ORM\Repository;

use Espo\ORM\EntityManager;
use Espo\ORM\EntityFactory;
use Espo\ORM\Collection;
use Espo\ORM\Repository\Deprecation\RDBRepositoryDeprecationTrait;
use Espo\ORM\Repository\Option\SaveOption;
use Espo\ORM\SthCollection;
use Espo\ORM\BaseEntity;
use Espo\ORM\Entity;
use Espo\ORM\Mapper\RDBMapper;
use Espo\ORM\Query\Select;
use Espo\ORM\Query\Part\WhereItem;
use Espo\ORM\Query\Part\Selection;
use Espo\ORM\Query\Part\Join;
use Espo\ORM\Query\Part\Expression;
use Espo\ORM\Query\Part\Order;
use Espo\ORM\Mapper\BaseMapper;

use RuntimeException;

/**
 * A relation database repository.
 *
 * @template TEntity of Entity
 * @implements Repository<TEntity>
 */
class RDBRepository implements Repository
{
    /** @phpstan-use RDBRepositoryDeprecationTrait<TEntity> */
    use RDBRepositoryDeprecationTrait;

    protected HookMediator $hookMediator;
    protected RDBTransactionManager $transactionManager;

    public function __construct(
        protected string $entityType,
        protected EntityManager $entityManager,
        protected EntityFactory $entityFactory,
        ?HookMediator $hookMediator = null
    ) {
        $this->hookMediator = $hookMediator ?? (new EmptyHookMediator());
        $this->transactionManager = new RDBTransactionManager($entityManager->getTransactionManager());
    }

    public function getEntityType(): string
    {
        return $this->entityType;
    }

    /**
     * Get a new entity.
     *
     * @return TEntity
     */
    public function getNew(): Entity
    {
        $entity = $this->entityFactory->create($this->entityType);

        if ($entity instanceof BaseEntity) {
            $entity->populateDefaults();
        }

        /** @var TEntity */
        return $entity;
    }

    /**
     * Fetch an entity by ID.
     *
     * @return ?TEntity
     */
    public function getById(string $id): ?Entity
    {
        $selectQuery = $this->entityManager
            ->getQueryBuilder()
            ->select()
            ->from($this->entityType)
            ->where([
                'id' => $id,
            ])
            ->build();

        /** @var ?TEntity $entity */
        $entity = $this->getMapper()->selectOne($selectQuery);

        return $entity;
    }

    protected function processCheckEntity(Entity $entity): void
    {
        if ($entity->getEntityType() !== $this->entityType) {
            throw new RuntimeException("An entity type doesn't match the repository.");
        }
    }

    /**
     * @param TEntity $entity
     * @param array<string, mixed> $options
     */
    public function save(Entity $entity, array $options = []): void
    {
        $this->processCheckEntity($entity);

        if ($entity instanceof BaseEntity) {
            $entity->setAsBeingSaved();
        }

        if (empty($options['skipBeforeSave']) && empty($options[SaveOption::SKIP_ALL])) {
            $this->beforeSave($entity, $options);
        }

        $isSaved = false;

        if ($entity instanceof BaseEntity) {
            $isSaved = $entity->isSaved();
        }

        if ($entity->isNew() && !$isSaved) {
            $this->getMapper()->insert($entity);
        }
        else {
            $this->getMapper()->update($entity);
        }

        if ($entity instanceof BaseEntity) {
            $entity->setAsSaved();
        }

        if (
            empty($options['skipAfterSave']) &&
            empty($options[SaveOption::SKIP_ALL])
        ) {
            $this->afterSave($entity, $options);
        }

        if ($entity->isNew()) {
            if (empty($options[SaveOption::KEEP_NEW])) {
                $entity->setAsNotNew();

                $entity->updateFetchedValues();
            }
        }
        else {
            if (empty($options[SaveOption::KEEP_DIRTY])) {
                $entity->updateFetchedValues();
            }
        }

        if ($entity instanceof BaseEntity) {
            $entity->setAsNotBeingSaved();
        }
    }

    /**
     * Restore a record flagged as deleted.
     */
    public function restoreDeleted(string $id): void
    {
        $mapper = $this->getMapper();

        if (!$mapper instanceof BaseMapper) {
            throw new RuntimeException("Not supported 'restoreDeleted'.");
        }

        $mapper->restoreDeleted($this->entityType, $id);
    }

    /**
     * Get an access point for a specific relation of a record.
     *
     * @param TEntity $entity
     */
    public function getRelation(Entity $entity, string $relationName): RDBRelation
    {
        return new RDBRelation($this->entityManager, $entity, $relationName, $this->hookMediator);
    }

    /**
     * Remove a record (mark as deleted).
     */
    public function remove(Entity $entity, array $options = []): void
    {
        $this->processCheckEntity($entity);
        $this->beforeRemove($entity, $options);
        $this->getMapper()->delete($entity);
        $this->afterRemove($entity, $options);
    }

    /**
     * Find records.
     *
     * @param ?array<string, mixed> $params @deprecated As of v6.0. Use query building.
     * @return Collection<TEntity>
     */
    public function find(?array $params = []): Collection
    {
        return $this->createSelectBuilder()->find($params);
    }

    /**
     * Find one record.
     *
     * @param ?array<string, mixed> $params @deprecated As of v6.0. Use query building.
     */
    public function findOne(?array $params = []): ?Entity
    {
        $collection = $this->limit(0, 1)->find($params);

        foreach ($collection as $entity) {
            return $entity;
        }

        return null;
    }

    /**
     * Find records by an SQL query.
     *
     * @return SthCollection<TEntity>
     */
    public function findBySql(string $sql): SthCollection
    {
        $mapper = $this->getMapper();

        if (!$mapper instanceof BaseMapper) {
            throw new RuntimeException("Not supported 'findBySql'.");
        }

        /** @var SthCollection<TEntity> */
        return $mapper->selectBySql($this->entityType, $sql);
    }

    /**
     * @param array<string, mixed> $params @deprecated Use query building.
     */
    public function count(array $params = []): int
    {
        return $this->createSelectBuilder()->count($params);
    }

    /**
     * Get a max value.
     *
     * @return int|float
     */
    public function max(string $attribute)
    {
        return $this->createSelectBuilder()->max($attribute);
    }

    /**
     * Get a min value.
     *
     * @return int|float
     */
    public function min(string $attribute)
    {
        return $this->createSelectBuilder()->min($attribute);
    }

    /**
     * Get a sum value.
     *
     * @return int|float
     */
    public function sum(string $attribute)
    {
        return $this->createSelectBuilder()->sum($attribute);
    }

    /**
     * Clone an existing query for a further modification and usage by 'find' or 'count' methods.
     *
     * @return RDBSelectBuilder<TEntity>
     */
    public function clone(Select $query): RDBSelectBuilder
    {
        if ($this->entityType !== $query->getFrom()) {
            throw new RuntimeException("Can't clone a query of a different entity type.");
        }

        /** @var RDBSelectBuilder<TEntity> $builder */
        $builder = new RDBSelectBuilder($this->entityManager, $this->entityType, $query);

        return $builder;
    }

    /**
     * Add JOIN.
     *
     * @param Join|string $target
     * A relation name or table. A relation name should be in camelCase, a table in CamelCase.
     * @param string|null $alias An alias.
     * @param WhereItem|array<scalar, mixed>|null $conditions Join conditions.
     * @return RDBSelectBuilder<TEntity>
     */
    public function join($target, ?string $alias = null, $conditions = null): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->join($target, $alias, $conditions);
    }

    /**
     * Add LEFT JOIN.
     *
     * @param Join|string $target
     * A relation name or table. A relation name should be in camelCase, a table in CamelCase.
     * @param string|null $alias An alias.
     * @param WhereItem|array<scalar, mixed>|null $conditions Join conditions.
     * @return RDBSelectBuilder<TEntity>
     */
    public function leftJoin($target, ?string $alias = null, $conditions = null): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->leftJoin($target, $alias, $conditions);
    }

    /**
     * Set DISTINCT parameter.
     *
     * @return RDBSelectBuilder<TEntity>
     */
    public function distinct(): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->distinct();
    }

    /**
     * Lock selected rows. To be used within a transaction.
     *
     * @return RDBSelectBuilder<TEntity>
     */
    public function forUpdate(): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->forUpdate();
    }

    /**
     * Set to return STH collection. Recommended fetching large number of records.
     *
     * @return RDBSelectBuilder<TEntity>
     */
    public function sth(): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->sth();
    }

    /**
     * Add a WHERE clause.
     *
     * Usage options:
     * * `where(WhereItem $clause)`
     * * `where(array $clause)`
     * * `where(string $key, string $value)`
     *
     * @param WhereItem|array<scalar, mixed>|string $clause A key or where clause.
     * @param mixed[]|scalar|null $value A value. Should be omitted if the first argument is not string.
     * @return RDBSelectBuilder<TEntity>
     */
    public function where($clause = [], $value = null): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->where($clause, $value);
    }

    /**
     * Add a HAVING clause.
     *
     * Usage options:
     * * `having(WhereItem $clause)`
     * * `having(array $clause)`
     * * `having(string $key, string $value)`
     *
     * @param WhereItem|array<scalar, mixed>|string $clause A key or where clause.
     * @param mixed[]|scalar|null $value A value. Should be omitted if the first argument is not string.
     * @return RDBSelectBuilder<TEntity>
     */
    public function having($clause = [], $value = null): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->having($clause, $value);
    }

    /**
     * Apply ORDER. Passing an array will override previously set items.
     * Passing non-array will append an item,
     *
     * Usage options:
     * * `order(Order $expression)
     * * `order([$expr1, $expr2, ...])
     * * `order(string $expression, string $direction)
     *
     * @param Order|Order[]|Expression|string|array<int, string[]>|string[] $orderBy
     *   An attribute to order by or an array or order items.
     *   Passing an array will reset a previously set order.
     * @param (Order::ASC|Order::DESC)|bool|null $direction A direction.
     * @return RDBSelectBuilder<TEntity>
     */
    public function order($orderBy = 'id', $direction = null): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->order($orderBy, $direction);
    }

    /**
     * Apply OFFSET and LIMIT.
     *
     * @return RDBSelectBuilder<TEntity>
     */
    public function limit(?int $offset = null, ?int $limit = null): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->limit($offset, $limit);
    }

    /**
     * Specify SELECT. Columns and expressions to be selected. If not called, then
     * all entity attributes will be selected. Passing an array will reset
     * previously set items. Passing a SelectExpression|Expression|string will append the item.
     *
     * Usage options:
     * * `select(SelectExpression $expression)`
     * * `select([$expr1, $expr2, ...])`
     * * `select(string $expression, string $alias)`
     *
     * @param Selection|Selection[]|Expression|Expression[]|string[]|string|array<int, string[]|string> $select
     *   An array of expressions or one expression.
     * @param string|null $alias An alias. Actual if the first parameter is not an array.
     * @return RDBSelectBuilder<TEntity>
     */
    public function select($select = [], ?string $alias = null): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->select($select, $alias);
    }

    /**
     * Specify GROUP BY.
     * Passing an array will reset previously set items.
     * Passing a string|Expression will append an item.
     *
     * Usage options:
     * * `groupBy(Expression|string $expression)`
     * * `groupBy([$expr1, $expr2, ...])`
     *
     * @param Expression|Expression[]|string|string[] $groupBy
     * @return RDBSelectBuilder<TEntity>
     */
    public function group($groupBy): RDBSelectBuilder
    {
        return $this->createSelectBuilder()->group($groupBy);
    }

    /**
     * Create a select builder.
     *
     * @return RDBSelectBuilder<TEntity>
     */
    protected function createSelectBuilder(): RDBSelectBuilder
    {
        /** @var RDBSelectBuilder<TEntity> $builder */
        $builder = new RDBSelectBuilder($this->entityManager, $this->entityType);

        return $builder;
    }

    /**
     * Use hooks instead.
     * @param array<string, mixed> $options
     * @return void
     */
    protected function beforeSave(Entity $entity, array $options = [])
    {
        $this->hookMediator->beforeSave($entity, $options);
    }

    /**
     * Use hooks instead.
     * @param array<string, mixed> $options
     * @return void
     */
    protected function afterSave(Entity $entity, array $options = [])
    {
        $this->hookMediator->afterSave($entity, $options);
    }

    /**
     * Use hooks instead.
     * @param array<string, mixed> $options
     * @return void
     */
    protected function beforeRemove(Entity $entity, array $options = [])
    {
        $this->hookMediator->beforeRemove($entity, $options);
    }

    /**
     * Use hooks instead.
     * @param array<string, mixed> $options
     * @return void
     */
    protected function afterRemove(Entity $entity, array $options = [])
    {
        $this->hookMediator->afterRemove($entity, $options);
    }

    protected function getMapper(): RDBMapper
    {
        $mapper = $this->entityManager->getMapper();

        if (!$mapper instanceof RDBMapper) {
            throw new RuntimeException("Mapper is not RDB.");
        }

        return $mapper;
    }

    /**
     * @deprecated As of v6.0. Use hooks instead.
     * @phpstan-ignore-next-line
     */
    protected function beforeRelate(Entity $entity, $relationName, $foreign, $data = null, array $options = [])
    {}

    /**
     * @deprecated As of v6.0. Use hooks instead.
     * @phpstan-ignore-next-line
     */
    protected function afterRelate(Entity $entity, $relationName, $foreign, $data = null, array $options = [])
    {}

    /**
     * @deprecated As of v6.0. Use hooks instead.
     * @phpstan-ignore-next-line
     */
    protected function beforeUnrelate(Entity $entity, $relationName, $foreign, array $options = [])
    {}

    /**
     * @deprecated As of v6.0. Use hooks instead.
     * @phpstan-ignore-next-line
     */
    protected function afterUnrelate(Entity $entity, $relationName, $foreign, array $options = [])
    {}

    /**
     * @deprecated As of v6.0. Use hooks instead.
     * @phpstan-ignore-next-line
     */
    protected function beforeMassRelate(Entity $entity, $relationName, array $params = [], array $options = [])
    {}

    /**
     * @deprecated As of v6.0. Use hooks instead.
     * @phpstan-ignore-next-line
     */
    protected function afterMassRelate(Entity $entity, $relationName, array $params = [], array $options = [])
    {}
}
