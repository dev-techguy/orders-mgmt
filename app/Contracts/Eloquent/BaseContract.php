<?php

namespace App\Contracts\Eloquent;

interface BaseContract
{
    public function limit(int $count);
    public function select(...$args);
    public function get();
}
