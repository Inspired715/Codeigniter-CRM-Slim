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

namespace Espo\Core\Authentication;

/**
 * @immutable
 */
class AuthenticationData
{
    private ?string $username;
    private ?string $password;
    private ?string $method;
    private bool $byTokenOnly = false;

    public function __construct(
        ?string $username = null,
        ?string $password = null,
        ?string $method = null
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->method = $method;
    }

    public static function create(): self
    {
        return new self();
    }

    /**
     * A username.
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * A password or auth-token.
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * A method.
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * Authenticate by auth-token only. No username check.
     */
    public function byTokenOnly(): bool
    {
        return $this->byTokenOnly;
    }

    public function withUsername(?string $username): self
    {
        $obj = clone $this;
        $obj->username = $username;

        return $obj;
    }

    public function withPassword(?string $password): self
    {
        $obj = clone $this;
        $obj->password = $password;

        return $obj;
    }

    public function withMethod(?string $method): self
    {
        $obj = clone $this;
        $obj->method = $method;

        return $obj;
    }

    public function withByTokenOnly(bool $byTokenOnly): self
    {
        $obj = clone $this;
        $obj->byTokenOnly = $byTokenOnly;

        return $obj;
    }
}
