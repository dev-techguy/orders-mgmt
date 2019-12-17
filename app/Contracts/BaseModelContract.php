<?php

namespace App\Contracts;

interface BaseModelContract
{
    public function limit(int $count);
    public function select(...$args);
    public function get();
}
