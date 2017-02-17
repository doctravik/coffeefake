<?php

namespace Tests\Feature\Listeners;

use App\Cart;
use App\Order;
use App\Product;
use Tests\TestCase;
use App\Listeners\EmptyCart;
use App\Events\OrderWasCreated;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmptyCartTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_clear_cart()
    {
        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create();
        $cart = resolve(Cart::class);
        $cart->addProduct($product);
        $orderWasCreated = new OrderWasCreated($order, $cart);
        $emptyCart = new EmptyCart();

        $emptyCart->handle($orderWasCreated);

        $this->assertEquals(0, $cart->countProducts());
    }
}
