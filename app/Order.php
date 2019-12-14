<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

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

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d M Y, g:i A');
    }

    public function updateRecord($quantity)
    {
        $total = $this->computeTotal($this->product, $quantity);

        return $this->update(['quantity' => $quantity, 'total' => $total]);
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
