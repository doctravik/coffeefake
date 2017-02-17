<?php

namespace App\Billing;

use App\Billing\PaymentGateway;

class FakePaymentGateway implements PaymentGateway
{
    private $charges;

    public function __construct()
    {
            
        $this->charges = collect();
    }

    public function getValidTestToken()
    {
        return 'valid_token';
    }

    public function charge($amount, $token)
    {
        $fakeCharge = new FakeCharge($amount);

        $this->charges[] = $fakeCharge;

        return $fakeCharge;
    }

    public function totalCharges()
    {
        return $this->charges->sum('amount');
    }
}