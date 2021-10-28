<?php

namespace Jawabkom\Backend\Module\Profile\Library;


use Jawabkom\Backend\Module\Profile\Exception\InvalidDateTimeFormat;

class DateFormat
{

    public static function assertValidDateFormat(string $date , $format , $errorMessage)
    {
        if (!static::validateDate($date,$format))
            throw new InvalidDateTimeFormat($errorMessage);
    }
    
    private static function validateDate($date, $format = 'Y-m-d'){
        $dateFromFormat = \DateTime::createFromFormat($format, $date);
        return $dateFromFormat && $dateFromFormat->format($format) === $date;
    }

}
