<?php

namespace App\Classes\Timestamps;

use App\Contracts\Timestamp;

abstract class BaseTimestamp implements Timestamp
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function getTimestamps(): array
    {
        return [$this->from, $this->to];
    }
}
