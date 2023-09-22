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

namespace Espo\Controllers;

use Espo\Tools\PopupNotification\Service as Service;

use stdClass;

class PopupNotification
{
    private Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function getActionGrouped(): stdClass
    {
        $grouped = $this->service->getGrouped();

        $result = (object) [];

        foreach ($grouped as $type => $itemList) {
            $rawList = array_map(
                function ($item) {
                    return (object) [
                        'id' => $item->getId(),
                        'data' => $item->getData(),
                    ];
                },
                $itemList
            );
            $result->$type = $rawList;
        }

        return $result;
    }
}
