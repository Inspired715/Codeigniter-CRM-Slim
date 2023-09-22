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

namespace Espo\Core\ORM;

use Espo\Core\Interfaces\Injectable;

use Espo\ORM\{
    EntityFactory,
    Repository\RDBRepository as RDBRepository,
};

/**
 * @deprecated As of v6.0. Not to be extended. Extend Espo\Core\Repositories\Database, or better
 * don't extend repositories at all. Use hooks.
 * @extends RDBRepository<Entity>
 */
abstract class Repository extends RDBRepository implements Injectable
{
    protected $dependencyList = []; /** @phpstan-ignore-line */

    protected $dependencies = []; /** @phpstan-ignore-line */

    protected $injections = []; /** @phpstan-ignore-line */

    protected function init() /** @phpstan-ignore-line */
    {
    }

    public function inject($name, $object) /** @phpstan-ignore-line */
    {
        $this->injections[$name] = $object;
    }

    protected function getInjection($name) /** @phpstan-ignore-line */
    {
        return $this->injections[$name];
    }

    public function getDependencyList() /** @phpstan-ignore-line */
    {
        return array_merge($this->dependencyList, $this->dependencies);
    }

    protected function addDependencyList(array $list) /** @phpstan-ignore-line */
    {
        foreach ($list as $item) {
            $this->addDependency($item);
        }
    }

    protected function addDependency($name) /** @phpstan-ignore-line */
    {
        $this->dependencyList[] = $name;
    }

    /**
     * @param string $entityType
     */
    public function __construct($entityType, EntityManager $entityManager, EntityFactory $entityFactory)
    {
        parent::__construct($entityType, $entityManager, $entityFactory);
        $this->init();
    }
}
