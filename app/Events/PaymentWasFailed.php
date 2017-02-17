<?php

namespace App\Events;

use App\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PaymentWasFailed
{
    use Dispatchable, SerializesModels;

    public $order;

    public $amount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, $amount)
    {
        $this->order = $order;
        $this->amount = $amount;
    }
}
