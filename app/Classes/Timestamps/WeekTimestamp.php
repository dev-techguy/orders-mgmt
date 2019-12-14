<?php

namespace App\Classes\Timestamps;

class WeekTimestamp extends BaseTimestamp
{
    public function __construct()
    {
        parent::__construct(
            now()->subDay(7)->toDateString(),
            now()->toDateTimeString()
        );
    }
}
