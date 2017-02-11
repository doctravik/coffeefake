<?php

namespace Tests\Feature\Cart;

use App\Cart;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RemoveProductFromCartTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function it_can_delete_product_in_cart()
    {
        $cart = resolve(Cart::class);
        $product = factory(Product::class)->create();
        $cart->addProduct($product);

        $response = $this->delete("/cart/{$product->slug}");

        $response->assertRedirect("/cart");
        $this->assertFalse($cart->hasProduct($product));
    }

    /** @test */
    public function it_can_remove_all_products_from_cart()
    {
        $cart = resolve(Cart::class);
        $productOne = factory(Product::class)->create();
        $productTwo = factory(Product::class)->create();

        $cart->addProduct($productOne);
        $cart->addProduct($productTwo);

        $response = $this->post('/cart/clear');

        $response->assertRedirect("/cart");
        $this->assertEquals(0, $cart->countProducts());        
    }
}
