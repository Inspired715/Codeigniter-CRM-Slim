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

namespace Espo\Modules\Crm\Tools\Opportunity\Report;

use DateTime;
use Espo\Core\Acl;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Select\SelectBuilderFactory;
use Espo\Core\Utils\Config;
use Espo\Modules\Crm\Entities\Opportunity;
use Espo\ORM\EntityManager;
use Exception;
use InvalidArgumentException;
use LogicException;
use stdClass;

class SalesByMonth
{
    private Acl $acl;
    private Config $config;
    private EntityManager $entityManager;
    private SelectBuilderFactory $selectBuilderFactory;
    private Util $util;

    public function __construct(
        Acl $acl,
        Config $config,
        EntityManager $entityManager,
        SelectBuilderFactory $selectBuilderFactory,
        Util $util
    ) {
        $this->acl = $acl;
        $this->config = $config;
        $this->entityManager = $entityManager;
        $this->selectBuilderFactory = $selectBuilderFactory;
        $this->util = $util;
    }

    /**
     * @throws Forbidden
     */
    public function run(DateRange $range): stdClass
    {
        $range = $range->withFiscalYearShift(
            $this->config->get('fiscalYearShift') ?? 0
        );

        if (!$this->acl->checkScope(Opportunity::ENTITY_TYPE, Acl\Table::ACTION_READ)) {
            throw new Forbidden();
        }

        if (in_array('amount', $this->acl->getScopeForbiddenAttributeList(Opportunity::ENTITY_TYPE))) {
            throw new Forbidden();
        }

        [$from, $to] = $range->getRange();

        if (!$from || !$to) {
            throw new InvalidArgumentException();
        }

        $queryBuilder = $this->selectBuilderFactory
            ->create()
            ->from(Opportunity::ENTITY_TYPE)
            ->withStrictAccessControl()
            ->buildQueryBuilder();

        $whereClause = [
            'stage' => $this->util->getWonStageList(),
        ];

        $whereClause[] = [
            'closeDate>=' => $from->getString(),
            'closeDate<' => $to->getString(),
        ];

        $queryBuilder
            ->select([
                ['MONTH:closeDate', 'month'],
                ['SUM:amountConverted', 'amount'],
            ])
            ->order('MONTH:closeDate')
            ->group('MONTH:closeDate')
            ->where($whereClause);

        $this->util->handleDistinctReportQueryBuilder($queryBuilder, $whereClause);

        $sth = $this->entityManager
            ->getQueryExecutor()
            ->execute($queryBuilder->build());

        $result = [];

        $rowList = $sth->fetchAll() ?: [];

        foreach ($rowList as $row) {
            $month = $row['month'];

            $result[$month] = floatval($row['amount']);
        }

        $dt = $from;
        $dtTo = $to;

        if ($dtTo->getDay() > 1) {
            $dtTo = $dtTo
                ->addDays(1 - $dtTo->getDay()) // First day of month.
                ->addMonths(1);
        }
        else {
            $dtTo = $dtTo->addDays(1 - $dtTo->getDay());
        }

        while ($dt->getTimestamp() < $dtTo->getTimestamp()) {
            $month = $dt->getDateTime()->format('Y-m');

            if (!array_key_exists($month, $result)) {
                $result[$month] = 0;
            }

            $dt = $dt->addMonths(1);
        }

        $keyList = array_keys($result);

        sort($keyList);

        $today = new DateTime();
        $endPosition = count($keyList);

        for ($i = count($keyList) - 1; $i >= 0; $i--) {
            $key = $keyList[$i];

            try {
                $dt = new DateTime($key . '-01');
            }
            catch (Exception $e) {
                throw new LogicException();
            }

            if ($dt->getTimestamp() < $today->getTimestamp()) {
                break;
            }

            if (empty($result[$key])) {
                $endPosition = $i;

                continue;
            }

            break;
        }

        $keyListSliced = array_slice($keyList, 0, $endPosition);

        return (object) [
            'keyList' => $keyListSliced,
            'dataMap' => $result,
        ];
    }
}
