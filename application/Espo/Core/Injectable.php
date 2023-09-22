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

namespace Espo\Core;

/**
 * @deprecated As of v6.0. Use the dependency injection framework.
 */
abstract class Injectable implements \Espo\Core\Interfaces\Injectable
{
    protected $dependencyList = []; /** @phpstan-ignore-line */

    protected $injections = []; /** @phpstan-ignore-line */

    public function inject($name, $object) /** @phpstan-ignore-line */
    {
        $this->injections[$name] = $object;
    }

    public function __construct() /** @phpstan-ignore-line */
    {
        $this->init();
    }

    protected function init() /** @phpstan-ignore-line */
    {
    }

    public function __call($methodName, $args) /** @phpstan-ignore-line */
    {
        if (strpos($methodName, 'get') === 0) {
            $injectionName = lcfirst(substr($methodName, 3));
            if (in_array($injectionName, $this->dependencyList)) {
                return $this->getInjection($injectionName);
            }
        }
        throw new \BadMethodCallException('Method ' . $methodName . ' does not exist');
    }

    protected function getInjection($name) /** @phpstan-ignore-line */
    {
        return $this->injections[$name] ?? $this->$name ?? null;
    }

    protected function addDependency($name) /** @phpstan-ignore-line */
    {
        if (in_array($name, $this->dependencyList)) return;
        $this->dependencyList[] = $name;
    }

    protected function addDependencyList(array $list) /** @phpstan-ignore-line */
    {
        foreach ($list as $item) {
            $this->addDependency($item);
        }
    }

    public function getDependencyList() /** @phpstan-ignore-line */
    {
        return $this->dependencyList;
    }
}
