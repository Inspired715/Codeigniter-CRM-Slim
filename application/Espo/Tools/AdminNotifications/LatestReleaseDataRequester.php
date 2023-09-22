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

namespace Espo\Tools\AdminNotifications;

class LatestReleaseDataRequester
{
    /**
     * @param array<string, mixed> $requestData
     * @return ?array<mixed, mixed>
     */
    public function request(
        ?string $url = null,
        array $requestData = [],
        string $urlPath = 'release/latest'
    ): ?array {

        if (!function_exists('curl_version')) {
            return null;
        }

        $ch = curl_init();

        $requestUrl = $url ? trim($url) : base64_decode('aHR0cHM6Ly9zLmVzcG9jcm0uY29tLw==');
        $requestUrl = (substr($requestUrl, -1) == '/') ? $requestUrl : $requestUrl . '/';

        $requestUrl .= empty($requestData) ?
            $urlPath . '/' :
            $urlPath . '/?' . http_build_query($requestData);

        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

        /** @var string|false $result */
        $result = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($result === false) {
            return null;
        }

        if ($httpCode !== 200) {
            return null;
        }

        $data = json_decode($result, true);

        if (!is_array($data)) {
            return null;
        }

        return $data;
    }
}
