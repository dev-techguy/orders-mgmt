<?php

namespace App\Classes\Timestamps;

class TodayTimestamp extends BaseTimestamp
{
    public function __construct()
    {
        parent::__construct(
            now()->startOfDay()->toDateTimeString(),
            now()->toDateTimeString()
        );
    }
}
