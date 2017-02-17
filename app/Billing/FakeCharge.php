<?php

namespace App\Billing;

class FakeCharge
{
    public $id;

    public $amount;

    public function __construct($amount, $id = 'valid_id')
    {
        $this->id = $id;

        $this->amount = $amount;
    }
}