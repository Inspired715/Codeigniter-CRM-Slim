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

namespace Espo\Entities;

use Espo\Core\Field\Link;
use Espo\Repositories\Portal as PortalRepository;

class Portal extends \Espo\Core\ORM\Entity
{
    public const ENTITY_TYPE = 'Portal';

    /**
     * @var string[]
     */
    protected $settingsAttributeList = [
        'companyLogoId',
        'tabList',
        'quickCreateList',
        'dashboardLayout',
        'dashletsOptions',
        'theme',
        'themeParams',
        'language',
        'timeZone',
        'dateFormat',
        'timeFormat',
        'weekStart',
        'defaultCurrency',
    ];

    /**
     * @return string[]
     */
    public function getSettingsAttributeList(): array
    {
        return $this->settingsAttributeList;
    }

    public function getUrl(): ?string
    {
        if (!$this->has('url') && $this->entityManager) {
            /** @var PortalRepository $repository */
            $repository = $this->entityManager->getRDBRepositoryByClass(Portal::class);

            $repository->loadUrlField($this);
        }

        return $this->get('url');
    }

    public function getAuthenticationProvider(): ?Link
    {
        /** @var ?Link */
        return $this->getValueObject('authenticationProvider');
    }

    public function getLayoutSet(): ?Link
    {
        /** @var ?Link */
        return $this->getValueObject('layoutSet');
    }
}
