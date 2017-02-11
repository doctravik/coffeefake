<?php

namespace Tests\Feature\Cart;

use App\Cart;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateProductInCartTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_increase_count_of_product_in_the_cart()
    {
        $cart = resolve(Cart::class);
        $product = factory(Product::class)->create(['stock'=> 5]);
        $cart->addProduct($product);

        $response = $this->patch("/cart/{$product->slug}?action=plus&quantity=1");

        $response->assertStatus(302);
        $this->assertEquals(2, $cart->countProducts());
        $this->assertFalse(session()->has('stockError'));
    }

    /** @test */
    public function it_cannot_increase_count_of_product_in_the_cart_if_it_is_out_of_stock()
    {
        $cart = resolve(Cart::class);
        $product = factory(Product::class)->create(['stock'=> 1]);
        $cart->addProduct($product);

        $response = $this->patch("/cart/{$product->slug}?action=plus&quantity=1");

        $response->assertStatus(302);
        $this->assertEquals(1, $cart->countProducts());
        $this->assertTrue(session()->has('stockError'));
    }

    /** @test */
    public function it_can_decline_count_of_product_in_the_cart()
    {
        $cart = resolve(Cart::class);
        $product = factory(Product::class)->create(['stock'=> 5]);
        $cart->addProduct($product, 3);

        $response = $this->patch("/cart/{$product->slug}?action=minus&quantity=3");

        $response->assertStatus(302);
        $this->assertEquals(2, $cart->countProducts());
        $this->assertFalse(session()->has('stockError'));
    }

    /** @test */
    public function cart_has_no_product_after_update_it_count_to_zero()
    {
        $cart = resolve(Cart::class);
        $product = factory(Product::class)->create(['stock'=> 1]);
        $cart->addProduct($product, 1);

        $response = $this->patch("/cart/{$product->slug}?action=minus&quantity=1");

        $response->assertStatus(302);
        $this->assertEquals(0, $cart->countProducts());
        $this->assertFalse(session()->has('stockError'));
    }
}
