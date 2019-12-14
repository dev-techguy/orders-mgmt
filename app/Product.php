<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function hasDiscount()
    {
        return null !== $this->discount;
    }

    public function issueDiscount($value, $units = null)
    {
        $units = $units ?? config('product.discount.units');
        return $this->update(['discount' => $value, 'discount_units' => $units]);
    }

    public function discountableUnits()
    {
        return $this->discount_units;
    }

    public function isDiscountable($units)
    {
        return $units >= $this->discountableUnits();
    }
}
