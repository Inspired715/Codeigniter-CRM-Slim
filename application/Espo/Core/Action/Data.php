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

namespace Espo\Core\Action;

use Espo\Core\Utils\ObjectUtil;

use stdClass;

class Data
{
    private stdClass $data;

    private function __construct()
    {
        $this->data = (object) [];
    }

    public function getRaw(): stdClass
    {
        return ObjectUtil::clone($this->data);
    }

    /**
     * Get an item value.
     *
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->getRaw()->$name ?? null;
    }

    /**
     * Has an item.
     */
    public function has(string $name): bool
    {
        return property_exists($this->data, $name);
    }

    public static function fromRaw(stdClass $data): self
    {
        $obj = new self();

        $obj->data = $data;

        return $obj;
    }

    /**
     * Clone with an item value.
     *
     * @param mixed $value
     */
    public function with(string $name, $value): self
    {
        $obj = clone $this;

        $obj->data->$name = $value;

        return $obj;
    }

    public function __clone()
    {
        $this->data = ObjectUtil::clone($this->data);
    }
}
