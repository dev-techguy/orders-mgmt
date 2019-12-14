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
    function required_fields_must_be_sent()
    {
        $response = $this->postJson(route('orders'));
        $response->assertStatus(422);
        $response->assertJsonCount(3, 'errors');
        $response->assertJsonStructure([
            'errors' => [
                'product_id',
                'user_id',
                'quantity'
            ]
        ]);
    }

    /** @test */
    function only_valid_user_and_product_must_be_allowed()
    {
        $response = $this->postJson(route('orders'), [
            'product_id' => 30,
            'user_id' => 17,
            'quantity' => 2
        ]);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'product_id',
                'user_id'
            ]
        ]);
    }

    /** @test */
    function an_order_may_be_made()
    {
        $this->assertCount(0, Order::all());
        $order = factory(Order::class)->raw(['quantity' => 1]);
        $this->postJson(route('orders'), $order)->assertOk();
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
    function discount_should_apply_on_quantity_above_3($price, $quantity, $discount, $total)
    {
        $product = factory(Product::class)->create(['price' => $price]);
        $product->issueDiscount($discount);
        $order = factory(Order::class)->raw(['quantity' => $quantity, 'product_id' => $product->id]);

        $this->postJson(route('orders'), $order)->assertOk();
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
        $response = $this->getJson(route('orders.all'))->assertOk();
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
