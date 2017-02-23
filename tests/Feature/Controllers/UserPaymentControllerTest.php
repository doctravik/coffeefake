<?php

namespace Tests\Feature\Controllers;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserPaymentControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_show_payments_of_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/dashboard/payments');

        $response->assertStatus(200);
        $response->assertViewHas('payments');
    }

    /** @test */
    public function unauthenticated_user_cannot_see_payments()
    {
        $response = $this->get('/dashboard/payments');

        $response->assertRedirect('/login');
    }
}
