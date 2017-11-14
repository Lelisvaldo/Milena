# Calendar (PHP class)

[![Latest Stable Version](https://poser.pugx.org/10quality/php-calendar/v/stable)](https://packagist.org/packages/10quality/php-calendar)
[![Total Downloads](https://poser.pugx.org/10quality/php-calendar/downloads)](https://packagist.org/packages/10quality/php-calendar)
[![License](https://poser.pugx.org/10quality/php-calendar/license)](https://packagist.org/packages/10quality/php-calendar)

Calendar handler library for PHP.

**NOTE:** This class will not echo / print the calendar.

Features:

* Handles monthly weeks and days.
* Ability to attach data.
* Able to be render in any custom template.

## Installation

With composer, make the dependecy required in your project:
```bash
composer require 10quality/php-calendar
```

## Usage

The following example will build the calendar for the current month:

```php
use TenQuality\Utility\Calendar;

$calendar = new Calendar();
$calendar->build();
```

### Attaching data

```php
// Example
$data = array();
$data[] = $obj; // Either ARRAY or OBJECT

$calendar = new Calendar();
$calendar->data = $data;
// Array column or object filed containing the date related to each data row
$calendar->dataDateFiled = 'dateCreated';
// Build
$calendar->build();
```

### Printing

Printing example:
```html
<table>
    <thead>
        <tr>
            <?php foreach ($calendar->headers as $header) : ?>
                <th><?php echo $header ?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($calendar->weeks as $week) : ?>
            <tr>
                <?php foreach ($week->days as $day) : ?>
                    <td>
                        <h2><?php echo $day->number ?></h2>
                        <?php foreach ($day->data as $row) : ?>
                            <!--TODO: What ever needs to be done with data-->
                        <?php endforeach ?>
                    </td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
```

### Other properties or methods

Build calendar for a specific date:
```php
$calendar = new Calendar('2017-01-25');
$calendar->build();
```

Get previous and next month dates:
```php
$calendar = new Calendar('2017-01-25');
$calendar->nextMonthDate;
$calendar->prevMonthDate;
```

## Coding guidelines

PSR-4.

## LICENSE

The MIT License (MIT)

Copyright (c) 2017 [10Quality](http://www.10quality.com).
