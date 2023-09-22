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

namespace Espo\Tools\Formula;

use Espo\Core\Formula\Parser;
use Espo\Core\Formula\Exceptions\SyntaxError;
use Espo\Core\Formula\Exceptions\Error;
use Espo\Core\Formula\Manager;
use Espo\Core\Field\LinkParent;

use Espo\Core\Exceptions\NotFoundSilent;

use Espo\ORM\EntityManager;
use Espo\ORM\Entity;

class Service
{
    private Parser $parser;

    private Manager $manager;

    private EntityManager $entityManager;

    public function __construct(Parser $parser, Manager $manager, EntityManager $entityManager)
    {
        $this->parser = $parser;
        $this->manager = $manager;
        $this->entityManager = $entityManager;
    }

    public function checkSyntax(string $expression): SyntaxCheckResult
    {
        try {
            $this->parser->parse($expression);

            $result = SyntaxCheckResult::createSuccess();
        }
        catch (SyntaxError $e) {
            return SyntaxCheckResult::createError($e);
        }

        return $result;
    }

    public function run(string $expression, ?LinkParent $targetLink = null): RunResult
    {
        $syntaxCheckResult = $this->checkSyntax($expression);

        if (!$syntaxCheckResult->isSuccess()) {
            /** @var SyntaxError $exception */
            $exception = $syntaxCheckResult->getException();

            return RunResult::createSyntaxError($exception);
        }

        $target = null;

        if ($targetLink) {
            $target = $this->entityManager->getEntityById($targetLink->getEntityType(), $targetLink->getId());

            if (!$target) {
                throw new NotFoundSilent("Target entity not found.");
            }
        }

        $variables = (object) [];

        try {
            $this->manager->run($expression, $target, $variables);
        }
        catch (Error $e) {
            $output = $variables->__output ?? null;

            return RunResult::createError($e, $output);
        }

        if ($target && $this->isEntityChanged($target)) {
            $this->entityManager->saveEntity($target);
        }

        $output = $variables->__output ?? null;

        return RunResult::createSuccess($output);
    }

    private function isEntityChanged(Entity $entity): bool
    {
        foreach ($entity->getAttributeList() as $attribute) {
            if ($entity->isAttributeChanged($attribute)) {
                return true;
            }
        }

        return false;
    }
}
