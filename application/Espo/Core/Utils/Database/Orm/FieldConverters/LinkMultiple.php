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

namespace Espo\Core\Utils\Database\Orm\FieldConverters;

use Espo\Core\Utils\Database\Orm\Defs\AttributeDefs;
use Espo\Core\Utils\Database\Orm\Defs\EntityDefs;
use Espo\Core\Utils\Database\Orm\FieldConverter;
use Espo\ORM\Defs\FieldDefs;
use Espo\ORM\Type\AttributeType;

class LinkMultiple implements FieldConverter
{
    public function convert(FieldDefs $fieldDefs, string $entityType): EntityDefs
    {
        $name = $fieldDefs->getName();

        $idsName = $name . 'Ids';
        $namesName = $name . 'Names';
        $columnsName = $name . 'Columns';

        $idsDefs = AttributeDefs::create($idsName)
            ->withType(AttributeType::JSON_ARRAY)
            ->withNotStorable()
            ->withParamsMerged([
                'isLinkMultipleIdList' => true,
                'relation' => $name,
                'isUnordered' => true,
                'attributeRole' => 'idList',
                'fieldType' => 'linkMultiple',
            ]);

        $namesDefs = AttributeDefs::create($namesName)
            ->withType(AttributeType::JSON_OBJECT)
            ->withNotStorable()
            ->withParamsMerged([
                'isLinkMultipleNameMap' => true,
                'attributeRole' => 'nameMap',
                'fieldType' => 'linkMultiple',
            ]);

        $orderBy = $fieldDefs->getParam('orderBy');
        $orderDirection = $fieldDefs->getParam('orderDirection');

        if ($orderBy) {
            $idsDefs = $idsDefs->withParam('orderBy', $orderBy);

            if ($orderDirection !== null) {
                $idsDefs = $idsDefs->withParam('orderDirection', $orderDirection);
            }
        }

        $columns = $fieldDefs->getParam('columns');

        $columnsDefs = $columns ?
            AttributeDefs::create($columnsName)
                ->withType(AttributeType::JSON_OBJECT)
                ->withNotStorable()
                ->withParamsMerged([
                    'columns' => $columns,
                    'attributeRole' => 'columnsMap',
                ])
            : null;

        $entityDefs = EntityDefs::create()
            ->withAttribute($idsDefs)
            ->withAttribute($namesDefs);

        if ($columnsDefs) {
            $entityDefs = $entityDefs->withAttribute($columnsDefs);
        }

        return $entityDefs;
    }
}
