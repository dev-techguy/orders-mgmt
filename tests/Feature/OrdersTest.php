<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrdersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function an_order_may_be_made()
    {
        $this->assertCount(0, Order::all());
        $order = factory(Order::class)->raw(['quantity' => 1]);
        $this->post(route('orders'), $order)->assertOk();
        $this->assertCount(1, Order::all());
        $product = Product::find($order['product_id']);
        $this->assertDatabaseHas('orders', [
            'user_id' => $order['user_id'],
            'product_id' => $order['product_id'],
            'quantity' => $order['quantity'],
            'price' => $product['price'],
            'currency' => 'EUR',
            'total' => $product['price'] * $order['quantity']
        ]);
    }

    /** 
     * @test
     * @dataProvider productDiscounts
     */
    function total_should_be_discount_if_product_has_discount_and_quantity_is_at_least_3($price, $quantity, $discount, $total)
    {
        $product = factory(Product::class)->create(['price' => $price]);
        $product->issueDiscount($discount, 3);
        $order = factory(Order::class)->raw(['quantity' => $quantity, 'product_id' => $product->id]);

        $this->post(route('orders'), $order)->assertOk();
        $this->assertCount(1, Order::all());
        $product = Product::find($order['product_id']);

        $this->assertDatabaseHas('orders', [
            'user_id' => $order['user_id'],
            'product_id' => $order['product_id'],
            'quantity' => $quantity,
            'price' => $price,
            'currency' => 'EUR',
            'total' => $total
        ]);
    }

    /** @test */
    function all_orders_may_be_listed()
    {
        factory(Order::class, 5)->create();
        $response = $this->get(route('orders.all'))->assertOk();
        $response->assertJsonCount(5, 'data.data');
    }

    public function productDiscounts()
    {
        return [
            [100, 3, 20, 240],
            [100, 2, 20, 200],
            [100, 4, 20, 320],
            [100, 5, 20, 400],
        ];
    }
}
