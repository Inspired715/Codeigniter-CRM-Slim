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

namespace Espo\Core\Authentication\AuthToken;

use Espo\ORM\EntityManager;
use Espo\ORM\Repository\RDBRepository;
use Espo\Entities\AuthToken as AuthTokenEntity;

use RuntimeException;

/**
 * A default auth token manager. Auth tokens are stored in database.
 * Consider creating a custom implementation if you need to store auth tokens
 * in another storage. E.g. a single Redis data store can be utilized with
 * multiple Espo replicas (for scalability purposes).
 * Defined at metadata > app > containerServices > authTokenManager.
 */
class EspoManager implements Manager
{
    /** @var RDBRepository<AuthTokenEntity> */
    private RDBRepository $repository;

    private const TOKEN_RANDOM_LENGTH = 16;

    public function __construct(EntityManager $entityManager)
    {
        $this->repository = $entityManager->getRDBRepositoryByClass(AuthTokenEntity::class);
    }

    public function get(string $token): ?AuthToken
    {
        /** @var ?AuthTokenEntity $authToken */
        $authToken = $this->repository
            ->select([
                'id',
                'isActive',
                'token',
                'secret',
                'userId',
                'portalId',
                'hash',
                'createdAt',
                'lastAccess',
                'modifiedAt',
            ])
            ->where(['token' => $token])
            ->findOne();

        return $authToken;
    }

    public function create(Data $data): AuthToken
    {
        /** @var AuthTokenEntity $authToken */
        $authToken = $this->repository->getNew();

        $authToken
            ->setUserId($data->getUserId())
            ->setPortalId($data->getPortalId())
            ->setHash($data->getHash())
            ->setIpAddress($data->getIpAddress())
            ->setToken($this->generateToken())
            ->setLastAccessNow();

        if ($data->toCreateSecret()) {
            $authToken->setSecret($this->generateToken());
        }

        $this->validate($authToken);

        $this->repository->save($authToken);

        return $authToken;
    }

    public function inactivate(AuthToken $authToken): void
    {
        if (!$authToken instanceof AuthTokenEntity) {
            throw new RuntimeException();
        }

        $this->validateNotChanged($authToken);

        $authToken->setIsActive(false);

        $this->repository->save($authToken);
    }

    public function renew(AuthToken $authToken): void
    {
        if (!$authToken instanceof AuthTokenEntity) {
            throw new RuntimeException();
        }

        $this->validateNotChanged($authToken);

        if ($authToken->isNew()) {
            throw new RuntimeException("Can renew only not new auth token.");
        }

        $authToken->setLastAccessNow();

        $this->repository->save($authToken);
    }

    private function validate(AuthToken $authToken): void
    {
        if (!$authToken->getToken()) {
            throw new RuntimeException("Empty token.");
        }

        if (!$authToken->getUserId()) {
            throw new RuntimeException("Empty user ID.");
        }
    }

    private function validateNotChanged(AuthTokenEntity $authToken): void
    {
        if (
            $authToken->isAttributeChanged('token') ||
            $authToken->isAttributeChanged('secret') ||
            $authToken->isAttributeChanged('hash') ||
            $authToken->isAttributeChanged('userId') ||
            $authToken->isAttributeChanged('portalId')
        ) {
            throw new RuntimeException("Auth token was changed.");
        }
    }

    private function generateToken(): string
    {
        $length = self::TOKEN_RANDOM_LENGTH;

        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes($length));
        }

        if (function_exists('openssl_random_pseudo_bytes')) {
            /** @var string $randomValue */
            $randomValue = openssl_random_pseudo_bytes($length);

            return bin2hex($randomValue);
        }

        throw new RuntimeException("Could not generate token.");
    }
}
