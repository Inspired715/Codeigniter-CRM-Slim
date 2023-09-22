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

namespace Espo\Controllers;

use Espo\Core\Exceptions\BadRequest;
use Espo\Core\Exceptions\Error;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Container;
use Espo\Core\DataManager;
use Espo\Core\Api\Request;
use Espo\Core\Utils\Config;
use Espo\Core\Utils\AdminNotificationManager;
use Espo\Core\Utils\SystemRequirements;
use Espo\Core\Utils\ScheduledJob;
use Espo\Core\Upgrades\UpgradeManager;
use Espo\Entities\User;

class Admin
{
    /**
     * @throws Forbidden
     */
    public function __construct(
        private Container $container,
        private Config $config,
        private User $user,
        private AdminNotificationManager $adminNotificationManager,
        private SystemRequirements $systemRequirements,
        private ScheduledJob $scheduledJob,
        private DataManager $dataManager
    ) {
        if (!$this->user->isAdmin()) {
            throw new Forbidden();
        }
    }

    /**
     * @throws Error
     */
    public function postActionRebuild(): bool
    {
        $this->dataManager->rebuild();

        return true;
    }

    /**
     * @throws Error
     */
    public function postActionClearCache(): bool
    {
        $this->dataManager->clearCache();

        return true;
    }

    /**
     * @return string[]
     */
    public function getActionJobs(): array
    {
        return $this->scheduledJob->getAvailableList();
    }

    /**
     * @return object{
     *   id: string,
     *   version: string,
     * }
     * @throws Forbidden
     * @throws Error
     * @throws BadRequest
     */
    public function postActionUploadUpgradePackage(Request $request): object
    {
        if (
            $this->config->get('restrictedMode') &&
            !$this->user->isSuperAdmin()
        ) {
            throw new Forbidden();
        }

        $data = $request->getBodyContents();

        if (!$data) {
            throw new BadRequest();
        }

        $upgradeManager = new UpgradeManager($this->container);

        $upgradeId = $upgradeManager->upload($data);
        $manifest = $upgradeManager->getManifest();

        return (object) [
            'id' => $upgradeId,
            'version' => $manifest['version'],
        ];
    }

    /**
     * @throws Forbidden
     * @throws Error
     */
    public function postActionRunUpgrade(Request $request): bool
    {
        $data = $request->getParsedBody();

        if (
            $this->config->get('restrictedMode') &&
            !$this->user->isSuperAdmin()
        ) {
            throw new Forbidden();
        }

        $upgradeManager = new UpgradeManager($this->container);

        $upgradeManager->install(get_object_vars($data));

        return true;
    }

    /**
     * @return object{
     *     message: string,
     *     command: string,
     * }
     */
    public function getActionCronMessage(): object
    {
        return (object) $this->scheduledJob->getSetupMessage();
    }

    /**
     * @return array<int, array{
     *     id: string,
     *     type: string,
     *     message: string,
     * }>
     */
    public function getActionAdminNotificationList(): array
    {
        return $this->adminNotificationManager->getNotificationList();
    }

    /**
     * @return object{
     *     php: array<string, array<string, mixed>>,
     *     database: array<string, array<string, mixed>>,
     *     permission: array<string, array<string, mixed>>,
     * }
     */
    public function getActionSystemRequirementList(): object
    {
        return (object) $this->systemRequirements->getAllRequiredList();
    }
}
