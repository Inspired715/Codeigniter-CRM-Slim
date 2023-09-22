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

namespace Espo\Core\Utils\Database\Orm\Defs;

use Espo\Core\Utils\Util;
use Espo\ORM\Type\RelationType;

class RelationDefs
{
    /** @var array<string, mixed> */
    private array $params = [];

    private function __construct(private string $name) {}

    public static function create(string $name): self
    {
        return new self($name);
    }

    /**
     * Get a relation name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get a type.
     *
     * @return RelationType::*
     */
    public function getType(): ?string
    {
        /** @var ?RelationType::* */
        return $this->getParam('type');
    }

    /**
     * Clone with a type.
     *
     * @param RelationType::* $type
     */
    public function withType(string $type): self
    {
        return $this->withParam('type', $type);
    }

    /**
     * Clone with a foreign entity type.
     */
    public function withForeignEntityType(string $entityType): self
    {
        return $this->withParam('entity', $entityType);
    }

    /**
     * Get a foreign entity type.
     */
    public function getForeignEntityType(): ?string
    {
        return $this->getParam('entity');
    }

    /**
     * Clone with a foreign relation name.
     */
    public function withForeignRelationName(?string $name): self
    {
        return $this->withParam('foreign', $name);
    }

    /**
     * Get a foreign relation name.
     */
    public function getForeignRelationName(): ?string
    {
        return $this->getParam('foreign');
    }

    /**
     * Clone with a relationship name.
     */
    public function withRelationshipName(string $name): self
    {
        return $this->withParam('relationName', $name);
    }

    /**
     * Get a foreign relation name.
     */
    public function getRelationshipName(): ?string
    {
        return $this->getParam('relationName');
    }

    /**
     * Clone with a key.
     */
    public function withKey(string $key): self
    {
        return $this->withParam('key', $key);
    }

    /**
     * Get a key.
     */
    public function getKey(): ?string
    {
        return $this->getParam('key');
    }

    /**
     * Clone with a key.
     */
    public function withForeignKey(string $foreignKey): self
    {
        return $this->withParam('foreignKey', $foreignKey);
    }

    /**
     * Get a key.
     */
    public function getForeignKey(): ?string
    {
        return $this->getParam('foreignKey');
    }

    /**
     * Clone with middle keys.
     */
    public function withMidKeys(string $midKey, string $foreignMidKey): self
    {
        return $this->withParam('midKeys', [$midKey, $foreignMidKey]);
    }

    /**
     * Whether a parameter is set.
     */
    public function hasParam(string $name): bool
    {
        return array_key_exists($name, $this->params);
    }

    /**
     * Get a parameter value.
     */
    public function getParam(string $name): mixed
    {
        return $this->params[$name] ?? null;
    }

    /**
     * Clone with a parameter.
     */
    public function withParam(string $name, mixed $value): self
    {
        $obj = clone $this;
        $obj->params[$name] = $value;

        return $obj;
    }

    /**
     * Clone without a parameter.
     */
    public function withoutParam(string $name): self
    {
        $obj = clone $this;
        unset($obj->params[$name]);

        return $obj;
    }

    /**
     * Clone with conditions. Conditions are used for relationships that share a same middle table.
     *
     * @param array<string, scalar|(array<int, mixed>)|null> $conditions
     */
    public function withConditions(array $conditions): self
    {
        $obj = clone $this;

        return $obj->withParam('conditions', $conditions);
    }

    /**
     * Clone with an additional middle table column.
     */
    public function withAdditionalColumn(AttributeDefs $attributeDefs): self
    {
        $obj = clone $this;

        /** @var array<string, array<string, mixed>> $list */
        $list = $obj->getParam('additionalColumns') ?? [];

        $list[$attributeDefs->getName()] = $attributeDefs->toAssoc();

        return $obj->withParam('additionalColumns', $list);
    }

    /**
     * Clone with parameters merged.
     *
     * @param array<string, mixed> $params
     */
    public function withParamsMerged(array $params): self
    {
        $obj = clone $this;

        /** @var array<string, mixed> $params */
        $params = Util::merge($this->params, $params);

        $obj->params = $params;

        return $obj;
    }

    /**
     * To an associative array.
     *
     * @return array<string, mixed>
     */
    public function toAssoc(): array
    {
        return $this->params;
    }
}
