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

namespace Espo\Classes\MassAction\Email;

use Espo\Core\Exceptions\BadRequest;
use Espo\Core\Exceptions\Forbidden;
use Espo\Core\MassAction\Data;
use Espo\Core\MassAction\MassAction;
use Espo\Core\MassAction\Params;
use Espo\Core\MassAction\QueryBuilder;
use Espo\Core\MassAction\Result;
use Espo\Entities\Email;
use Espo\Entities\EmailFolder;
use Espo\Entities\GroupEmailFolder;
use Espo\Entities\User;
use Espo\ORM\EntityManager;
use Espo\Tools\Email\Folder;
use Espo\Tools\Email\InboxService as EmailService;
use Exception;

class MoveToFolder implements MassAction
{
    private const FOLDER_INBOX = Folder::INBOX;

    public function __construct(
        private QueryBuilder $queryBuilder,
        private EntityManager $entityManager,
        private EmailService $service,
        private User $user
    ) {}

    /**
     * @throws BadRequest
     * @throws Forbidden
     */
    public function process(Params $params, Data $data): Result
    {
        $folderId = $data->get('folderId');

        if (!is_string($folderId)) {
            throw new BadRequest("No folder ID.");
        }

        if ($folderId !== self::FOLDER_INBOX && !str_starts_with($folderId, 'group:')) {
            $folder = $this->entityManager
                ->getRDBRepositoryByClass(EmailFolder::class)
                ->where([
                    'assignedUserId' => $this->user->getId(),
                    'id' => $folderId,
                ])
                ->findOne();

            if (!$folder) {
                throw new Forbidden("Folder not found.");
            }
        }

        if ($folderId && str_starts_with($folderId, 'group:')) {
            $folder = $this->entityManager
                ->getRDBRepositoryByClass(GroupEmailFolder::class)
                ->where(['id' => substr($folderId, 6)])
                ->findOne();

            if (!$folder) {
                throw new Forbidden("Group folder not found.");
            }
        }

        $query = $this->queryBuilder->build($params);

        $collection = $this->entityManager
            ->getRDBRepositoryByClass(Email::class)
            ->clone($query)
            ->sth()
            ->select(['id'])
            ->find();

        $count = 0;

        foreach ($collection as $email) {
            try {
                $this->service->moveToFolder($email->getId(), $folderId, $this->user->getId());
            }
            catch (Exception) {
                continue;
            }

            $count++;
        }

        return new Result($count);
    }
}
