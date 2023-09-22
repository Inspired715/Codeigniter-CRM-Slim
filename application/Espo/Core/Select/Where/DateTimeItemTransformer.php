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

namespace Espo\Core\Select\Where;

use Espo\Core\Exceptions\Error;
use Espo\Core\Utils\DateTime as DateTimeUtil;
use Espo\Core\Utils\Config;
use Espo\Core\Select\Where\Item\Type;
use Espo\Entities\User;

use DateTime;
use DateTimeZone;
use DateInterval;

/**
 * Transforms date-time where item. Applies timezone.
 */
class DateTimeItemTransformer
{
    public function __construct(protected User $user, private Config $config)
    {}

    /**
     * @throws Error
     */
    public function transform(Item $item): Item
    {
        $format = DateTimeUtil::SYSTEM_DATE_TIME_FORMAT;

        $type = $item->getType();
        $value = $item->getValue();
        $attribute = $item->getAttribute();

        $data = $item->getData();

        if (!$data instanceof Item\Data\DateTime) {
            throw new Error("Bad where item.");
        }

        $timeZone = $data->getTimeZone() ?? 'UTC';

        if (!$attribute) {
            throw new Error("Bad datetime where item. Empty 'attribute'.");
        }

        if (!$type) {
            throw new Error("Bad datetime where item. Empty 'type'.");
        }

        if (
            empty($value) &&
            in_array(
                $type,
                [
                    Type::ON,
                    Type::BEFORE,
                    Type::AFTER,
                ]
            )
        ) {
            throw new Error("Bad where item. Empty value.");
        }

        $where = [
            'attribute' => $attribute,
        ];

        $dt = new DateTime('now', new DateTimeZone($timeZone));

        switch ($type) {
            case Type::TODAY:
                $where['type'] = Type::BETWEEN;

                $dt->setTime(0, 0, 0);

                $dtTo = clone $dt;
                $dtTo->modify('+1 day -1 second');
                $dt->setTimezone(new DateTimeZone('UTC'));
                $dtTo->setTimezone(new DateTimeZone('UTC'));

                $from = $dt->format($format);
                $to = $dtTo->format($format);

                $where['value'] = [$from, $to];

                break;

            case Type::PAST:
                $where['type'] = Type::BEFORE;

                $dt->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = $dt->format($format);

                break;

            case Type::FUTURE:
                $where['type'] = Type::AFTER;

                $dt->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = $dt->format($format);

                break;

            case 'lastSevenDays':
                $where['type'] = Type::BETWEEN;

                $dtFrom = clone $dt;

                $dt->setTimezone(new DateTimeZone('UTC'));
                $to = $dt->format($format);

                $dtFrom->modify('-7 day');
                $dtFrom->setTime(0, 0, 0);
                $dtFrom->setTimezone(new DateTimeZone('UTC'));

                $from = $dtFrom->format($format);

                $where['value'] = [$from, $to];

                break;

            case Type::LAST_X_DAYS:
                $where['type'] = Type::BETWEEN;

                $dtFrom = clone $dt;

                $dt->setTimezone(new DateTimeZone('UTC'));

                $to = $dt->format($format);

                $number = strval(intval($value));

                $dtFrom->modify('-'.$number.' day');
                $dtFrom->setTime(0, 0, 0);
                $dtFrom->setTimezone(new DateTimeZone('UTC'));

                $from = $dtFrom->format($format);

                $where['value'] = [$from, $to];

                break;

            case Type::NEXT_X_DAYS:
                $where['type'] = Type::BETWEEN;

                $dtTo = clone $dt;

                $dt->setTimezone(new DateTimeZone('UTC'));

                $from = $dt->format($format);

                $number = strval(intval($value));

                $dtTo->modify('+'.$number.' day');
                $dtTo->setTime(24, 59, 59);
                $dtTo->setTimezone(new DateTimeZone('UTC'));

                $to = $dtTo->format($format);

                $where['value'] = [$from, $to];

                break;

            case Type::OLDER_THAN_X_DAYS:
                $where['type'] = Type::BEFORE;

                $number = strval(intval($value));

                $dt->modify('-'.$number.' day');
                $dt->setTime(0, 0, 0);
                $dt->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = $dt->format($format);

                break;

            case Type::AFTER_X_DAYS:
                $where['type'] = Type::AFTER;

                $number = strval(intval($value));

                $dt->modify('+'.$number.' day');
                $dt->setTime(0, 0, 0);
                $dt->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = $dt->format($format);

                break;

            case Type::ON:
                $where['type'] = Type::BETWEEN;

                $dt = new DateTime($value, new DateTimeZone($timeZone));
                $dtTo = clone $dt;

                if (strlen($value) <= 10) {
                    $dtTo->modify('+1 day -1 second');
                }

                $dt->setTimezone(new DateTimeZone('UTC'));
                $dtTo->setTimezone(new DateTimeZone('UTC'));

                $from = $dt->format($format);
                $to = $dtTo->format($format);

                $where['value'] = [$from, $to];

                break;

            case Type::BEFORE:
                $where['type'] = Type::BEFORE;

                $dt = new DateTime($value, new DateTimeZone($timeZone));
                $dt->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = $dt->format($format);

                break;

            case Type::AFTER:
                $where['type'] = Type::AFTER;

                $dt = new DateTime($value, new DateTimeZone($timeZone));

                if (strlen($value) <= 10) {
                    $dt->modify('+1 day -1 second');
                }

                $dt->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = $dt->format($format);

                break;

            case Type::BETWEEN:
                $where['type'] = Type::BETWEEN;

                if (!is_array($value) || count($value) < 2) {
                    throw new Error("Bad where item. Bad value.");
                }

                $dt = new DateTime($value[0], new DateTimeZone($timeZone));
                $dt->setTimezone(new DateTimeZone('UTC'));

                $from = $dt->format($format);

                $dt = new DateTime($value[1], new DateTimeZone($timeZone));
                $dt->setTimezone(new DateTimeZone('UTC'));

                if (strlen($value[1]) <= 10) {
                    $dt->modify('+1 day -1 second');
                }

                $to = $dt->format($format);

                $where['value'] = [$from, $to];

                break;

            case Type::CURRENT_MONTH:
            case Type::LAST_MONTH:
            case Type::NEXT_MONTH:
                $where['type'] = Type::BETWEEN;

                $dtFrom = $dt->modify('first day of this month')->setTime(0, 0, 0);

                if ($type == Type::LAST_MONTH) {
                    $dtFrom->modify('-1 month');
                }
                else if ($type == Type::NEXT_MONTH) {
                    $dtFrom->modify('+1 month');
                }

                $dtTo = clone $dtFrom;
                $dtTo->modify('+1 month');

                $dtFrom->setTimezone(new DateTimeZone('UTC'));
                $dtTo->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = [$dtFrom->format($format), $dtTo->format($format)];

                break;

            case Type::CURRENT_QUARTER:
            case Type::LAST_QUARTER:
                $where['type'] = Type::BETWEEN;

                $dt = new DateTime('now', new DateTimeZone($timeZone));
                $quarter = ceil($dt->format('m') / 3);

                $dtFrom = clone $dt;
                $dtFrom->modify('first day of January this year')->setTime(0, 0, 0);

                if ($type === Type::LAST_QUARTER) {
                    $quarter--;

                    if ($quarter == 0) {
                        $quarter = 4;
                        $dtFrom->modify('-1 year');
                    }
                }

                $dtFrom->add(new DateInterval('P'.(($quarter - 1) * 3).'M'));
                $dtTo = clone $dtFrom;
                $dtTo->add(new DateInterval('P3M'));
                $dtFrom->setTimezone(new DateTimeZone('UTC'));
                $dtTo->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = [
                    $dtFrom->format($format),
                    $dtTo->format($format),
                ];

                break;

            case Type::CURRENT_YEAR:
            case Type::LAST_YEAR:
                $where['type'] = Type::BETWEEN;

                $dtFrom = new DateTime('now', new DateTimeZone($timeZone));
                $dtFrom->modify('first day of January this year')->setTime(0, 0, 0);

                if ($type == Type::LAST_YEAR) {
                    $dtFrom->modify('-1 year');
                }

                $dtTo = clone $dtFrom;
                $dtTo = $dtTo->modify('+1 year');
                $dtFrom->setTimezone(new DateTimeZone('UTC'));
                $dtTo->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = [
                    $dtFrom->format($format),
                    $dtTo->format($format),
                ];

                break;

            case Type::CURRENT_FISCAL_YEAR:
            case Type::LAST_FISCAL_YEAR:
                $where['type'] = Type::BETWEEN;

                $dtToday = new DateTime('now', new DateTimeZone($timeZone));
                $dt = clone $dtToday;
                $fiscalYearShift = $this->config->get('fiscalYearShift', 0);

                $dt
                    ->modify('first day of January this year')
                    ->modify('+' . $fiscalYearShift . ' months')
                    ->setTime(0, 0, 0);

                if (intval($dtToday->format('m')) < $fiscalYearShift + 1) {
                    $dt->modify('-1 year');
                }

                if ($type === Type::LAST_FISCAL_YEAR) {
                    $dt->modify('-1 year');
                }

                $dtFrom = clone $dt;
                $dtTo = clone $dt;
                $dtTo = $dtTo->modify('+1 year');

                $dtFrom->setTimezone(new DateTimeZone('UTC'));
                $dtTo->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = [
                    $dtFrom->format($format),
                    $dtTo->format($format),
                ];

                break;

            case Type::CURRENT_FISCAL_QUARTER:
            case Type::LAST_FISCAL_QUARTER:
                $where['type'] = Type::BETWEEN;

                $dtToday = new DateTime('now', new DateTimeZone($timeZone));

                $dt = clone $dtToday;

                $fiscalYearShift = $this->config->get('fiscalYearShift', 0);

                $dt
                    ->modify('first day of January this year')
                    ->modify('+' . $fiscalYearShift . ' months')
                    ->setTime(0, 0, 0);

                $month = intval($dtToday->format('m'));

                $quarterShift = floor(($month - $fiscalYearShift - 1) / 3);

                if ($quarterShift) {
                    if ($quarterShift >= 0) {
                        $dt->add(new DateInterval('P' . ($quarterShift * 3) . 'M'));
                    } else {
                        $quarterShift *= -1;
                        $dt->sub(new DateInterval('P' . ($quarterShift * 3) . 'M'));
                    }
                }

                if ($type === Type::LAST_FISCAL_QUARTER) {
                    $dt->modify('-3 months');
                }

                $dtFrom = clone $dt;
                $dtTo = clone $dt;
                $dtTo = $dtTo->modify('+3 months');

                $dtFrom->setTimezone(new DateTimeZone('UTC'));
                $dtTo->setTimezone(new DateTimeZone('UTC'));

                $where['value'] = [
                    $dtFrom->format($format),
                    $dtTo->format($format),
                ];

                break;

            default:
                $where['type'] = $type;
        }

        return Item::fromRaw($where);
    }
}
