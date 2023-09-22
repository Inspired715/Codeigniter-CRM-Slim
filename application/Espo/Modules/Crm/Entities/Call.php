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

namespace Espo\Modules\Crm\Entities;

use Espo\Core\Field\DateTime;
use Espo\Core\Field\Link;
use Espo\Core\Field\LinkMultiple;
use Espo\Core\ORM\Entity;

class Call extends Entity
{
    public const ENTITY_TYPE = 'Call';

    public const STATUS_PLANNED = 'Planned';
    public const STATUS_HELD = 'Held';
    public const STATUS_NOT_HELD = 'Not Held';

    public function getName(): ?string
    {
        return $this->get('name');
    }

    public function getStatus(): ?string
    {
        return $this->get('status');
    }

    public function getDateStart(): ?DateTime
    {
        /** @var ?DateTime */
        return $this->getValueObject('dateStart');
    }

    public function setDateStart(?DateTime $dateStart): self
    {
        $this->setValueObject('dateStart', $dateStart);

        return $this;
    }

    public function getDateEnd(): ?DateTime
    {
        /** @var ?DateTime */
        return $this->getValueObject('dateEnd');
    }

    public function setDateEnd(?DateTime $dateEnd): self
    {
        $this->setValueObject('dateEnd', $dateEnd);

        return $this;
    }

    public function setAssignedUserId(?string $assignedUserId): self
    {
        $this->set('assignedUserId', $assignedUserId);

        return $this;
    }

    public function getCreatedBy(): ?Link
    {
        /** @var ?Link */
        return $this->getValueObject('createdBy');
    }

    public function getModifiedBy(): ?Link
    {
        /** @var ?Link */
        return $this->getValueObject('modifiedBy');
    }

    public function getAssignedUser(): ?Link
    {
        /** @var ?Link */
        return $this->getValueObject('assignedUser');
    }

    public function getTeams(): LinkMultiple
    {
        /** @var LinkMultiple */
        return $this->getValueObject('teams');
    }

    public function getUsers(): LinkMultiple
    {
        /** @var LinkMultiple */
        return $this->getValueObject('users');
    }

    public function getContacts(): LinkMultiple
    {
        /** @var LinkMultiple */
        return $this->getValueObject('contacts');
    }

    public function getLeads(): LinkMultiple
    {
        /** @var LinkMultiple */
        return $this->getValueObject('leads');
    }
}
