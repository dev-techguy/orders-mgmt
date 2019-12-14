<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Factories\TimestampFactory;
use App\Exceptions\InvalidTimestampException;

trait Timestamp
{
    private $acceptedPeriods = ['week', 'all', 'today'];

    public function getTimestamps(Request $request)
    {
        $period = $request->get('period');

        if (!in_array($period, $this->acceptedPeriods)) {
            throw new InvalidTimestampException();
        }

        return TimestampFactory::make($period)->getTimestamps();
    }
}
