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

namespace Espo\Core\Acl\AccessChecker;

use Espo\Core\Acl\AccessChecker;
use Espo\Core\Acl\DefaultAccessChecker;
use Espo\Core\Acl\Exceptions\NotImplemented;
use Espo\Core\AclManager;
use Espo\Core\Binding\Binder;
use Espo\Core\Binding\BindingContainer;
use Espo\Core\Binding\BindingData;
use Espo\Core\InjectableFactory;
use Espo\Core\Utils\ClassFinder;
use Espo\Core\Utils\Metadata;

class AccessCheckerFactory
{
    /** @var class-string<AccessChecker> */
    private string $defaultClassName = DefaultAccessChecker::class;

    public function __construct(
        private ClassFinder $classFinder,
        private Metadata $metadata,
        private InjectableFactory $injectableFactory
    ) {}

    /**
     * Create an access checker.
     *
     * @throws NotImplemented
     */
    public function create(string $scope, AclManager $aclManager): AccessChecker
    {
        $className = $this->getClassName($scope);

        $bindingContainer = $this->createBindingContainer($aclManager);

        return $this->injectableFactory->createWithBinding($className, $bindingContainer);
    }

    /**
     * @return class-string<AccessChecker>
     * @throws NotImplemented
     */
    private function getClassName(string $scope): string
    {
        /** @var ?class-string<AccessChecker> $className1 */
        $className1 = $this->metadata->get(['aclDefs', $scope, 'accessCheckerClassName']);

        if ($className1) {
            return $className1;
        }

        if (!$this->metadata->get(['scopes', $scope])) {
            throw new NotImplemented("Access checker is not implemented for '{$scope}'.");
        }

        // For backward compatibility.
        $className2 = $this->classFinder->find('Acl', $scope);

        if ($className2) {
            /** @var class-string<AccessChecker> */
            return $className2;
        }

        return $this->defaultClassName;
    }

    private function createBindingContainer(AclManager $aclManager): BindingContainer
    {
        $bindingData = new BindingData();

        $binder = new Binder($bindingData);
        $binder->bindInstance(AclManager::class, $aclManager);

        return new BindingContainer($bindingData);
    }
}
