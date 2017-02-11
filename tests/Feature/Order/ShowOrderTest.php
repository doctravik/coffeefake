<?php

namespace Tests\Feature\Order;

use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowOrderTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_show_order_details()
    {
        $order = factory(Order::class)->create();

        $response = $this->get("/order/{$order->hash}");

        $response->assertStatus(200);
        $response->assertViewHas('order');
    }
}
