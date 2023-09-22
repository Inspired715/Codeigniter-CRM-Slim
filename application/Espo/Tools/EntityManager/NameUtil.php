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

namespace Espo\Tools\EntityManager;

use Espo\Core\Utils\Metadata;
use Espo\Core\Utils\Route;
use Espo\Core\Utils\Util;
use Espo\Core\ServiceFactory;
use Espo\ORM\EntityManager;
use Espo\ORM\Entity;

class NameUtil
{
    public const MAX_ENTITY_NAME_LENGTH = 64;
    public const MIN_ENTITY_NAME_LENGTH = 3;

    /**
     * @var string[]
     */
    public const RESERVED_WORLD_LIST = [
        '__halt_compiler', 'abstract', 'and', 'array', 'as', 'break', 'callable',
        'case', 'catch', 'class', 'clone', 'const', 'continue', 'declare', 'default',
        'die', 'do', 'echo', 'else', 'elseif', 'empty', 'enddeclare', 'endfor', 'endforeach',
        'endif', 'endswitch', 'endwhile', 'eval', 'exit', 'extends', 'final', 'for', 'foreach',
        'function', 'global', 'goto', 'if', 'implements', 'include', 'include_once', 'instanceof',
        'insteadof', 'interface', 'isset', 'list', 'namespace', 'new', 'or', 'print', 'private',
        'protected', 'public', 'require', 'require_once', 'return', 'static', 'switch', 'throw',
        'trait', 'try', 'unset', 'use', 'var', 'while', 'xor', 'common', 'fn', 'parent',
        'int', 'float', 'bool', 'string', 'true', 'false', 'null', 'void', 'iterable', 'object',
        'mixed', 'never',
    ];

    /**
     * @var string[]
     */
    public const LINK_FORBIDDEN_NAME_LIST = [
        'posts',
        'stream',
        'subscription',
        'followers',
        'action',
        'null',
        'false',
        'true',
        'layout',
        'system',
    ];

    /**
     * @var string[]
     */
    public const ENTITY_TYPE_FORBIDDEN_NAME_LIST = [
        'Common',
        'PortalUser',
        'ApiUser',
        'Timeline',
        'About',
        'Admin',
        'Null',
        'False',
        'True',
        'Base',
        'Layout',
    ];

    public function __construct(
        private Metadata $metadata,
        private ServiceFactory $serviceFactory,
        private EntityManager $entityManager,
        private Route $routeUtil
    ) {}

    public function nameIsBad(string $name): bool
    {
        if (!$name) {
            return true;
        }

        if (preg_match('/[^a-zA-Z\d]/', $name)) {
            return true;
        }

        if (preg_match('/[^A-Z]/', $name[0])) {
            return true;
        }

        return false;
    }

    public function nameIsTooShort(string $name): bool
    {
        return strlen($name) < NameUtil::MIN_ENTITY_NAME_LENGTH;
    }

    public function nameIsTooLong(string $name): bool
    {
        return strlen(Util::camelCaseToUnderscore($name)) > NameUtil::MAX_ENTITY_NAME_LENGTH;
    }

    public function nameIsNotAllowed(string $name): bool
    {
        if (in_array($name, self::ENTITY_TYPE_FORBIDDEN_NAME_LIST)) {
            return true;
        }

        if (in_array(strtolower($name), NameUtil::RESERVED_WORLD_LIST)) {
            return true;
        }

        if ($name !== Util::normalizeScopeName($name)) {
            return true;
        }

        return false;
    }

    public function nameIsUsed(string $name): bool
    {
        if ($this->metadata->get(['scopes', $name])) {
            return true;
        }

        if ($this->metadata->get(['entityDefs', $name])) {
            return true;
        }

        if ($this->metadata->get(['clientDefs', $name])) {
            return true;
        }

        if ($this->relationshipExists($name)) {
            return true;
        }

        if ($this->controllerExists($name)) {
            return true;
        }

        if ($this->serviceFactory->checkExists($name)) {
            return true;
        }

        if ($this->routeExists($name)) {
            return true;
        }

        return false;
    }

    private function routeExists(string $name): bool
    {
        foreach ($this->routeUtil->getFullList() as $route) {
            if (
                $route->getRoute() === '/' . $name ||
                str_starts_with($route->getRoute(), '/' . $name . '/')
            ) {
                return true;
            }
        }

        return false;
    }

    private function controllerExists(string $name): bool
    {
        $controllerClassName = 'Espo\\Custom\\Controllers\\' . Util::normalizeClassName($name);

        if (class_exists($controllerClassName)) {
            return true;
        }

        foreach ($this->metadata->getModuleList() as $moduleName) {
            $controllerClassName =
                'Espo\\Modules\\' . $moduleName . '\\Controllers\\' . Util::normalizeClassName($name);

            if (class_exists($controllerClassName)) {
                return true;
            }
        }

        $controllerClassName = 'Espo\\Controllers\\' . Util::normalizeClassName($name);

        if (class_exists($controllerClassName)) {
            return true;
        }

        return false;
    }

    public function relationshipExists(string $name): bool
    {
        /** @var string[] $scopeList */
        $scopeList = array_keys($this->metadata->get(['scopes'], []));

        foreach ($scopeList as $entityType) {
            $relationsDefs = $this->entityManager
                ->getMetadata()
                ->get($entityType, 'relations');

            if (empty($relationsDefs)) {
                continue;
            }

            foreach ($relationsDefs as $item) {
                if (empty($item['type']) || empty($item['relationName'])) {
                    continue;
                }

                if (
                    $item['type'] === Entity::MANY_MANY &&
                    ucfirst($item['relationName']) === ucfirst($name)
                ) {
                    return true;
                }
            }
        }

        return false;
    }
}
