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

namespace Espo\Core\Authentication\Oidc\UserProvider;

use Espo\Core\ApplicationState;
use Espo\Core\Authentication\Jwt\Token\Payload;
use Espo\Core\Authentication\Oidc\ConfigDataProvider;
use Espo\Core\Authentication\Oidc\UserProvider;
use Espo\Core\Utils\Log;
use Espo\Entities\User;
use RuntimeException;

class DefaultUserProvider implements UserProvider
{
    public function __construct(
        private ConfigDataProvider $configDataProvider,
        private Sync $sync,
        private UserRepository $userRepository,
        private ApplicationState $applicationState,
        private Log $log
    ) {}

    public function get(Payload $payload): ?User
    {
        $user = $this->findUser($payload);

        if ($user) {
            $this->syncUser($user, $payload);

            return $user;
        }

        return $this->tryToCreateUser($payload);
    }

    private function findUser(Payload $payload): ?User
    {
        $usernameClaim = $this->configDataProvider->getUsernameClaim();

        if (!$usernameClaim) {
            throw new RuntimeException("No username claim in config.");
        }

        $username = $payload->get($usernameClaim);

        if (!$username) {
            throw new RuntimeException("No username claim `{$usernameClaim}` in token.");
        }

        $username = $this->sync->normalizeUsername($username);

        $user = $this->userRepository->findByUsername($username);

        if (!$user) {
            return null;
        }

        if (!$user->isActive()) {
            return null;
        }

        $userId = $user->getId();

        $isPortal = $this->applicationState->isPortal();

        if (!$isPortal && !$user->isRegular() && !$user->isAdmin()) {
            $this->log->info("Oidc: User {$userId} found but it's neither regular user not admin.");

            return null;
        }

        if ($isPortal && !$user->isPortal()) {
            $this->log->info("Oidc: User {$userId} found but it's not portal user.");

            return null;
        }

        if ($isPortal) {
            $portalId = $this->applicationState->getPortalId();

            if (!$user->getPortals()->hasId($portalId)) {
                $this->log->info("Oidc: User {$userId} found but it's not related to current portal.");

                return null;
            }
        }

        if ($user->isSuperAdmin()) {
            $this->log->info("Oidc: User {$userId} found but it's super-admin, not allowed.");

            return null;
        }

        if ($user->isAdmin() && !$this->configDataProvider->allowAdminUser()) {
            $this->log->info("Oidc: User {$userId} found but it's admin, not allowed.");

            return null;
        }

        return $user;
    }

    private function tryToCreateUser(Payload $payload): ?User
    {
        if (!$this->configDataProvider->createUser()) {
            return null;
        }

        $usernameClaim = $this->configDataProvider->getUsernameClaim();

        if (!$usernameClaim) {
            throw new RuntimeException("Could not create a user. No OIDC username claim in config.");
        }

        $username = $payload->get($usernameClaim);

        if (!$username) {
            throw new RuntimeException("Could not create a user. No username claim returned in token.");
        }

        return $this->sync->createUser($payload);
    }

    private function syncUser(User $user, Payload $payload): void
    {
        if (
            !$this->configDataProvider->sync() &&
            !$this->configDataProvider->syncTeams()
        ) {
            return;
        }

        $this->sync->syncUser($user, $payload);
    }
}
