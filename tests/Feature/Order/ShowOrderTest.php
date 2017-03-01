<?php

namespace Tests\Feature\Order;

use App\User;
use App\Order;
use App\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowOrderTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_show_order_details_for_the_owner()
    {
        $user = factory(User::class)->create(['email' => 'owner@example.com']);
        $customer = factory(Customer::class)->create(['email' => 'owner@example.com']);
        $order = factory(Order::class)->create(['customer_id' => $customer->id]);

        $response = $this->actingAs($user)->get("/order/{$order->hash}");

        $response->assertStatus(200);
        $response->assertViewHas('order');
    }

    /** @test */
    public function it_doesnt_show_order_details_for_unauthenticated_user()
    {
        $order = factory(Order::class)->create();

        $response = $this->get("/order/{$order->hash}");

        $response->assertRedirect('/login');
    }

    /** @test */
    public function it_doesnt_show_order_details_if_user_isnt_its_owner()
    {
        $owner = factory(User::class)->create(['email' => 'owner@example.com']);
        $customer = factory(Customer::class)->create(['email' => 'owner@example.com']);
        $nonOwner = factory(User::class)->create(['email' => 'nonowner@example.com']);
        $order = factory(Order::class)->create(['customer_id' => $customer->id]);

        $response = $this->actingAs($nonOwner)->get("/order/{$order->hash}");

        $response->assertStatus(403);
    }
}
