<?php

namespace App\Http\Controllers;

use App\Contracts\ProductContract;

class ProductController extends Controller
{
    public function index(ProductContract $product)
    {
        $products = $product->limit(5)
            ->select('id', 'name', 'price', 'currency', 'discount')
            ->get();

        return $this->successJson($products);
    }
}
