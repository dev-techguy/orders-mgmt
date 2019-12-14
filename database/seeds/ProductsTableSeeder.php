<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = ['John Smith', 'Laura Stone', 'Jon Olson'];
        $products = [
            ['name' => 'Fanta', 'price' => '1.0', 'discount' => null],
            ['name' => 'Coca Cola', 'price' => '1.80', 'discount' => null],
            ['name' => 'Pepsi Cola', 'price' => '1.60', 'discount' => 20]
        ];
        foreach ($products as $product => $object) {
            App\Product::firstOrCreate(
                ['name' => $object['name']],
                [
                    'price' => $object['price'], 'discount' => $object['discount']
                ]
            );
        }
    }
}
