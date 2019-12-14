<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function make($request)
    {
        $product = Product::find($request['product_id']);

        $request['price'] = $product->price;
        $request['currency'] = $product->currency;
        $request['total'] = $this->computeTotal(
            $product,
            $request['quantity']
        );

        return $this->create($request);
    }

    private function computeTotal(Product $product, $quantity)
    {
        $total = $product->price * $quantity;

        if ($product->isDiscountable($quantity)) {
            $discounted = ($product->discount / 100) * $total;
            $total -= $discounted;
        }
        return $total;
    }
}
