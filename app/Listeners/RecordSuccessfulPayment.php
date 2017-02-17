<?php

namespace App\Listeners;

use App\Events\PaymentWasSuccessful;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordSuccessfulPayment
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
     * @param  OrderWasCreated  $event
     * @return void
     */
    public function handle(PaymentWasSuccessful $event)
    {
        $event->order->recordSuccessfulPayment($event->transaction_id, $event->amount);
    }
}
