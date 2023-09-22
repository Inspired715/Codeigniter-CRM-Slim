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

namespace Espo\Core\Console\Commands;

use Espo\Core\Application;
use Espo\Core\Console\Command;
use Espo\Core\Console\Command\Params;
use Espo\Core\Console\IO;
use Espo\Core\Upgrades\UpgradeManager;

use Exception;

class UpgradeStep implements Command
{
    public function __construct() {}

    public function run(Params $params, IO $io): void
    {
        $options = $params->getOptions();

        if (empty($options['step'])) {
            echo "Step is not specified.\n";

            return;
        }

        if (empty($options['id'])) {
            echo "Upgrade ID is not specified.\n";

            return;
        }

        $stepName = $options['step'];
        $upgradeId = $options['id'];

        $result = $this->runUpgradeStep($stepName, ['id' => $upgradeId]);

        if (!$result) {
            echo "false";

            return;
        }

        echo "true";
    }

    /**
     * @param array<string, mixed> $params
     */
    private function runUpgradeStep(string $stepName, array $params): bool
    {
        $app = new Application();

        $app->setupSystemUser();

        $upgradeManager = new UpgradeManager($app->getContainer());

        try {
            $result = $upgradeManager->runInstallStep($stepName, $params);
        }
        catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }

        return $result;
    }
}
