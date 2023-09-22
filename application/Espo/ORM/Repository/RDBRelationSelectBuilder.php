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

use Espo\ORM\Collection;
use Espo\ORM\Mapper\RDBMapper;
use Espo\ORM\SthCollection;
use Espo\ORM\Entity;
use Espo\ORM\EntityManager;
use Espo\ORM\BaseEntity;
use Espo\ORM\Query\Select;
use Espo\ORM\Query\SelectBuilder;
use Espo\ORM\Query\Part\WhereItem;
use Espo\ORM\Query\Part\Selection;
use Espo\ORM\Query\Part\Join;
use Espo\ORM\Query\Part\Expression;
use Espo\ORM\Query\Part\Order;

use LogicException;
use RuntimeException;
use InvalidArgumentException;

/**
 * Builds select parameters for related records for RDB repository.
 */
class RDBRelationSelectBuilder
{
    private EntityManager $entityManager;
    private Entity $entity;
    private string $foreignEntityType;
    private string $relationName;
    private ?string $relationType;
    private SelectBuilder $builder;
    private ?string $middleTableAlias = null;
    private bool $returnSthCollection = false;

    public function __construct(
        EntityManager $entityManager,
        Entity $entity,
        string $relationName,
        ?Select $query = null
    ) {
        $this->entityManager = $entityManager;
        $this->entity = $entity;
        $this->relationName = $relationName;
        $this->relationType = $entity->getRelationType($relationName);
        $entityType = $entity->getEntityType();

        if ($entity instanceof BaseEntity) {
            $this->foreignEntityType = $entity->getRelationParam($relationName, 'entity');
        }
        else {
            $this->foreignEntityType = $this->entityManager
                ->getDefs()
                ->getEntity($entityType)
                ->getRelation($relationName)
                ->getForeignEntityType();
        }

        $this->builder = $query ?
            $this->cloneQueryToBuilder($query) :
            $this->createSelectBuilder()->from($this->foreignEntityType);
    }

    private function cloneQueryToBuilder(Select $query): SelectBuilder
    {
        $where = $query->getWhere();

        if ($where === null) {
            return $this->createSelectBuilder()->clone($query);
        }

        $rawQuery = $query->getRaw();

        $rawQuery['whereClause'] = $this->applyRelationAliasToWhereClause($where->getRaw());

        $newQuery = Select::fromRaw($rawQuery);

        return $this->createSelectBuilder()->clone($newQuery);
    }

    protected function createSelectBuilder(): SelectBuilder
    {
        return new SelectBuilder();
    }

    protected function getMapper(): RDBMapper
    {
        $mapper = $this->entityManager->getMapper();

        if (!$mapper instanceof RDBMapper) {
            throw new LogicException();
        }

        return $mapper;
    }

    /**
     * Apply middle table conditions for a many-to-many relationship.
     *
     * Usage example:
     * `->columnsWhere(['column' => $value])`
     *
     * @param WhereItem|array<int|string, mixed> $clause Where clause.
     */
    public function columnsWhere($clause): self
    {
        if ($this->relationType !== Entity::MANY_MANY) {
            throw new RuntimeException("Can't add columns where for not many-to-many relationship.");
        }

        if ($clause instanceof WhereItem) {
            $clause = $clause->getRaw();
        }

        if (!is_array($clause)) {
            throw new InvalidArgumentException();
        }

        $transformedWhere = $this->applyMiddleAliasToWhere($clause);

        $this->where($transformedWhere);

        return $this;
    }

    /**
     * @param array<string|int, mixed> $where
     * @return array<string|int, mixed>
     */
    protected function applyMiddleAliasToWhere(array $where): array
    {
        $transformedWhere = [];

        $middleName = lcfirst($this->getRelationParam('relationName'));

        foreach ($where as $key => $value) {
            $transformedKey = $key;
            $transformedValue = $value;

            if (
                is_string($key) &&
                strlen($key) &&
                !str_contains($key, '.') &&
                $key[0] === strtolower($key[0])
            ) {
                $transformedKey = $middleName . '.' . $key;
            }

            if (is_array($value)) {
                $transformedValue = $this->applyMiddleAliasToWhere($value);
            }

            $transformedWhere[$transformedKey] = $transformedValue;
        }

        return $transformedWhere;
    }

    /**
     * Find related records by a criteria.
     *
     * @return Collection<Entity>
     */
    public function find(): Collection
    {
        $query = $this->builder->build();

        $related = $this->getMapper()->selectRelated($this->entity, $this->relationName, $query);

        if ($related instanceof Collection) {
            return $this->handleReturnCollection($related);
        }

        $collection = $this->entityManager->getCollectionFactory()->create($this->foreignEntityType);

        $collection->setAsFetched();

        if ($related instanceof Entity) {
            $collection[] = $related;
        }

        return $collection;
    }

    /**
     * Find a first related records by a criteria.
     */
    public function findOne(): ?Entity
    {
        $collection = $this->sth()->limit(0, 1)->find();

        foreach ($collection as $entity) {
            return $entity;
        }

        return null;
    }

    /**
     * Get a number of related records that meet criteria.
     */
    public function count(): int
    {
        $query = $this->builder->build();

        return $this->getMapper()->countRelated($this->entity, $this->relationName, $query);
    }

    /**
     * Add JOIN.
     *
     * @param Join|string $target
     * A relation name or table. A relation name should be in camelCase, a table in CamelCase.
     * @param string|null $alias An alias.
     * @param WhereItem|array<string|int, mixed>|null $conditions Join conditions.
     */
    public function join($target, ?string $alias = null, $conditions = null): self
    {
        $this->builder->join($target, $alias, $conditions);

        return $this;
    }

    /**
     * Add LEFT JOIN.
     *
     * @param Join|string $target
     * A relation name or table. A relation name should be in camelCase, a table in CamelCase.
     * @param string|null $alias An alias.
     * @param WhereItem|array<int|string, mixed>|null $conditions Join conditions.
     */
    public function leftJoin($target, ?string $alias = null, $conditions = null): self
    {
        $this->builder->leftJoin($target, $alias, $conditions);

        return $this;
    }

    /**
     * Set DISTINCT parameter.
     */
    public function distinct(): self
    {
        $this->builder->distinct();

        return $this;
    }

    /**
     * Return STH collection. Recommended for fetching large number of records.
     */
    public function sth(): self
    {
        $this->returnSthCollection = true;

        return $this;
    }

    /**
     * Add a WHERE clause.
     *
     * Usage options:
     * * `where(WhereItem $clause)`
     * * `where(array $clause)`
     * * `where(string $key, string $value)`
     *
     * @param WhereItem|array<int|string, mixed>|string $clause A key or where clause.
     * @param mixed[]|scalar|null $value A value. Should be omitted if the first argument is not string.
     */
    public function where($clause = [], $value = null): self
    {
        if ($this->isManyMany()) {
            if ($clause instanceof WhereItem) {
                $clause = $this->applyRelationAliasToWhereClause($clause->getRaw());
            }
            else if (is_string($clause)) {
                $clause = $this->applyRelationAliasToWhereClauseKey($clause);
            }
            else if (is_array($clause)) {
                $clause = $this->applyRelationAliasToWhereClause($clause);
            }
        }

        $this->builder->where($clause, $value);

        return $this;
    }

    /**
     * Add a HAVING clause.
     *
     * Usage options:
     * * `having(WhereItem $clause)`
     * * `having(array $clause)`
     * * `having(string $key, string $value)`
     *
     * @param WhereItem|array<mixed, mixed>|string $clause A key or where clause.
     * @param mixed[]|string|null $value A value. Should be omitted if the first argument is not string.
     */
    public function having($clause = [], $value = null): self
    {
        $this->builder->having($clause, $value);

        return $this;
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
     * @param (Order::ASC|Order::DESC)|bool|null $direction Select::ORDER_ASC|Select::ORDER_DESC.
     */
    public function order($orderBy = 'id', $direction = null): self
    {
        $this->builder->order($orderBy, $direction);

        return $this;
    }

    /**
     * Apply OFFSET and LIMIT.
     */
    public function limit(?int $offset = null, ?int $limit = null): self
    {
        $this->builder->limit($offset, $limit);

        return $this;
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
     */
    public function select($select, ?string $alias = null): self
    {
        $this->builder->select($select, $alias);

        return $this;
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
     */
    public function group($groupBy): self
    {
        $this->builder->group($groupBy);

        return $this;
    }

    /**
     * @deprecated Use `group` method.
     * @param Expression|Expression[]|string|string[] $groupBy
     */
    public function groupBy($groupBy): self
    {
        return $this->group($groupBy);
    }

    protected function getMiddleTableAlias(): ?string
    {
        if (!$this->isManyMany()) {
            return null;
        }

        if (!$this->middleTableAlias) {
            $middleName = $this->getRelationParam('relationName');

            if (!$middleName) {
                throw new RuntimeException("No relation name.");
            }

            $this->middleTableAlias = lcfirst($middleName);
        }

        return $this->middleTableAlias;
    }

    protected function applyRelationAliasToWhereClauseKey(string $item): string
    {
        if (!$this->isManyMany()) {
            return $item;
        }

        $alias = $this->getMiddleTableAlias();

        return str_replace('@relation.', $alias . '.', $item);
    }

    /**
     * @param array<int|string, mixed> $where
     * @return array<int|string, mixed>
     */
    protected function applyRelationAliasToWhereClause(array $where): array
    {
        if (!$this->isManyMany()) {
            return $where;
        }

        $transformedWhere = [];

        foreach ($where as $key => $value) {
            $transformedKey = $key;
            $transformedValue = $value;

            if (is_int($key)) {
                $transformedKey = $key;
            }

            if (is_string($key)) {
                $transformedKey = $this->applyRelationAliasToWhereClauseKey($key);
            }

            if (is_array($value)) {
                $transformedValue = $this->applyRelationAliasToWhereClause($value);
            }

            $transformedWhere[$transformedKey] = $transformedValue;
        }

        return $transformedWhere;
    }

    protected function isManyMany(): bool
    {
        return $this->relationType === Entity::MANY_MANY;
    }

    /**
     * @param Collection<Entity> $collection
     * @return Collection<Entity>
     */
    protected function handleReturnCollection(Collection $collection): Collection
    {
        if (!$collection instanceof SthCollection) {
            return $collection;
        }

        if ($this->returnSthCollection) {
            return $collection;
        }

        return $this->entityManager->getCollectionFactory()->createFromSthCollection($collection);
    }

    /**
     * @return mixed
     */
    private function getRelationParam(string $param)
    {
        if ($this->entity instanceof BaseEntity) {
            return $this->entity->getRelationParam($this->relationName, $param);
        }

        $entityDefs = $this->entityManager
            ->getDefs()
            ->getEntity($this->entity->getEntityType());

        if (!$entityDefs->hasRelation($this->relationName)) {
            return null;
        }

        return $entityDefs->getRelation($this->relationName)->getParam($param);
    }
}
