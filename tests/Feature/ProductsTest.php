<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_have_discount()
    {
        $product = factory(Product::class)->create();
        $this->assertFalse($product->fresh()->hasDiscount());
        $product->issueDiscount(20, 3);
        $this->assertTrue($product->fresh()->hasDiscount());
        $this->assertEquals(3, $product->fresh()->discountableUnits());
    }

    /** @test */
    function can_fecth_all_products()
    {
        $this->assertCount(0, Product::all());
        factory(Product::class, 5)->create();
        $response = $this->get(route('products.all'))->assertOk();
        $response->assertJsonCount(5, 'data');
        $response->assertJsonStructure([
            'data' => [[
                'name',
                'price',
                'currency',
                'discount'
            ]]
        ]);
    }
}
