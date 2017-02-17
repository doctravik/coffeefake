<?php

namespace App\Listeners;

use App\Events\PaymentWasFailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordFailedPayment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentWasFailed  $event
     * @return void
     */
    public function handle(PaymentWasFailed $event)
    {
        $event->order->recordFailedPayment($event->amount);
    }
}
