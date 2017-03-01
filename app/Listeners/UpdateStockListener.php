<?php

namespace App\Listeners;

use App\Events\OrderWasCreated;
use App\Queries\UpdateProductStock ;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStockListener
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
    public function handle(OrderWasCreated $event)
    {
        resolve(UpdateProductStock::class)
            ->setProducts($event->cart->getAllProducts())
            ->execute();
    }


}
