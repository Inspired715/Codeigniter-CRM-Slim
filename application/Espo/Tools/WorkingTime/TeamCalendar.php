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

namespace Espo\Tools\WorkingTime;

use Espo\Core\Utils\Config;
use Espo\Entities\Team;
use Espo\Entities\WorkingTimeCalendar;
use Espo\Entities\WorkingTimeRange;
use Espo\ORM\EntityManager;
use Espo\ORM\Query\Part\Condition;
use Espo\ORM\Query\Part\Expression;
use Espo\ORM\Query\Part\Where\OrGroup;
use Espo\Tools\WorkingTime\Calendar\WorkingWeekday;
use Espo\Tools\WorkingTime\Calendar\WorkingDate;

use Espo\Core\Field\Date;

use DateTimeZone;
use Espo\Tools\WorkingTime\Util\CalendarUtil;

class TeamCalendar implements Calendar
{
    private Team $team;
    private EntityManager $entityManager;
    private Config $config;

    private ?WorkingTimeCalendar $workingTimeCalendar = null;
    private ?CalendarUtil $util = null;

    /** @var ?array{WorkingDate[], WorkingDate[]} */
    private ?array $cache = null;
    private ?string $cacheKey = null;
    private DateTimeZone $timezone;

    /**
     * @param Team $team
     * @param EntityManager $entityManager
     * @param Config $config
     */
    public function __construct(Team $team, EntityManager $entityManager, Config $config)
    {
        $this->team = $team;
        $this->entityManager = $entityManager;
        $this->config = $config;

        $this->timezone = new DateTimeZone($config->get('timeZone'));

        $this->init();

        if (!$this->workingTimeCalendar) {
            $this->initDefault();
        }

        if ($this->workingTimeCalendar) {
            $this->util = new CalendarUtil($this->workingTimeCalendar);

            $this->timezone = $this->workingTimeCalendar->getTimeZone() ?? $this->timezone;
        }
    }

    private function init(): void
    {
        $workingTimeCalendarLink = $this->team->getWorkingTimeCalendar();

        if (!$workingTimeCalendarLink) {
            return;
        }

        $this->workingTimeCalendar = $this->entityManager
            ->getRepositoryByClass(WorkingTimeCalendar::class)
            ->getById($workingTimeCalendarLink->getId());
    }

    private function initDefault(): void
    {
        $id = $this->config->get('workingTimeCalendarId');

        if (!$id) {
            return;
        }

        $this->workingTimeCalendar = $this->entityManager->getEntityById(WorkingTimeCalendar::ENTITY_TYPE, $id);
    }

    public function isAvailable(): bool
    {
        return $this->workingTimeCalendar !== null;
    }

    public function getTimezone(): DateTimeZone
    {
        return $this->timezone;
    }

    /**
     * @return WorkingWeekday[]
     */
    public function getWorkingWeekdays(): array
    {
        if ($this->workingTimeCalendar === null) {
            return [];
        }

        return $this->workingTimeCalendar->getWorkingWeekdays();
    }

    /**
     * @return WorkingDate[]
     */
    public function getNonWorkingDates(Date $from, Date $to): array
    {
        if ($this->workingTimeCalendar === null) {
            return [];
        }

        return $this->getDates($from, $to)[0];
    }

    /**
     * @return WorkingDate[]
     */
    public function getWorkingDates(Date $from, Date $to): array
    {
        if ($this->workingTimeCalendar === null) {
            return [];
        }

        return $this->getDates($from, $to)[1];
    }

    /**
     * @return array{WorkingDate[], WorkingDate[]}
     */
    private function getDates(Date $from, Date $to): array
    {
        $cacheKey = $from->getString() . '-' . $to->getString();

        if ($this->cacheKey === $cacheKey) {
            assert($this->cache !== null);

            return $this->cache;
        }

        $notWorkingList = [];
        $workingList = [];

        $list = $this->fetchRanges($from, $to);

        foreach ($list as $range) {
            $dates = $this->rangeToDates($range);

            if ($range->getType() === WorkingTimeRange::TYPE_NON_WORKING) {
                $notWorkingList = array_merge($notWorkingList, $dates);

                continue;
            }

            $workingList = array_merge($workingList, $dates);
        }

        $this->cacheKey = $cacheKey;
        $this->cache = [$notWorkingList, $workingList];

        return $this->cache;
    }

    /**
     * @param WorkingTimeRange $range
     * @return WorkingDate[]
     */
    private function rangeToDates(WorkingTimeRange $range): array
    {
        if (!$this->util) {
            return [];
        }

        return $this->util->rangeToDates($range);
    }

    /**
     * @return WorkingTimeRange[]
     */
    private function fetchRanges(Date $from, Date $to): array
    {
        if ($this->workingTimeCalendar === null) {
            return [];
        }

        $list = [];

        $collection = $this->entityManager
            ->getRDBRepositoryByClass(WorkingTimeRange::class)
            ->leftJoin('calendars')
            ->where(
                Condition::equal(
                    Expression::column('calendars.id'),
                    $this->workingTimeCalendar->getId()
                )
            )
            ->where(
                OrGroup::create(
                    Condition::greaterOrEqual(
                        Expression::column('dateEnd'),
                        $from->getString()
                    ),
                    Condition::lessOrEqual(
                        Expression::column('dateStart'),
                        $to->getString()
                    ),
                )
            )
            ->find();

        foreach ($collection as $entity) {
            $list[] = $entity;
        }

        return $list;
    }
}
