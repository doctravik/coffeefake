<?php

namespace Tests\Unit\Order;

use App\Order;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_add_one_product_to_order()
    {
        $product = factory(Product::class)->create();
        $product->quantity = 2;
        $order = factory(Order::class)->create();
        
        $order->addProduct($product);

        $this->assertDatabaseHas('order_product', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);
        $this->assertEquals(1, \DB::table('order_product')->count());
    }

    /** @test */
    public function it_can_add_collection_of_products_to_order()
    {
        $productOne = factory(Product::class)->create();
        $productOne->quantity = 1;
        $productTwo = factory(Product::class)->create();
        $productTwo->quantity = 2;
        $products = collect([$productOne, $productTwo]);
        $order = factory(Order::class)->create();
        
        $order->addProduct($products);
        
        $this->assertDatabaseHas('order_product', [
            'order_id' => $order->id,
            'product_id' => $productOne->id,
            'quantity' => 1
        ]); 
        $this->assertDatabaseHas('order_product', [
            'order_id' => $order->id,
            'product_id' => $productTwo->id,
            'quantity' => 2
        ]);
        $this->assertEquals(2, \DB::table('order_product')->count());
    }
}
