<?php

use Exception;
use TenQuality\Utility\Calendar;

/**
 * Unit test.
 *
 * @author Alejandro Mostajo <info@10quality.com>
 * @copyright 10 Quality <http://www.10quality.com>
 * @license MIT
 * @package TenQuality\Utility
 * @version 1.0.0
 */
class CalendarTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test construct and default date.
     */
    public function testConstruct()
    {
        // Prepare
        $calendar = new Calendar();
        // Assert
        $this->assertEquals(date('Y-m-d'), $calendar->date);
    }
    /**
     * Test build and check if weeks are generated.
     */
    public function testBuild()
    {
        // Prepare
        $calendar = new Calendar();
        $calendar->build();
        // Assert
        $this->assertNotEmpty($calendar->weeks);
    }
    /**
     * Test build and check if days are generated correctly.
     */
    public function testBuildWeek()
    {
        // Prepare
        $calendar = new Calendar('2017-02-2');
        $calendar->build();
        // Assert
        $this->assertEquals(6, $calendar->weeks[1]->days[0]->number); // Monday 6th, Feb 2017
        $this->assertEquals(14, $calendar->weeks[2]->days[1]->number); // Tuesday 14th, Feb 2017
    }
    /**
     * Test next and prev month values.
     */
    public function testNextPrev()
    {
        // Prepare
        $calendar = new Calendar('2017-02-2');
        // Assert
        $this->assertEquals('2017-01-01', $calendar->prevMonthDate);
        $this->assertEquals('2017-03-01', $calendar->nextMonthDate);
    }
    /**
     * Test data type.
     *
     * @expectedException Exception
     */
    public function testDataException()
    {
        // Prepare
        $calendar = new Calendar('2017-02-2');
        $calendar->data = new stdClass;
    }
    /**
     * Test data assignment in calendar.
     */
    public function testDataArray()
    {
        // Prepare
        $calendar = new Calendar('2017-02-2');
        $calendar->data = [
            [
                'value' => 55,
                'date'  => '2017-02-06',
            ],
            [
                'value' => 101,
                'date'  => '2017-02-14',
            ],
            [
                'value' => 65,
                'date'  => '2017-02-22',
            ],
        ];
        $calendar->dataDateField = 'date';
        $calendar->build();
        // Assert
        $this->assertEquals(55, $calendar->weeks[1]->days[0]->data[0]['value']); // Monday 6th, Feb 2017
        $this->assertEquals(101, $calendar->weeks[2]->days[1]->data[0]['value']); // Data Tuesday 14th, Feb 2017
        $this->assertEmpty($calendar->weeks[1]->days[1]->data); // Tuesday 7th, Feb 2017
    }
    /**
     * Test data assignment in calendar.
     */
    public function testDataObject()
    {
        // Prepare
        $obj = new stdClass;
        $obj->value = 98555;
        $obj->date = '2017-02-06';
        $calendar = new Calendar('2017-02-2');
        $calendar->data = [
            $obj
        ];
        $calendar->dataDateField = 'date';
        $calendar->build();
        // Assert
        $this->assertEquals(98555, $calendar->weeks[1]->days[0]->data[0]->value); // Monday 6th, Feb 2017
        $this->assertEmpty($calendar->weeks[1]->days[1]->data); // Tuesday 7th, Feb 2017
    }
    /**
     * Test filed days of the following month.
     */
    public function testFillNextDates()
    {
        // Prepare
        $calendar = new Calendar('2017-02-2');
        $calendar->build();
        // Assert
        $this->assertEmpty($calendar->weeks[4]->days[2]->number); // Wednesday 1st, Mar 2017
        $this->assertNotEmpty($calendar->weeks[4]->days[1]->number); // Tuesday 28th, Feb 2017
    }
    /**
     * Test filed days of the previous month.
     */
    public function testFillPrevDates()
    {
        // Prepare
        $calendar = new Calendar('2017-02-2');
        $calendar->build();
        // Assert
        $this->assertEmpty($calendar->weeks[0]->days[0]->number); // Monday 30th, Jan 2017
        $this->assertNotEmpty($calendar->weeks[0]->days[2]->number); // Wednesday 1st, Feb 2017
    }
}