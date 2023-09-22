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

use Espo\Core\Field\LinkParent;
use Espo\Core\ORM\Entity;
use Espo\Core\Record\ActionHistory\Action;

class ActionHistoryRecord extends Entity
{
    public const ENTITY_TYPE = 'ActionHistoryRecord';

    public const ACTION_CREATE = Action::CREATE;
    public const ACTION_READ = Action::READ;
    public const ACTION_UPDATE = Action::UPDATE;
    public const ACTION_DELETE = Action::DELETE;

    /**
     * @param Action::* $action
     */
    public function setAction(string $action): self
    {
        $this->set('action', $action);

        return $this;
    }

    public function setUserId(string $userId): self
    {
        $this->set('userId', $userId);

        return $this;
    }

    public function setIpAddress(?string $ipAddress): self
    {
        $this->set('ipAddress', $ipAddress);

        return $this;
    }

    public function setAuthTokenId(?string $authTokenId): self
    {
        $this->set('authTokenId', $authTokenId);

        return $this;
    }

    public function setAuthLogRecordId(?string $authLogRecordId): self
    {
        $this->set('authLogRecordId', $authLogRecordId);

        return $this;
    }

    public function setTarget(LinkParent $target): self
    {
        $this->set('targetId', $target->getId());
        $this->set('targetType', $target->getEntityType());

        return $this;
    }
}
