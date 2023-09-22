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

namespace Espo\Modules\Crm\Classes\Select\Meeting\PrimaryFilters;

use Espo\Core\Exceptions\Error;
use Espo\Entities\User;
use Espo\Core\Select\Primary\Filter;
use Espo\ORM\Query\SelectBuilder;
use Espo\Core\Select\Helpers\UserTimeZoneProvider;
use Espo\Core\Select\Where\ConverterFactory;
use Espo\Core\Select\Where\Item;
use Espo\Modules\Crm\Entities\Meeting;
use LogicException;

class Todays implements Filter
{
    public function __construct(
        private User $user,
        private UserTimeZoneProvider $userTimeZoneProvider,
        private ConverterFactory $converterFactory
    ) {}

    public function apply(SelectBuilder $queryBuilder): void
    {
        $item = Item::fromRaw([
            'type' => Item\Type::TODAY,
            'attribute' => 'dateStart',
            'timeZone' => $this->userTimeZoneProvider->get(),
            'dateTime' => true,
        ]);

        try {
            $whereItem = $this->converterFactory
                ->create(Meeting::ENTITY_TYPE, $this->user)
                ->convert($queryBuilder, $item);
        }
        catch (Error $e) {
            throw new LogicException($e->getMessage());
        }

        $queryBuilder->where($whereItem);
    }
}
