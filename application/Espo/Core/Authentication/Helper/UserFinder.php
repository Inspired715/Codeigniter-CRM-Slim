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

namespace Espo\Core\Authentication\Helper;

use Espo\Core\Authentication\Logins\ApiKey;
use Espo\Core\Authentication\Logins\Hmac;
use Espo\ORM\EntityManager;

use Espo\Entities\User;

class UserFinder
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function find(string $username, string $hash): ?User
    {
        /** @var ?User $user */
        $user = $this->entityManager
            ->getRDBRepository(User::ENTITY_TYPE)
            ->where([
                'userName' => $username,
                'password' => $hash,
                'type!=' => [User::TYPE_API, User::TYPE_SYSTEM],
            ])
            ->findOne();

        return $user;
    }

    public function findApiHmac(string $apiKey): ?User
    {
        /** @var ?User $user */
        $user = $this->entityManager
            ->getRDBRepository(User::ENTITY_TYPE)
            ->where([
                'type' => User::TYPE_API,
                'apiKey' => $apiKey,
                'authMethod' => Hmac::NAME,
            ])
            ->findOne();

        return $user;
    }

    public function findApiApiKey(string $apiKey): ?User
    {
        /** @var ?User $user */
        $user = $this->entityManager
            ->getRDBRepository(User::ENTITY_TYPE)
            ->where([
                'type' => User::TYPE_API,
                'apiKey' => $apiKey,
                'authMethod' => ApiKey::NAME,
            ])
            ->findOne();

        return $user;
    }
}
