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

use Espo\Core\ORM\Entity;

class EmailQueueItem extends Entity
{
    public const ENTITY_TYPE = 'EmailQueueItem';

    public const STATUS_PENDING = 'Pending';
    public const STATUS_FAILED = 'Failed';
    public const STATUS_SENT = 'Sent';
    public const STATUS_SENDING = 'Sending';

    public function getStatus(): ?string
    {
        return $this->get('status');
    }

    public function getAttemptCount(): int
    {
        return (int) $this->get('attemptCount');
    }

    public function isTest(): bool
    {
        return (bool) $this->get('isTest');
    }

    public function getTargetType(): string
    {
        $value = $this->get('targetType');

        if (!is_string($value)) {
            throw new \UnexpectedValueException();
        }

        return $value;
    }

    public function getTargetId(): string
    {
        $value = $this->get('targetId');

        if (!is_string($value)) {
            throw new \UnexpectedValueException();
        }

        return $value;
    }

    public function getMassEmailId(): ?string
    {
        return $this->get('massEmailId');
    }

    public function getEmailAddress(): ?string
    {
        return $this->get('emailAddress');
    }
}
