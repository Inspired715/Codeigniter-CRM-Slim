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

namespace Espo\Modules\Crm\Classes\FormulaFunctions\ExtGroup\CalendarGroup;

use Espo\Core\Field\DateTime;
use Espo\Core\Formula\EvaluatedArgumentList;
use Espo\Core\Formula\Exceptions\BadArgumentType;
use Espo\Core\Formula\Exceptions\TooFewArguments;
use Espo\Core\Formula\Func;
use Espo\Modules\Crm\Tools\Calendar\FetchParams;
use Espo\Modules\Crm\Tools\Calendar\Items\Event;
use Espo\Modules\Crm\Tools\Calendar\Service;
use Exception;
use RuntimeException;

class UserIsBusyType implements Func
{
    public function __construct(private Service $service) {}

    public function process(EvaluatedArgumentList $arguments): bool
    {
        if (count($arguments) < 3) {
            throw TooFewArguments::create(3);
        }

        $userId = $arguments[0];
        $from = $arguments[1];
        $to = $arguments[2];
        $entityType = $arguments[3] ?? null;
        $id = $arguments[4] ?? null;

        if (!is_string($userId)) {
            throw BadArgumentType::create(1, 'string');
        }

        if (!is_string($from)) {
            throw BadArgumentType::create(2, 'string');
        }

        if (!is_string($to)) {
            throw BadArgumentType::create(3, 'string');
        }

        if ($entityType !== null && !is_string($entityType)) {
            throw BadArgumentType::create(4, 'string');
        }

        if ($id !== null && !is_string($id)) {
            throw BadArgumentType::create(5, 'string');
        }

        $params = FetchParams::create(DateTime::fromString($from), DateTime::fromString($to))
            ->withSkipAcl();

        $ignoreList = [];

        if ($entityType && $id) {
            $ignoreList[] = (new Event(null, null, $entityType, []))->withId($id);
        }

        try {
            $ranges = $this->service->fetchBusyRanges($userId, $params, $ignoreList);
        }
        catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        return $ranges !== [];
    }
}
