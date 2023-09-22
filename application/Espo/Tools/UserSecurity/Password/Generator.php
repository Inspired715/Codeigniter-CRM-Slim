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

namespace Espo\Tools\UserSecurity\Password;

use Espo\Core\Utils\Config;
use Espo\Core\Utils\Util;

/**
 * A password generator.
 *
 * @todo Use an interface with binding.
 */
class Generator
{
    private Config $config;

    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * Generate a password.
     */
    public function generate(): string
    {
        $length = $this->config->get('passwordStrengthLength');
        $letterCount = $this->config->get('passwordStrengthLetterCount');
        $numberCount = $this->config->get('passwordStrengthNumberCount');

        $generateLength = $this->config->get('passwordGenerateLength', 10);
        $generateLetterCount = $this->config->get('passwordGenerateLetterCount', 4);
        $generateNumberCount = $this->config->get('passwordGenerateNumberCount', 2);

        $length = is_null($length) ? $generateLength : $length;
        $letterCount = is_null($letterCount) ? $generateLetterCount : $letterCount;
        $numberCount = is_null($letterCount) ? $generateNumberCount : $numberCount;

        if ($length < $generateLength) {
            $length = $generateLength;
        }

        if ($letterCount < $generateLetterCount) {
            $letterCount = $generateLetterCount;
        }

        if ($numberCount < $generateNumberCount) {
            $numberCount = $generateNumberCount;
        }

        return Util::generatePassword($length, $letterCount, $numberCount, true);
    }
}
