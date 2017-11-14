<?php

namespace TenQuality\Utility\Calendar;

/**
 * Calendar day class.
 *
 * @author Alejandro Mostajo <info@10quality.com>
 * @copyright 10 Quality <http://www.10quality.com>
 * @license MIT
 * @package TenQuality\Utility
 * @version 1.0.0
 */
class Day
{
    /**
     * Day number.
     * @since 1.0.0
     * @var int
     */
    protected $number;
    /**
     * Day of the week.
     * @since 1.0.0
     * @var int
     */
    protected $dayWeek;
    /**
     * Day's data.
     * @since 1.0.0
     * @var array
     */
    protected $data = [];
    /**
     * Flag that indicates if day is today.
     * @since 1.0.0
     * @var bool
     */
    protected $isToday = false;
    /**
     * Default constructor.
     *
     * @param mixed $number Day number.
     */
    public function __construct($number)
    {
        $this->number   = $number;
        $this->isToday  = false;
    }
    /**
     * Getter function.
     *
     * @param string $property
     *
     * @return mixed
     */
    public function &__get ($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    /**
     * Setter function.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return object
     */
    public function __set ($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
}