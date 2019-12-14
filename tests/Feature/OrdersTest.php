<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use App\User;
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

    /** @test */
    function an_order_may_be_deleted()
    {
        [$order1, $order2] = factory(Order::class, 2)->create();
        $this->assertDatabaseHas('orders', ['id' => $order1->id]);
        $this->deleteJson(route('orders.delete', $order1->id))->assertOk();
        $this->assertDatabaseMissing('orders', ['id' => $order1->id]);
        $this->assertEquals(1, Order::count());
        $this->assertDatabaseHas('orders', ['id' => $order2->id]);
    }

    /** 
     * @test
     * @dataProvider quantities
     */
    function an_order_may_be_updated($quantity, $total)
    {
        $order = $this->orderProductWithDiscount(3);
        $this->assertEquals(240, $order->fresh()->total);
        $request = ['quantity' => $quantity, 'order_id' => $order->id];

        $this->patchJson(route('orders.update', $order->id), $request)->assertOk();
        $this->assertEquals($total, $order->fresh()->total);
        $this->assertEquals($quantity, $order->fresh()->quantity);
    }

    /** 
     * @test
     * @dataProvider periods
     */
    function orders_may_be_filtered_by_date_intervals($period, $ordersCount)
    {
        factory(Order::class, 3)->create();
        factory(Order::class, 5)->create(['created_at' => now()->subDays(5)]);

        $response = $this->getJson(route('orders', ['period' => $period]))->assertOk();
        $response->assertJsonCount($ordersCount, 'data.data');
    }

    /** @test */
    function orders_may_be_filtered_by_user_or_product_name()
    {
        factory(Order::class, 5)->create();
        $product = factory(Product::class)->create();
        $user = factory(User::class)->create();
        factory(Order::class, 2)->create(['user_id' => $user->id, 'product_id' => $product->id]);

        $response = $this->getJson(route('search', ['q' => $product->name]))->assertOk();
        $response->assertJsonCount(2, 'data.data');

        $response2 = $this->getJson(route('search', ['q' => $user->name]))->assertOk();
        $response2->assertJsonCount(2, 'data.data');
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

    public function quantities()
    {
        return [
            [2, 200],
            [5, 400]
        ];
    }

    public function periods()
    {
        return [
            ['all', 8],
            ['week', 8],
            ['today', 3],
        ];
    }

    private function orderProductWithDiscount($quantity, $productPrice = 100)
    {
        $product = factory(Product::class)->create(['price' => $productPrice]);
        $product->issueDiscount(20);
        $user = factory(User::class)->create();
        return (new Order())->make([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity
        ]);
    }
}
