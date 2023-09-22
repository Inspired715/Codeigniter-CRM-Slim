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

namespace Espo\Core\Utils\Metadata;

use Espo\Core\InjectableFactory;
use Espo\Core\Utils\Config;
use Espo\Core\Utils\Database\Orm\Converter;
use Espo\Core\Utils\DataCache;
use Espo\Core\Utils\Util;

class OrmMetadataData
{
    /** @var ?array<string, array<string, mixed>> */
    private $data = null;
    private string $cacheKey = 'ormMetadata';
    private bool $useCache;
    private ?Converter $converter = null;

    public function __construct(
        private DataCache $dataCache,
        private Config $config,
        private InjectableFactory $injectableFactory
    ) {

        $this->useCache = (bool) $this->config->get('useCache', false);
    }

    private function getConverter(): Converter
    {
        if (!isset($this->converter)) {
            $this->converter = $this->injectableFactory->create(Converter::class);
        }

        return $this->converter;
    }

    /**
     * Reloads data.
     */
    public function reload(): void
    {
        $this->getDataInternal(true);
    }

    /**
     * Get raw data.
     *
     * @return array<string, array<string, mixed>>
     */
    public function getData(): array
    {
        return $this->getDataInternal();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function getDataInternal(bool $reload = false): array
    {
        if (isset($this->data) && !$reload) {
            return $this->data;
        }

        if ($this->useCache && $this->dataCache->has($this->cacheKey) && !$reload) {
            /** @var array<string, array<string, mixed>> $data */
            $data = $this->dataCache->get($this->cacheKey);

            $this->data = $data;

            return $this->data;
        }

        $this->data = $this->getConverter()->process();

        if ($this->useCache) {
            $this->dataCache->store($this->cacheKey, $this->data);
        }

        return $this->data;
    }

    /**
     * @param string|string[]|null $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key = null, $default = null)
    {
        return Util::getValueByKey($this->getData(), $key, $default);
    }
}
