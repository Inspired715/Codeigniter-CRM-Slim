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

namespace Espo\Tools\WorkingTime;

use Espo\Core\Binding\BindingContainerBuilder;
use Espo\Core\InjectableFactory;
use Espo\Entities\Team;
use Espo\Entities\User;

class CalendarUtilityFactory
{
    private InjectableFactory $injectableFactory;
    private CalendarFactory $calendarFactory;

    public function __construct(
        InjectableFactory $injectableFactory,
        CalendarFactory $calendarFactory
    ) {
        $this->injectableFactory = $injectableFactory;
        $this->calendarFactory = $calendarFactory;
    }

    public function create(Calendar $calendar): CalendarUtility
    {
        return $this->injectableFactory->createWithBinding(
            CalendarUtility::class,
            BindingContainerBuilder::create()
                ->bindInstance(Calendar::class, $calendar)
                ->build()
        );
    }

    public function createForUser(User $user): CalendarUtility
    {
        $calendar = $this->calendarFactory->createForUser($user);

        return $this->create($calendar);
    }

    public function createForTeam(Team $team): CalendarUtility
    {
        $calendar = $this->calendarFactory->createForTeam($team);

        return $this->create($calendar);
    }

    public function createGlobal(): CalendarUtility
    {
        $calendar = $this->calendarFactory->createGlobal();

        return $this->create($calendar);
    }
}
