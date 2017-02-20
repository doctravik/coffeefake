<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Http\Controllers\WebhookController;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WebhookControllerTest extends TestCase
{
    /** @test */
    public function it_converts_a_stripe_event_name_to_a_method_name()
    {
        $name = (new WebhookController)->eventToMethod('charge.succeeded');

        $this->assertEquals('whenChargeSucceeded', $name);
    }
}
