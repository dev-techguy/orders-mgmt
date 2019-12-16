<?php

namespace App\Traits;

use App\Factories\TimestampFactory;
use App\Exceptions\InvalidTimestampException;

trait Timestamp
{
    private $acceptedPeriods = ['week', 'all', 'today'];

    public function getTimestamps($period)
    {
        if (!in_array($period, $this->acceptedPeriods)) {
            throw new InvalidTimestampException();
        }

        return TimestampFactory::make($period)->getTimestamps();
    }
}
