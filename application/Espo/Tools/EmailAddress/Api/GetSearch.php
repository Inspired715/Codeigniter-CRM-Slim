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

namespace Espo\Tools\EmailAddress\Api;

use Espo\Core\Acl;
use Espo\Core\Api\Action;
use Espo\Core\Api\Request;
use Espo\Core\Api\Response;
use Espo\Core\Api\ResponseComposer;
use Espo\Core\Exceptions\BadRequest;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\Utils\Config;
use Espo\Entities\Email;
use Espo\Tools\Email\AddressService;

/**
 * Searches email addresses.
 */
class GetSearch implements Action
{
    private const ADDRESS_MAX_SIZE = 50;

    public function __construct(
        private AddressService $service,
        private Acl $acl,
        private Config $config
    ) {}

    public function process(Request $request): Response
    {
        if (!$this->acl->checkScope(Email::ENTITY_TYPE)) {
            throw new Forbidden();
        }

        if (!$this->acl->checkScope(Email::ENTITY_TYPE, Acl\Table::ACTION_CREATE)) {
            throw new Forbidden();
        }

        $q = $request->getQueryParam('q');

        if (is_string($q)) {
            $q = trim($q);
        }

        if (!$q) {
            throw new BadRequest("No `q` parameter.");
        }

        $maxSize = intval($request->getQueryParam('maxSize'));

        if (!$maxSize || $maxSize > self::ADDRESS_MAX_SIZE) {
            $maxSize = (int) $this->config->get('recordsPerPage');
        }

        $onlyActual = $request->getQueryParam('onlyActual') === 'true';

        $result = $this->service->searchInAddressBook($q, $maxSize, $onlyActual);

        return ResponseComposer::json($result);
    }
}
