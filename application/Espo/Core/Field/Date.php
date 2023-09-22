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

namespace Espo\Core\Field;

use Espo\Core\Field\DateTime\DateTimeable;

use DateTimeImmutable;
use DateTimeInterface;
use DateInterval;
use DateTimeZone;
use RuntimeException;

/**
 * A date value object. Immutable.
 *
 * @immutable
 */
class Date implements DateTimeable
{
    private string $value;
    private DateTimeImmutable $dateTime;

    private const SYSTEM_FORMAT = 'Y-m-d';

    public function __construct(string $value)
    {
        if (!$value) {
            throw new RuntimeException("Empty value.");
        }

        $this->value = $value;

        $parsedValue = DateTimeImmutable::createFromFormat(
            '!' . self::SYSTEM_FORMAT,
            $value,
            new DateTimeZone('UTC')
        );

        if ($parsedValue === false) {
            throw new RuntimeException("Bad value.");
        }

        $this->dateTime = $parsedValue;

        if ($this->value !== $this->dateTime->format(self::SYSTEM_FORMAT)) {
            throw new RuntimeException("Bad value.");
        }
    }

    /**
     * Get a string value in `Y-m-d` format.
     */
    public function getString(): string
    {
        return $this->value;
    }

    /**
     * Get DateTimeImmutable.
     */
    public function getDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    /**
     * Get a timestamp.
     */
    public function getTimestamp(): int
    {
        return $this->dateTime->getTimestamp();
    }

    /**
     * Get a year.
     */
    public function getYear(): int
    {
        return (int) $this->dateTime->format('Y');
    }

    /**
     * Get a month.
     */
    public function getMonth(): int
    {
        return (int) $this->dateTime->format('n');
    }

    /**
     * Get a day (of month).
     */
    public function getDay(): int
    {
        return (int) $this->dateTime->format('j');
    }

    /**
     * Get a day of week. 0 (for Sunday) through 6 (for Saturday).
     */
    public function getDayOfWeek(): int
    {
        return (int) $this->dateTime->format('w');
    }

    /**
     * Clones and modifies.
     */
    public function modify(string $modifier): self
    {
        /** @var DateTimeImmutable|false $dateTime */
        $dateTime = $this->dateTime->modify($modifier);

        if (!$dateTime) {
            throw new RuntimeException("Modify failure.");
        }

        return self::fromDateTime($dateTime);
    }

    /**
     * Clones and adds an interval.
     */
    public function add(DateInterval $interval): self
    {
        $dateTime = $this->dateTime->add($interval);

        return self::fromDateTime($dateTime);
    }

    /**
     * Clones and subtracts an interval.
     */
    public function subtract(DateInterval $interval): self
    {
        $dateTime = $this->dateTime->sub($interval);

        return self::fromDateTime($dateTime);
    }

    /**
     * Add days.
     */
    public function addDays(int $days): self
    {
        $modifier = ($days >= 0 ? '+' : '-') . abs($days) . ' days';

        return $this->modify($modifier);
    }

    /**
     * Add months.
     */
    public function addMonths(int $months): self
    {
        $modifier = ($months >= 0 ? '+' : '-') . abs($months) . ' months';

        return $this->modify($modifier);
    }

    /**
     * Add years.
     */
    public function addYears(int $years): self
    {
        $modifier = ($years >= 0 ? '+' : '-') . abs($years) . ' years';

        return $this->modify($modifier);
    }

    /**
     * A difference between another object (date or date-time) and self.
     */
    public function diff(DateTimeable $other): DateInterval
    {
        return $this->getDateTime()->diff($other->getDateTime());
    }

    /**
     * Whether greater than a given value.
     */
    public function isGreaterThan(DateTimeable $other): bool
    {
        return $this->getDateTime() > $other->getDateTime();
    }

    /**
     * Whether less than a given value.
     */
    public function isLessThan(DateTimeable $other): bool
    {
        return $this->getDateTime() < $other->getDateTime();
    }

    /**
     * Whether equals to a given value.
     */
    public function isEqualTo(DateTimeable $other): bool
    {
        return $this->getDateTime() == $other->getDateTime();
    }

    /**
     * Create a today.
     */
    public static function createToday(?DateTimeZone $timezone = null): self
    {
        $now = new DateTimeImmutable();

        if ($timezone) {
            $now = $now->setTimezone($timezone);
        }

        return self::fromDateTime($now);
    }

    /**
     * Create from a string with a date in `Y-m-d` format.
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    /**
     * Create from a DateTimeInterface.
     */
    public static function fromDateTime(DateTimeInterface $dateTime): self
    {
        $value = $dateTime->format(self::SYSTEM_FORMAT);

        return new self($value);
    }
}
