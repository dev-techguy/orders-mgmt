<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'product_id' => factory(Product::class)->create()->id,
        'quantity' => $faker->numberBetween(1, 5)
    ];
});
