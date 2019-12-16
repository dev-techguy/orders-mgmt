<?php

namespace App\Contracts\Eloquent;

interface OrderContract
{
    public function orderBy(String $field, String $order);
    public function withRelations(String ...$args);
    public function inPeriod(String $period);
    public function paginate(int $count);
    public function make(array $request);
    public function searchFor($string);
    public function update($quantity);
    public function findById($id);
    public function delete();
    public function get();
}