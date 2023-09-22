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

namespace Espo\Tools\Layout;

use Espo\Core\InjectableFactory;
use Espo\Core\Utils\File\Manager as FileManager;
use Espo\Core\Utils\Json;
use Espo\Core\Utils\Resource\FileReader;
use Espo\Core\Utils\Resource\FileReader\Params as FileReaderParams;
use RuntimeException;

class LayoutProvider
{
    private string $defaultPath = 'application/Espo/Resources/defaults/layouts';

    /** @internal Used by the portal layout util. */
    protected FileReader $fileReader;

    public function __construct(
        private FileManager $fileManager,
        private InjectableFactory $injectableFactory,
        FileReader $fileReader
    ) {
        $this->fileReader = $fileReader;
    }

    public function get(string $scope, string $name): ?string
    {
        if (
            $this->sanitizeInput($scope) !== $scope ||
            $this->sanitizeInput($name) !== $name
        ) {
            throw new RuntimeException("Bad parameters.");
        }

        $path = 'layouts/' . $scope . '/' . $name . '.json';

        $params = FileReaderParams::create()
            ->withScope($scope);

        if ($this->fileReader->exists($path, $params)) {
            return $this->fileReader->read($path, $params);
        }

        return $this->getDefault($scope, $name);
    }

    private function getDefault(string $scope, string $name): ?string
    {
        $defaultImplClassName = 'Espo\\Custom\\Classes\\DefaultLayouts\\' . ucfirst($name) . 'Type';

        if (!class_exists($defaultImplClassName)) {
            $defaultImplClassName = 'Espo\\Classes\\DefaultLayouts\\' . ucfirst($name) . 'Type';
        }

        if (class_exists($defaultImplClassName)) {
            // @todo Use factory and interface.
            $defaultImpl = $this->injectableFactory->create($defaultImplClassName);

            if (!method_exists($defaultImpl, 'get')) {
                throw new RuntimeException("No 'get' method in '$defaultImplClassName'.");
            }

            $data = $defaultImpl->get($scope);

            return Json::encode($data);
        }

        $filePath = $this->defaultPath . '/' . $name . '.json';

        if (!$this->fileManager->isFile($filePath)) {
            return null;
        }

        return $this->fileManager->getContents($filePath);
    }

    protected function sanitizeInput(string $name): string
    {
        /** @var string */
        return preg_replace("([.]{2,})", '', $name);
    }
}
