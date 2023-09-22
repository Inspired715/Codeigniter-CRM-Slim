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

namespace Espo\Classes\FieldProcessing\Email;

use Espo\Entities\Email;
use Espo\ORM\Entity;
use Espo\Core\FieldProcessing\Loader;
use Espo\Core\FieldProcessing\Loader\Params;
use Espo\Core\ORM\EntityManager;
use Espo\Entities\User;

/**
 * @implements Loader<Email>
 */
class UserColumnsLoader implements Loader
{
    private EntityManager $entityManager;
    private User $user;

    public function __construct(EntityManager $entityManager, User $user)
    {
        $this->entityManager = $entityManager;
        $this->user = $user;
    }

    public function process(Entity $entity, Params $params): void
    {
        $emailUser = $this->entityManager
            ->getRDBRepository(Email::RELATIONSHIP_EMAIL_USER)
            ->select([
                Email::USERS_COLUMN_IS_READ,
                Email::USERS_COLUMN_IS_IMPORTANT,
                Email::USERS_COLUMN_IN_TRASH,
            ])
            ->where([
                'deleted' => false,
                'userId' => $this->user->getId(),
                'emailId' => $entity->getId(),
            ])
            ->findOne();

        if (!$emailUser) {
            $entity->set(Email::USERS_COLUMN_IS_READ, null);
            $entity->clear(Email::USERS_COLUMN_IS_IMPORTANT);
            $entity->clear(Email::USERS_COLUMN_IN_TRASH);

            return;
        }

        $entity->set([
            Email::USERS_COLUMN_IS_READ => $emailUser->get(Email::USERS_COLUMN_IS_READ),
            Email::USERS_COLUMN_IS_IMPORTANT => $emailUser->get(Email::USERS_COLUMN_IS_IMPORTANT),
            Email::USERS_COLUMN_IN_TRASH => $emailUser->get(Email::USERS_COLUMN_IN_TRASH),
        ]);
    }
}
