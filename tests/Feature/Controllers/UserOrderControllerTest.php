<?php

namespace Tests\Feature\Controllers;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserOrderControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_show_orders_of_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('orders');
    }

    /** @test */
    public function unauthenticated_user_cannot_see_orders()
    {
        $response = $this->get('dashboard');

        $response->assertRedirect('/login');
    }
}
