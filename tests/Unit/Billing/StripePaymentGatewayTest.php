<?php

namespace Tests\Unit\Billing;

use Stripe\Charge;
use Tests\TestCase;
use App\Billing\StripePaymentGateway;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StripePaymentGatewayTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->lastCharge = $this->lastCharge();
    }

    private function lastCharge()
    {
        return Charge::all(
            ['limit' => 1], 
            ['api_key' => config('services.stripe.secret')]
        )['data'][0];
    }

    private function newCharges()
    {
        return Charge::all(
            [
                'limit' => 1,
                'ending_before' => $this->lastCharge->id
            ], 
            ['api_key' => config('services.stripe.secret')]
        )['data'];
    }

    private function validToken()
    {
        return \Stripe\Token::create([
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 1,
                'exp_year' => date('Y') + 1,
                'cvc' => '123'
            ]
        ], ['api_key' => config('services.stripe.secret')])->id;
    }

    /** @test */
    public function charges_with_a_valid_payment_token_are_successful()
    {
        $paymentGateway = new StripePaymentGateway(config('services.stripe.secret'));

        $paymentGateway->charge(250, $this->validToken());

        $this->assertCount(1, $this->newCharges());
        $this->assertEquals(250, $this->lastCharge()->amount);
    }
}
