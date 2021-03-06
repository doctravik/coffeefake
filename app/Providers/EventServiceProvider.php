<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\OrderWasCreated' => [
            'App\Listeners\MarkOrderPaid',
            'App\Listeners\UpdateStockListener',
            'App\Listeners\EmptyCart',
        ],
        'App\Events\PaymentWasSuccessful' => [
            'App\Listeners\RecordSuccessfulPayment'
        ],
        'App\Events\PaymentWasFailed' => [
            'App\Listeners\RecordFailedPayment'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
