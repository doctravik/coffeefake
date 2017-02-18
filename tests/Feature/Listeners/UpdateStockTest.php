<?php

namespace Tests\Feature\Listeners;

use App\Cart;
use App\Order;
use App\Product;
use Tests\TestCase;
use App\Listeners\UpdateStock;
use App\Events\OrderWasCreated;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateStockTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function it_can_update_stock()
    {
        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create(['stock' => 10]);
        $cart = resolve(Cart::class);
        $cart->addProduct($product, 2);
        $order->addProduct($cart->getAllProducts());

        $orderWasCreated = new OrderWasCreated($order, $cart);
        $updateStock = new UpdateStock();

        $updateStock->handle($orderWasCreated);

        $this->assertEquals(8, $product->fresh()->stock);
    }
}
