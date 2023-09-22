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

namespace Espo\Modules\Crm\Controllers;

use Espo\Core\Controllers\Record;
use Espo\Core\Exceptions\BadRequest;
use Espo\Core\Api\Request;
use Espo\Core\Exceptions\Error;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Exceptions\NotFound;
use Espo\Core\Select\Where\Item as WhereItem;
use Espo\Core\Utils\Json;
use Espo\Modules\Crm\Tools\KnowledgeBase\Service as KBService;

use Espo\Tools\Attachment\FieldData;
use stdClass;

class KnowledgeBaseArticle extends Record
{
    /**
     * @throws BadRequest
     * @throws Forbidden
     * @throws NotFound
     */
    public function postActionGetCopiedAttachments(Request $request): stdClass
    {
        $data = $request->getParsedBody();

        $id = $data->id ?? null;
        $field = $data->field ?? null;
        $parentType = $data->parentType ?? null;
        $relatedType = $data->relatedType ?? null;

        if (!$id || !$field) {
            throw new BadRequest("No `id` or `field`.");
        }

        try {
            $fieldData = new FieldData(
                $field,
                $parentType,
                $relatedType
            );
        }
        catch (Error $e) {
            throw new BadRequest($e->getMessage());
        }

        $list = $this->getArticleService()->copyAttachments($id, $fieldData);

        $ids = array_map(
            fn ($item) => $item->getId(),
            $list
        );

        $names = (object) [];

        foreach ($list as $item) {
            $names->{$item->getId()} = $item->getName();
        }

        return (object) [
            'ids' => $ids,
            'names' => $names,
        ];
    }

    /**
     * @throws BadRequest
     * @throws Forbidden
     * @throws Error
     * @throws NotFound
     */
    public function postActionMoveToTop(Request $request): bool
    {
        $data = $request->getParsedBody();

        if (empty($data->id)) {
            throw new BadRequest();
        }

        $where = null;

        if (!empty($data->where)) {
            $where = WhereItem::fromRawAndGroup(
                Json::decode(Json::encode($data->where), true)
            );
        }

        $this->getArticleService()->moveToTop($data->id, $where);

        return true;
    }

    /**
     * @throws BadRequest
     * @throws Forbidden
     * @throws Error
     * @throws NotFound
     */
    public function postActionMoveUp(Request $request): bool
    {
        $data = $request->getParsedBody();

        if (empty($data->id)) {
            throw new BadRequest();
        }

        $where = null;

        if (!empty($data->where)) {
            $where = WhereItem::fromRawAndGroup(
                Json::decode(Json::encode($data->where), true)
            );
        }

        $this->getArticleService()->moveUp($data->id, $where);

        return true;
    }

    /**
     * @throws BadRequest
     * @throws Forbidden
     * @throws Error
     * @throws NotFound
     */
    public function postActionMoveDown(Request $request): bool
    {
        $data = $request->getParsedBody();

        if (empty($data->id)) {
            throw new BadRequest();
        }

        $where = null;

        if (!empty($data->where)) {
            $where = WhereItem::fromRawAndGroup(
                Json::decode(Json::encode($data->where), true)
            );
        }

        $this->getArticleService()->moveDown($data->id, $where);

        return true;
    }

    /**
     * @throws BadRequest
     * @throws Forbidden
     * @throws Error
     * @throws NotFound
     */
    public function postActionMoveToBottom(Request $request): bool
    {
        $data = $request->getParsedBody();

        if (empty($data->id)) {
            throw new BadRequest();
        }

        $where = null;

        if (!empty($data->where)) {
            $where = WhereItem::fromRawAndGroup(
                Json::decode(Json::encode($data->where), true)
            );
        }

        $this->getArticleService()->moveToBottom($data->id, $where);

        return true;
    }

    private function getArticleService(): KBService
    {
        return $this->injectableFactory->create(KBService::class);
    }
}
