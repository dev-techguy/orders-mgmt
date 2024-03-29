<?php

namespace App\Repositories\Eloquent;

use App\Product;
use App\Contracts\ProductContract;

class ProductRepository extends BaseRepository implements ProductContract
{
    public function __construct()
    {
        parent::__construct(new Product());
    }
}
