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

use Espo\Core\Acl;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Select\SelectBuilderFactory;
use Espo\Core\Utils\Config;
use Espo\Core\Utils\Metadata;
use Espo\Modules\Crm\Entities\Opportunity;
use Espo\ORM\EntityManager;
use Espo\ORM\Query\Part\Expression;
use Espo\ORM\Query\Part\Order;
use stdClass;

class ByLeadSource
{
    private Acl $acl;
    private Config $config;
    private Metadata $metadata;
    private EntityManager $entityManager;
    private SelectBuilderFactory $selectBuilderFactory;
    private Util $util;

    public function __construct(
        Acl $acl,
        Config $config,
        Metadata $metadata,
        EntityManager $entityManager,
        SelectBuilderFactory $selectBuilderFactory,
        Util $util
    ) {
        $this->acl = $acl;
        $this->config = $config;
        $this->metadata = $metadata;
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

        $options = $this->metadata->get('entityDefs.Lead.fields.source.options', []);

        $queryBuilder = $this->selectBuilderFactory
            ->create()
            ->from(Opportunity::ENTITY_TYPE)
            ->withStrictAccessControl()
            ->buildQueryBuilder();

        $whereClause = [
            ['stage!=' => $this->util->getLostStageList()],
            ['leadSource!=' => ''],
            ['leadSource!=' => null],
        ];

        if ($from && $to) {
            $whereClause[] = [
                'closeDate>=' => $from->getString(),
                'closeDate<' => $to->getString(),
            ];
        }

        if ($from && !$to) {
            $whereClause[] = [
                'closeDate>=' => $from->getString(),
            ];
        }

        if (!$from && $to) {
            $whereClause[] = [
                'closeDate<' => $to->getString(),
            ];
        }

        $queryBuilder
            ->select([
                'leadSource',
                ['SUM:amountWeightedConverted', 'amount'],
            ])
            ->order(
                Order::createByPositionInList(
                    Expression::column('leadSource'),
                    $options
                )
            )
            ->group('leadSource')
            ->where($whereClause);

        $this->util->handleDistinctReportQueryBuilder($queryBuilder, $whereClause);

        $sth = $this->entityManager
            ->getQueryExecutor()
            ->execute($queryBuilder->build());

        $rowList = $sth->fetchAll() ?: [];

        $result = [];

        foreach ($rowList as $row) {
            $leadSource = $row['leadSource'];

            $result[$leadSource] = floatval($row['amount']);
        }

        return (object) $result;
    }
}
