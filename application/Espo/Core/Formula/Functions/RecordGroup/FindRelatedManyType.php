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

namespace Espo\Core\Formula\Functions\RecordGroup;

use Espo\Core\ORM\Entity as CoreEntity;
use Espo\Core\Formula\ArgumentList;
use Espo\Core\Formula\Functions\BaseFunction;
use Espo\Core\Di;

class FindRelatedManyType extends BaseFunction implements
    Di\EntityManagerAware,
    Di\SelectBuilderFactoryAware,
    Di\MetadataAware
{
    use Di\EntityManagerSetter;
    use Di\SelectBuilderFactorySetter;
    use Di\MetadataSetter;

    public function process(ArgumentList $args)
    {
        $args = $this->evaluate($args);

        if (count($args) < 4) {
            $this->throwTooFewArguments(4);
        }

        $entityManager = $this->entityManager;

        $entityType = $args[0];
        $id = $args[1];
        $link = $args[2];
        $limit = $args[3];

        $orderBy = null;
        $order = null;

        if (count($args) > 4) {
            $orderBy = $args[4];
        }

        if (count($args) > 5) {
            $order = $args[5];
        }

        if (!$entityType || !is_string($entityType)) {
            $this->throwBadArgumentType(1, 'string');
        }

        if (!$id) {
            $this->log("Empty ID.");

            return [];
        }

        if (!is_string($id)) {
            $this->throwBadArgumentType(2, 'string');
        }

        if (!$link || !is_string($link)) {
            $this->throwBadArgumentType(3, 'string');
        }

        if (!is_int($limit)) {
            $this->throwBadArgumentType(4, 'string');
        }

        $entity = $entityManager->getEntity($entityType, $id);

        if (!$entity) {
            $this->log("record\\findRelatedMany: Entity $entityType $id not found.", 'notice');

            return [];
        }

        $metadata = $this->metadata;

        if (!$orderBy) {
            $orderBy = $metadata->get(['entityDefs', $entityType, 'collection', 'orderBy']);

            if (is_null($order)) {
                $order = $metadata->get(['entityDefs', $entityType, 'collection', 'order']) ?? 'asc';
            }
        }
        else {
            $order = $order ?? 'asc';
        }

        if (!$entity instanceof CoreEntity) {
            $this->throwError("Only core entities are supported.");
        }

        $relationType = $entity->getRelationParam($link, 'type');

        if (in_array($relationType, ['belongsTo', 'hasOne', 'belongsToParent'])) {
            $this->throwError("Not supported link type '$relationType'.");
        }

        $foreignEntityType = $entity->getRelationParam($link, 'entity');

        if (!$foreignEntityType) {
            $this->throwError("Bad or not supported link '$link'.");
        }

        $foreignLink = $entity->getRelationParam($link, 'foreign');

        if (!$foreignLink) {
            $this->throwError("Not supported link '$link'.");
        }

        $builder = $this->selectBuilderFactory
            ->create()
            ->from($foreignEntityType);

        $whereClause = [];

        if (count($args) <= 7) {
            $filter = null;
            if (count($args) == 7) {
                $filter = $args[6];
            }

            if ($filter && !is_string($filter)) {
                $this->throwError("Bad filter.");
            }

            if ($filter) {
                $builder->withPrimaryFilter($filter);
            }
        }
        else {
            $i = 6;

            while ($i < count($args) - 1) {
                $key = $args[$i];
                $value = $args[$i + 1];

                $whereClause[] = [$key => $value];

                $i = $i + 2;
            }
        }

        $queryBuilder = $builder->buildQueryBuilder();

        if (!empty($whereClause)) {
            $queryBuilder->where($whereClause);
        }

        if ($relationType === 'hasChildren') {
            $queryBuilder->where([
                $foreignLink . 'Id' => $entity->getId(),
                $foreignLink . 'Type' => $entity->getEntityType(),
            ]);
        }
        else {
            $queryBuilder
                ->join($foreignLink)
                ->where([
                    $foreignLink . '.id' => $entity->getId(),
                ]);
        }

        $queryBuilder->limit(0, $limit);

        if ($orderBy) {
            $queryBuilder->order($orderBy, $order);
        }

        $collection = $entityManager
            ->getRDBRepository($foreignEntityType)
            ->clone($queryBuilder->build())
            ->select(['id'])
            ->find();

        $idList = [];

        foreach ($collection as $e) {
            $idList[] = $e->getId();
        }

        return $idList;
    }
}
