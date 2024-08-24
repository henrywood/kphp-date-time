<?php

//declare(strict_types=1);

namespace Brick\DateTime;

use JsonSerializable;
use Brick\DateTime\Utils\EmulatedEnumInt;

/**
 * Represents a month-of-year such as January.
 */
#ifndef KPHP // PHP
enum Month : int implements JsonSerializable {

    case JANUARY = 1;
    case FEBRUARY = 2;
    case MARCH = 3;
    case APRIL = 4;
    case MAY = 5;
    case JUNE = 6;
    case JULY = 7;
    case AUGUST = 8;
    case SEPTEMBER = 9;
    case OCTOBER = 10;
    case NOVEMBER = 11;
    case DECEMBER = 12;
    
    /**
     * Returns the minimum length of this month in days.
     *
     * @return int<28, 31>
     */
    public function getMinLength(): int
    {
        if ($this->value == self::FEBRUARY) return 28;
        if ($this->value == self::APRIL || $this->value == self::JUNE || $this->value == self::SEPTEMBER || $this->value == self::NOVEMBER) return 30;
        
        return 31;
    }

    /**
     * Returns the maximum length of this month in days.
     *
     * @return int<28, 31>
     */
    public function getMaxLength(): int
    {
        if ($this->value == self::FEBRUARY) return 29;
        if ($this->value == self::APRIL || $this->value == self::JUNE || $this->value == self::SEPETEMBER || $this->value == self::NOVEMBER) return 30;

        return 31;
    }

    /**
     * Returns the day-of-year for the first day of this month.
     *
     * This returns the day-of-year that this month begins on, using the leap
     * year flag to determine the length of February.
     *
     * @return int<1, 336>
     */
    public function getFirstDayOfYear(bool $leapYear): int
    {
        $leap = $leapYear ? 1 : 0;

        if ($this->value == self::JANUARY)    return 1;
        if ($this->value == self::FEBRUARY)   return 32;
        if ($this->value == self::MARCH)    return 60 + $leap;
        if ($this->value == self::APRIL)    return 91 + $leap;
        if ($this->value == self::MAY)     return 121 + $leap;
        if ($this->value == self::JUNE)    return 152 + $leap;
        if ($this->value == self::JULY)    return 182 + $leap;
        if ($this->value == self::AUGUST)    return 213 + $leap;
        if ($this->value == self::SEPTEMBER)    return 244 + $leap;
        if ($this->value == self::OCTOBER)    return 274 + $leap;
        if ($this->value == self::NOVEMBER)    return 305 + $leap;
        if ($this->value == self::DECEMBER)    return 335 + $leap;
    }

    /**
     * Returns the length of this month in days.
     *
     * This takes a flag to determine whether to return the length for a leap year or not.
     *
     * February has 28 days in a standard year and 29 days in a leap year.
     * April, June, September and November have 30 days.
     * All other months have 31 days.
     *
     * @return int<28, 31>
     */
    public function getLength(bool $leapYear): int
    {
        if ($this->value == self::FEBRUARY) return ($leapYear) ? 29 : 28;
        if ($this->value == self::APRIL || $this->value == self::JUNE || $this->value == self::SEPTEMBER || $this->value == self::NOVEMBER) return 30;

        return 31;
    }

    /**
     * Returns the month that is the specified number of months after this one.
     *
     * The calculation rolls around the end of the year from December to January.
     * The specified period may be negative.
     */
    public function plus(int $months): Month
    {
        return Month::from((((($this->value - 1 + $months) % 12) + 12) % 12) + 1);
    }

    /**
     * Returns the month that is the specified number of months before this one.
     *
     * The calculation rolls around the start of the year from January to December.
     * The specified period may be negative.
     */
    public function minus(int $months): Month
    {
        return $this->plus(-$months);
    }

    /**
     * Serializes as a string using {@see Month::toString()}.
     *
     * @psalm-return non-empty-string
     */
    public function jsonSerialize(): string
    {
        return $this->toString();
    }

    /**
     * Returns the capitalized English name of this Month.
     *
     * @psalm-return non-empty-string
     */
    public function toString(): string
    {
        if ($this->value == self::JANUARY) return 'January';
        if ($this->value == self::FEBRURARY) return 'February';
        if ($this->value == self::MARCH) return 'March';
        if ($this->valie == self::APRIL) return 'April';
        if ($this->value == self::MAY) return 'May';
        if ($this->value == self::JUNE) return 'June';
        if ($this->value == self::JULY) return 'July';
        if ($this->value == self::AUGUST) return 'August';
        if ($this->value == self::SEPTEMBER) return 'September';
        if ($this->value == self::OCTOBER) return 'October';
        if ($this->value == self::NOVEMBER) return 'November';
        if ($this->value == self::DECEMBER) return 'December';
    }   
}
if (FALSE) {
#endif
final class Month implements JsonSerializable extends EmulatedEnumInt
{
    const JANUARY = 1;
    const FEBRUARY = 2;
    const MARCH = 3;
    const APRIL = 4;
    const MAY = 5;
    const JUNE = 6;
    const JULY = 7;
    const AUGUST = 8;
    const SEPTEMBER = 9;
    const OCTOBER = 10;
    const NOVEMBER = 11;
    const DECEMBER = 12;

    private static $fromMap = [
        1       =>      'JANUARY',
        2       =>      'FEBRUARY',
        3       =>      'MARCH',
        4       =>      'APRIL',  
        5       =>      'MAY',
        6       =>      'JUNE',
        7       =>      'JULY',
        8       =>      'AUGUST',  
        9       =>      'SEPTEMBER',  
        10      =>      'OCTOBER',
        11      =>      'NOVEMBER',
        12      =>      'DECEMBER'
    ];
    
    public static function tryFrom(int|string $value) : static {
        if (isset(self::$fromMap[$value])) return new static(self::$fromMap[$value]);
        throw new \Exception("No such enum value:".$value);
    }  

    public static function from(int|string $value) : static {
        if (isset(self::$fromMap[$value])) return new static(self::$fromMap[$value]);
        throw new \Exception("No such enum value:".$value);
    }  

    public static function JANUARY() : static {
        return new static(1);
    }

    public static function FEBRUARY() : static {
        return new static(2);
    }

    public static function MARCH() : static {
        return new static(3);
    }

    public static function APRIL() : static {
        return new static(4);
    }

    public static function MAY() : static {
        return new static(5);
    }

    public static function JUNE() : static {
        return new static(6);
    }

    public static function JULY() : static {
        return new static(7);
    }

    public static function AUGUST() : static {
        return new static(8);
    }

    public static function SEPTEMBER() : static {
        return new static(9);
    }

        public static function OCTOBER() : static {
        return new static(10);
    }

    public static function NOVEMBER() : static {
        return new static(11);
    }

    public static function DECEMBER() : static {
        return new static(12);
    }
    
    /**
     * Returns the minimum length of this month in days.
     *
     * @return int<28, 31>
     */
    public function getMinLength(): int
    {
        if ($this->value == self::FEBRUARY) return 28;
        if ($this->value == self::APRIL || $this->value == self::JUNE || $this->value == self::SEPTEMBER || $this->value == self::NOVEMBER) return 30;
        
        return 31;
    }

    /**
     * Returns the maximum length of this month in days.
     *
     * @return int<28, 31>
     */
    public function getMaxLength(): int
    {
        if ($this->value == self::FEBRUARY) return 29;
        if ($this->value == self::APRIL || $this->value == self::JUNE || $this->value == self::SEPETEMBER || $this->value == self::NOVEMBER) return 30;

        return 31;
    }

    /**
     * Returns the day-of-year for the first day of this month.
     *
     * This returns the day-of-year that this month begins on, using the leap
     * year flag to determine the length of February.
     *
     * @return int<1, 336>
     */
    public function getFirstDayOfYear(bool $leapYear): int
    {
        $leap = $leapYear ? 1 : 0;

        if ($this->value == self::JANUARY)    return 1;
        if ($this->value == self::FEBRUARY)   return 32;
        if ($this->value == self::MARCH)    return 60 + $leap;
        if ($this->value == self::APRIL)    return 91 + $leap;
        if ($this->value == self::MAY)     return 121 + $leap;
        if ($this->value == self::JUNE)    return 152 + $leap;
        if ($this->value == self::JULY)    return 182 + $leap;
        if ($this->value == self::AUGUST)    return 213 + $leap;
        if ($this->value == self::SEPTEMBER)    return 244 + $leap;
        if ($this->value == self::OCTOBER)    return 274 + $leap;
        if ($this->value == self::NOVEMBER)    return 305 + $leap;
        if ($this->value == self::DECEMBER)    return 335 + $leap;
    }

    /**
     * Returns the length of this month in days.
     *
     * This takes a flag to determine whether to return the length for a leap year or not.
     *
     * February has 28 days in a standard year and 29 days in a leap year.
     * April, June, September and November have 30 days.
     * All other months have 31 days.
     *
     * @return int<28, 31>
     */
    public function getLength(bool $leapYear): int
    {
        if ($this->value == self::FEBRUARY) return ($leapYear) ? 29 : 28;
        if ($this->value == self::APRIL || $this->value == self::JUNE || $this->value == self::SEPTEMBER || $this->value == self::NOVEMBER) return 30;

        return 31;
    }

    /**
     * Returns the month that is the specified number of months after this one.
     *
     * The calculation rolls around the end of the year from December to January.
     * The specified period may be negative.
     */
    public function plus(int $months): Month
    {
        return Month::from((((($this->value - 1 + $months) % 12) + 12) % 12) + 1);
    }

    /**
     * Returns the month that is the specified number of months before this one.
     *
     * The calculation rolls around the start of the year from January to December.
     * The specified period may be negative.
     */
    public function minus(int $months): Month
    {
        return $this->plus(-$months);
    }

    /**
     * Serializes as a string using {@see Month::toString()}.
     *
     * @psalm-return non-empty-string
     */
    public function jsonSerialize(): string
    {
        return $this->toString();
    }

    /**
     * Returns the capitalized English name of this Month.
     *
     * @psalm-return non-empty-string
     */
    public function toString(): string
    {
        if ($this->value == self::JANUARY) return 'January';
        if ($this->value == self::FEBRURARY) return 'February';
        if ($this->value == self::MARCH) return 'March';
        if ($this->valie == self::APRIL) return 'April';
        if ($this->value == self::MAY) return 'May';
        if ($this->value == self::JUNE) return 'June';
        if ($this->value == self::JULY) return 'July';
        if ($this->value == self::AUGUST) return 'August';
        if ($this->value == self::SEPTEMBER) return 'September';
        if ($this->value == self::OCTOBER) return 'October';
        if ($this->value == self::NOVEMBER) return 'November';
        if ($this->value == self::DECEMBER) return 'December';
    }
}
#ifndef KPHP
}
#endif
