<?php

namespace TenQuality\Utility;

use Exception;
use TenQuality\Utility\Calendar\Week;
use TenQuality\Utility\Calendar\Day;

/**
 * Calendar handler class.
 * Handles days and data in a current month for its proper display.
 * *DO NOT* displays or echos the calendar.
 *
 * @author Alejandro Mostajo <info@10quality.com>
 * @copyright 10 Quality <http://www.10quality.com>
 * @license MIT
 * @package TenQuality\Utility
 * @version 1.0.1
 */
class Calendar
{
    /**
     * Date with which calendar is generated.
     * @since 1.0.0
     * @var string
     */
    protected $date;
    /**
     * Calendar headers.
     * @since 1.0.0
     * @var array
     */
    protected $headers = array(
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday',
    );
    /**
     * Calendar weeks.
     * @since 1.0.0
     * @var array
     */
    protected $weeks = array();
    /**
     * Amount of thays in the month.
     * @since 1.0.0
     * @var int
     */
    protected $daysInMonth;
    /**
     * First day of the month.
     * @since 1.0.0
     * @var int
     */
    protected $firstDay;
    /**
     * Last day of the month.
     * @since 1.0.0
     * @var int
     */
    protected $lastDay;
    /**
     * Calendar data.
     * @since 1.0.0
     * @var array
     */
    protected $data = array();
    /**
     * Date field to compare to in order to add data to a day.
     * @since 1.0.0
     * @var string
     */
    protected $dataDateField;
    /**
     * Default constructor.
     * @since 1.0.0
     *
     * @param string $date Calendar base date.
     */
    public function __construct($date = null)
    {
        $this->date         = $date ? $date : date('Y-m-d');
        $time = strtotime($this->date);
        $this->daysInMonth  = cal_days_in_month(CAL_GREGORIAN, date('m', $time), date('Y', $time));
        $this->firstDay     = sprintf('%s-%s-%s', date('Y', $time), date('m', $time), 1);
        $this->lastDay      = sprintf('%s-%s-%s', date('Y', $time), date('m', $time), $this->daysInMonth);
    }
    /**
     * Builds calendar based on date.
     * @since 1.0.0
     * @since 1.0.1 Force data retrival.
     *
     * @return object this
     */
    public function build()
    {
        $week = new Week;
        for ($day = 1; $day <= $this->daysInMonth; ++$day) {
            $date = sprintf('%s-%s-%s', date('Y', strtotime($this->date)), date('m', strtotime($this->date)), $day);
            $cDay = new Day($day);
            $cDay->dayWeek  = date('N', strtotime($date));
            $cDay->isToday  = strtotime($date) == strtotime(date('Y-m-d'));
            // Data
            if (isset($this->dataDateField)) {
                for ($i = 0; $i < count($this->data); ++$i) {
                    if ((
                            is_array($this->data[$i])
                            && $this->data[$i][$this->dataDateField]
                            && strtotime($date) === strtotime($this->data[$i][$this->dataDateField])
                        )
                        || (
                            is_object($this->data[$i])
                            && $this->data[$i]->{$this->dataDateField}
                            && strtotime($date) === strtotime($this->data[$i]->{$this->dataDateField})
                        )
                    )
                        $cDay->data[] = $this->data[$i];
                }
            }
            // Check if we need to fill previous month days
            if ($day == 1 && $cDay->dayWeek > 1) {
                for ($dummyDay = 1; $dummyDay < $cDay->dayWeek; ++$dummyDay) {
                    $week->days[] = new Day('');
                }
            }
            // Add day to calendar
            $week->days[] = $cDay;
            // Check if this is the last day to fill with dummies
            if ($day == $this->daysInMonth) {
                for ($dummyDay = $cDay->dayWeek + 1; $dummyDay <= 7; ++$dummyDay) {
                    $week->days[] = new Day('');
                }
            }
            // Add row to calendar if days are full
            if (count($week->days) == 7) {
                $this->weeks[] = $week;
                $week = new Week;
            }
        }
        return $this;
    }
    /**
     * Getter function.
     * @since 1.0.0
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        switch ($property) {
            case 'nextMonthDate':
                return date('Y-m-01', strtotime('+1 months', strtotime($this->date)));
            case 'prevMonthDate':
                return date('Y-m-01', strtotime('-1 months', strtotime($this->date)));
        }
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /**
     * Setter function.
     * @since 1.0.0
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return object
     */
    public function __set($property, $value)
    {
        switch ($property) {
            case 'data':
                if (!is_array($value))
                    throw new Exception('Data must be an array.');
                break;
        }
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
}