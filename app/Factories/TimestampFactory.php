<?php

namespace App\Factories;

class TimestampFactory
{
    public static function make($period)
    {
        $class = 'App\Classes\Timestamps\\' . ucfirst($period) . 'Timestamp';
        return new $class();
    }
}
