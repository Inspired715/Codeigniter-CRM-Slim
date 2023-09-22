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

namespace Espo\Core\Controllers;

use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Exceptions\BadRequest;
use Espo\Core\Exceptions\Error;

use Espo\Services\RecordTree as Service;
use Espo\Core\Api\Request;

use stdClass;

class RecordTree extends Record
{
    /**
     * @var string
     */
    public static $defaultAction = 'list';

    /**
     * Get a category tree.
     *
     * @throws BadRequest
     * @throws Error
     * @throws Forbidden
     * @throws \Espo\Core\Exceptions\NotFound
     */
    public function getActionListTree(Request $request): stdClass
    {
        if (method_exists($this, 'actionListTree')) {
            // For backward compatibility.
            return (object) $this->actionListTree($request->getRouteParams(), $request->getParsedBody(), $request);
        }

        $where = $request->getQueryParams()['where'] ?? null;
        $parentId = $request->getQueryParam('parentId');
        $maxDepth = $request->getQueryParam('maxDepth');
        $onlyNotEmpty = (bool) $request->getQueryParam('onlyNotEmpty');

        if ($where !== null && !is_array($where)) {
            throw new BadRequest();
        }

        if ($maxDepth !== null) {
            $maxDepth = (int) $maxDepth;
        }

        $collection = $this->getRecordTreeService()->getTree(
            $parentId,
            [
                'where' => $where,
                'onlyNotEmpty' => $onlyNotEmpty,
            ],
            $maxDepth
        );

        if (!$collection) {
            throw new Error();
        }

        return (object) [
            'list' => $collection->getValueMapList(),
            'path' => $this->getRecordTreeService()->getTreeItemPath($parentId),
            'data' => $this->getRecordTreeService()->getCategoryData($parentId),
        ];
    }

    /**
     * @return string[]
     * @throws Forbidden
     */
    public function getActionLastChildrenIdList(Request $request): array
    {
        if (!$this->acl->check($this->name, 'read')) {
            throw new Forbidden();
        }

        $parentId = $request->getQueryParam('parentId');

        return $this->getRecordTreeService()->getLastChildrenIdList($parentId);
    }

    /**
     * @return Service<\Espo\Core\ORM\Entity>
     */
    protected function getRecordTreeService(): Service
    {
        $service = $this->getRecordService();

        assert($service instanceof Service);

        return $service;
    }
}
