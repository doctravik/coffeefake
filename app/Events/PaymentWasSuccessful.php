<?php

namespace App\Events;

use App\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PaymentWasSuccessful
{
    use Dispatchable, SerializesModels;

    public $order;

    public $amount;

    public $transaction_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, $transaction_id, $amount)
    {
        $this->order = $order;
        $this->amount = $amount;
        $this->transaction_id = $transaction_id;
    }
}
