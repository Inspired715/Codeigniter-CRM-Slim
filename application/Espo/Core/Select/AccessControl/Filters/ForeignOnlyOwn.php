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

namespace Espo\Core\Select\AccessControl\Filters;

use Espo\Core\Select\AccessControl\Filter;
use Espo\ORM\Defs;
use Espo\ORM\Query\SelectBuilder;
use Espo\Core\Utils\Metadata;
use Espo\Entities\User;

use LogicException;

class ForeignOnlyOwn implements Filter
{
    public function __construct(
        private string $entityType,
        private User $user,
        private Metadata $metadata,
        private Defs $defs
    ) {}

    public function apply(SelectBuilder $queryBuilder): void
    {
        $link = $this->metadata->get(['aclDefs', $this->entityType, 'link']);

        if (!$link) {
            throw new LogicException("No `link` in aclDefs for {$this->entityType}.");
        }

        $alias = $link . 'Access';

        $queryBuilder->leftJoin($link, $alias);

        $foreignEntityType = $this->defs
            ->getEntity($this->entityType)
            ->getRelation($link)
            ->getForeignEntityType();

        $foreignEntityDefs = $this->defs->getEntity($foreignEntityType);

        if ($foreignEntityDefs->hasField('assignedUser')) {
            $queryBuilder->where([
                "{$alias}.assignedUserId" => $this->user->getId(),
            ]);

            return;
        }

        if ($foreignEntityDefs->hasField('createdBy')) {
            $queryBuilder->where([
                "{$alias}.createdById" => $this->user->getId(),
            ]);

            return;
        }

        $queryBuilder->where(['id' => null]);
    }
}
