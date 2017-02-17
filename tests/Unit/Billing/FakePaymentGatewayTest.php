<?php

namespace Tests\Unit\Billing;

use Tests\TestCase;
use App\Billing\FakePaymentGateway;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FakePaymentGatewayTest extends TestCase
{    
    /** @test */
    public function charges_with_a_valid_payment_token_are_successful()
    {
        $paymentGateway = new FakePaymentGateway;

        $paymentGateway->charge(250, $paymentGateway->getValidTestToken());

        $this->assertEquals(250, $paymentGateway->totalCharges());
    }

    /** @test */
    public function charge_returns_fake_charge()
    {
        $paymentGateway = new FakePaymentGateway;

        $charge = $paymentGateway->charge(250, $paymentGateway->getValidTestToken());

        $this->assertEquals('valid_id', $charge->id);
        $this->assertEquals(250, $charge->amount);
    }

}
