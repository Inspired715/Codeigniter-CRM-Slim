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
use Espo\Core\Select\Helpers\FieldHelper;
use Espo\Entities\Team;
use Espo\Entities\User;
use Espo\ORM\Defs;
use Espo\ORM\Query\SelectBuilder as QueryBuilder;

class OnlyTeam implements Filter
{
    public function __construct(
        private User $user,
        private FieldHelper $fieldHelper,
        private string $entityType,
        private Defs $defs
    ) {}

    public function apply(QueryBuilder $queryBuilder): void
    {
        if (!$this->fieldHelper->hasTeamsField()) {
            $queryBuilder->where(['id' => null]);

            return;
        }

        $subQueryBuilder = QueryBuilder::create()
            ->select('id')
            ->from($this->entityType)
            ->leftJoin(Team::RELATIONSHIP_ENTITY_TEAM, 'entityTeam', [
                'entityTeam.entityId:' => 'id',
                'entityTeam.entityType' => $this->entityType,
                'entityTeam.deleted' => false,
            ]);

        // Empty list is converted to false statement by ORM.
        $orGroup = ['entityTeam.teamId' => $this->user->getTeamIdList()];

        if ($this->fieldHelper->hasAssignedUsersField()) {
            $relationDefs = $this->defs
                ->getEntity($this->entityType)
                ->getRelation('assignedUsers');

            $middleEntityType = ucfirst($relationDefs->getRelationshipName());
            $key1 = $relationDefs->getMidKey();
            $key2 = $relationDefs->getForeignMidKey();

            $subQueryBuilder->leftJoin($middleEntityType, 'assignedUsersMiddle', [
                "assignedUsersMiddle.{$key1}:" => 'id',
                'assignedUsersMiddle.deleted' => false,
            ]);

            $orGroup["assignedUsersMiddle.{$key2}"] = $this->user->getId();
        }
        else if ($this->fieldHelper->hasAssignedUserField()) {
            $orGroup['assignedUserId'] = $this->user->getId();
        }
        else if ($this->fieldHelper->hasCreatedByField()) {
            $orGroup['createdById'] = $this->user->getId();
        }

        $subQuery = $subQueryBuilder
            ->where(['OR' => $orGroup])
            ->build();

        $queryBuilder->where(['id=s' => $subQuery]);
    }
}
