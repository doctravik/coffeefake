<?php

namespace App\Billing;

use Stripe\Charge;
use App\Billing\PaymentGateway;

class StripePaymentGateway implements PaymentGateway
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    
    public function charge($amount, $token)
    {
        return Charge::create([
            'amount' => $amount,
            'source' => $token,
            'currency' => 'usd',
        ], ['api_key' => $this->apiKey]);
    }
}