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

namespace Espo\Core\Portal;

use Espo\Entities\Portal;
use Espo\ORM\EntityManager;

use Espo\Core\Exceptions\Error;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Exceptions\NotFound;

use Espo\Core\Application as BaseApplication;
use Espo\Core\Container\ContainerBuilder;
use Espo\Core\Portal\Container as PortalContainer;
use Espo\Core\Portal\Container\ContainerConfiguration as PortalContainerConfiguration;
use Espo\Core\Portal\Utils\Config;

class Application extends BaseApplication
{
    public function __construct(?string $portalId)
    {
        date_default_timezone_set('UTC');

        $this->initContainer();
        $this->initPortal($portalId);
        $this->initAutoloads();
        $this->initPreloads();
    }

    public function getContainer(): Container
    {
        $container = parent::getContainer();

        /** @var Container */
        return $container;
    }

    protected function initContainer(): void
    {
        $container = (new ContainerBuilder())
            ->withConfigClassName(Config::class)
            ->withContainerClassName(PortalContainer::class)
            ->withContainerConfigurationClassName(PortalContainerConfiguration::class)
            ->build();

        if (!$container instanceof PortalContainer) {
            throw new Error("Wrong container created.");
        }

        $this->container = $container;
    }

    protected function initPortal(?string $portalId): void
    {
        if (!$portalId) {
            throw new Error("Portal ID was not passed to Portal\Application.");
        }

        $entityManager = $this->container->getByClass(EntityManager::class);

        $portal = $entityManager->getEntity(Portal::ENTITY_TYPE, $portalId);

        if (!$portal) {
            $portal = $entityManager
                ->getRDBRepository(Portal::ENTITY_TYPE)
                ->where(['customId' => $portalId])
                ->findOne();
        }

        if (!$portal) {
            throw new NotFound("Portal {$portalId} not found.");
        }

        if (!$portal->get('isActive')) {
            throw new Forbidden("Portal {$portalId} is not active.");
        }

        /** @var PortalContainer $container */
        $container = $this->container;

        $container->setPortal($portal);
    }

    protected function initPreloads(): void
    {
        parent::initPreloads();

        foreach ($this->getMetadata()->get(['app', 'portalContainerServices']) ?? [] as $name => $defs) {
            if ($defs['preload'] ?? false) {
                $this->container->get($name);
            }
        }
    }
}
