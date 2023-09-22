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

namespace Espo\Tools\Email\Api;

use Espo\Core\Acl;
use Espo\Core\Api\Action;
use Espo\Core\Api\Request;
use Espo\Core\Api\Response;
use Espo\Core\Api\ResponseComposer;
use Espo\Core\Exceptions\BadRequest;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Mail\SmtpParams;
use Espo\Entities\Email;
use Espo\Tools\Email\SendService;
use Espo\Tools\Email\TestSendData;

/**
 * Sends test emails.
 */
class PostSendTest implements Action
{
    public function __construct(
        private SendService $sendService,
        private Acl $acl
    ) {}

    public function process(Request $request): Response
    {
        if (!$this->acl->checkScope(Email::ENTITY_TYPE)) {
            throw new Forbidden();
        }

        $data = $request->getParsedBody();

        $type = $data->type ?? null;
        $id = $data->id ?? null;
        $server = $data->server ?? null;
        $port = $data->port ?? null;
        $username = $data->username ?? null;
        $password = $data->password ?? null;
        $auth = $data->auth ?? null;
        $authMechanism = $data->authMechanism ?? null;
        $security = $data->security ?? null;
        $userId = $data->userId ?? null;
        $fromAddress = $data->fromAddress ?? null;
        $fromName = $data->fromName ?? null;
        $emailAddress = $data->emailAddress ?? null;

        if (!is_string($server)) {
            throw new BadRequest("No `server`");
        }

        if (!is_int($port)) {
            throw new BadRequest("No or bad `port`.");
        }

        if (!is_string($emailAddress)) {
            throw new BadRequest("No `emailAddress`.");
        }

        $smtpParams = SmtpParams
            ::create($server, $port)
            ->withSecurity($security)
            ->withFromName($fromName)
            ->withFromAddress($fromAddress)
            ->withAuth($auth);

        if ($auth) {
            $smtpParams = $smtpParams
                ->withUsername($username)
                ->withPassword($password)
                ->withAuthMechanism($authMechanism);
        }

        $data = new TestSendData($emailAddress, $type, $id, $userId);

        $this->sendService->sendTestEmail($smtpParams, $data);

        return ResponseComposer::json(true);
    }
}
