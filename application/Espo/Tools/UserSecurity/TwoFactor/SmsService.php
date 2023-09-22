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

namespace Espo\Tools\UserSecurity\TwoFactor;

use Espo\Core\Authentication\TwoFactor\Sms\SmsLogin;
use Espo\Core\Exceptions\Error;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Exceptions\NotFound;

use Espo\Core\Utils\Config;
use Espo\Core\Authentication\TwoFactor\Sms\Util;

use Espo\ORM\EntityManager;

use Espo\Entities\User;

class SmsService
{
    private Util $util;
    private User $user;
    private EntityManager $entityManager;
    private Config $config;

    public function __construct(
        Util $util,
        User $user,
        EntityManager $entityManager,
        Config $config
    ) {
        $this->util = $util;
        $this->user = $user;
        $this->entityManager = $entityManager;
        $this->config = $config;
    }

    /**
     * @throws Forbidden
     * @throws NotFound
     * @throws Error
     */
    public function sendCode(string $userId, string $phoneNumber): void
    {
        if (!$this->user->isAdmin() && $userId !== $this->user->getId()) {
            throw new Forbidden();
        }

        $this->checkAllowed();

        /** @var ?User $user */
        $user = $this->entityManager->getEntity(User::ENTITY_TYPE, $userId);

        if (!$user) {
            throw new NotFound();
        }

        $this->util->sendCode($user, $phoneNumber);
        $this->util->storePhoneNumber($user, $phoneNumber);
    }

    /**
     * @throws Forbidden
     */
    private function checkAllowed(): void
    {
        if (!$this->config->get('auth2FA')) {
            throw new Forbidden("2FA is not enabled.");
        }

        if ($this->user->isPortal() && !$this->config->get('auth2FAInPortal')) {
            throw new Forbidden("2FA is not enabled in portals.");
        }

        $methodList = $this->config->get('auth2FAMethodList') ?? [];

        if (!in_array(SmsLogin::NAME, $methodList)) {
            throw new Forbidden("Sms 2FA is not allowed.");
        }
    }
}
