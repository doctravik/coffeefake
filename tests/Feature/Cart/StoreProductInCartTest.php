<?php

namespace Tests\Feature\Cart;

use App\Cart;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreProductInCartTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function it_can_store_product_in_the_cart()
    {
        $cart = resolve(Cart::class);
        $product = factory(Product::class)->create();

        $response = $this->post("/cart/{$product->slug}");

        $response->assertStatus(302);
        $this->assertTrue($cart->hasProduct($product));
        $this->assertFalse(session()->has('stockError'));
    }

    /** @test */
    public function it_cannot_store_product_in_the_cart_out_of_stock()
    {
        $cart = resolve(Cart::class);
        $product = factory(Product::class)->create(['stock' => 0]);

        $response = $this->post("/cart/{$product->slug}");

        $response->assertStatus(302);
        $this->assertFalse($cart->hasProduct($product));
        $this->assertTrue(session()->has('stockError'));
    }
}
