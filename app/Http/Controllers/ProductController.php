<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    public function index(Product $product)
    {
        $products = $product->limit(5)
            ->select(['name', 'price', 'currency', 'discount'])
            ->get();

        return $this->successJson($products);
    }
}
