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

namespace Espo\Core\Select\Order;

use Espo\Entities\User;

use Espo\Core\InjectableFactory;
use Espo\Core\Utils\Metadata;
use Espo\Core\Binding\BindingContainerBuilder;
use Espo\Core\Binding\ContextualBinder;

use RuntimeException;

class ItemConverterFactory
{
    public function __construct(
        private InjectableFactory $injectableFactory,
        private Metadata $metadata,
        private User $user
    ) {}

    public function has(string $entityType, string $field): bool
    {
        return (bool) $this->getClassName($entityType, $field);
    }

    public function create(string $entityType, string $field): ItemConverter
    {
        $className = $this->getClassName($entityType, $field);

        if (!$className) {
            throw new RuntimeException("Order item converter class name is not defined.");
        }

        $container = BindingContainerBuilder::create()
            ->bindInstance(User::class, $this->user)
            ->inContext($className, function (ContextualBinder $binder) use ($entityType) {
                $binder->bindValue('$entityType', $entityType);
            })
            ->build();

        return $this->injectableFactory->createWithBinding($className, $container);
    }

    /**
     * @return ?class-string<ItemConverter>
     */
    private function getClassName(string $entityType, string $field): ?string
    {
        /** @var ?class-string<ItemConverter> $className1 */
        $className1 = $this->metadata->get([
            'selectDefs', $entityType, 'orderItemConverterClassNameMap', $field
        ]);

        if ($className1) {
            return $className1;
        }

        $type = $this->metadata->get([
            'entityDefs', $entityType, 'fields', $field, 'type'
        ]);

        if (!$type) {
            return null;
        }

        /** @var ?class-string<ItemConverter> $className2 */
        $className2 = $this->metadata->get([
            'app', 'select', 'orderItemConverterClassNameMap', $type
        ]);

        if ($className2) {
            return $className2;
        }

        $className3 = 'Espo\\Core\\Select\\Order\\ItemConverters\\' . ucfirst($type) . 'Type';

        if (class_exists($className3)) {
            /** @var class-string<ItemConverter> */
            return $className3;
        }

        return null;
    }
}
