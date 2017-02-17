<?php

namespace App\Events;

use App\Cart;
use App\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class OrderWasCreated
{
    use Dispatchable, SerializesModels;

    public $order;

    public $cart;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, Cart $cart)
    {
        $this->order = $order;

        $this->cart = $cart;
    }
}
