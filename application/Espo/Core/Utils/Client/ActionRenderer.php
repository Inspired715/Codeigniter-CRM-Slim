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

namespace Espo\Core\Utils\Client;

use Espo\Core\Api\Response;
use Espo\Core\Utils\Client\ActionRenderer\Params;
use Espo\Core\Utils\Json;
use Espo\Core\Utils\ClientManager;

/**
 * Renders a front-end page that executes a controller action. Utilized by entry points.
 */
class ActionRenderer
{

    public function __construct(private ClientManager $clientManager)
    {}

    /**
     * Writes to a body.
     */
    public function write(Response $response, Params $params): void
    {
        $body = $this->render(
            $params->getController(),
            $params->getAction(),
            $params->getData(),
            $params->initAuth()
        );

        $this->clientManager->writeHeaders($response);
        $response->writeBody($body);
    }

    /**
     * @deprecated Use`write`.
     * @param ?array<string, mixed> $data
     */
    public function render(string $controller, string $action, ?array $data = null, bool $initAuth = false): string
    {
        $encodedData = Json::encode($data);

        $initAuthPart = $initAuth ? "app.initAuth();" : '';

        $script =
            "
                {$initAuthPart}
                app.doAction({
                    controllerClassName: '{$controller}',
                    action: '{$action}',
                    options: {$encodedData},
                });
            ";

        return $this->clientManager->render($script);
    }
}
