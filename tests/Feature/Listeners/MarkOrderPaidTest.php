<?php

namespace Tests\Feature\Listeners;

use App\Cart;
use App\Order;
use App\Product;
use Tests\TestCase;
use App\Events\OrderWasCreated;
use App\Listeners\MarkOrderPaid;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MarkOrderPaidTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function it_can_mark_order_paid()
    {
        $order = factory(Order::class)->create(['paid' => false]);
        $product = factory(Product::class)->create();
        $cart = resolve(Cart::class);
        $orderWasCreated = new OrderWasCreated($order, $cart);
        $markOrderPaid = new MarkOrderPaid();

        $markOrderPaid->handle($orderWasCreated);

        $this->assertTrue($order->isPaid());
    }
}
