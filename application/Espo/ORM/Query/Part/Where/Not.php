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

namespace Espo\ORM\Query\Part\Where;

use Espo\ORM\Query\Part\WhereItem;

/**
 * A NOT-operator. Immutable.
 *
 * @immutable
 */
class Not implements WhereItem
{
    /** @var array<string|int, mixed> */
    private $rawValue = [];

    public function getRaw(): array
    {
        return ['NOT' => $this->getRawValue()];
    }

    public function getRawKey(): string
    {
        return 'NOT';
    }

    /**
     * @return array<string|int, mixed>
     */
    public function getRawValue(): array
    {
        return $this->rawValue;
    }

    /**
     * @param array<string|int, mixed> $whereClause
     */
    public static function fromRaw(array $whereClause): self
    {
        if (count($whereClause) === 1 && array_keys($whereClause)[0] === 0) {
            $whereClause = $whereClause[0];
        }

        $obj = new self();

        $obj->rawValue = $whereClause;

        return $obj;
    }

    public static function create(WhereItem $item): self
    {
        return self::fromRaw($item->getRaw());
    }
}
