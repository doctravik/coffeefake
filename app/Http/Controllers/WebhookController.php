<?php

namespace App\Http\Controllers;

use Stripe\Event;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle()
    {
        $payload = request()->all();

        // $stripeEvent = Event::retrieve($payload['id']);

        $method = $this->eventToMethod($payload['type']);

        if(method_exists($this, $method)) {
            return $this->$method($payload);
        }
    }

    public function whenChargeSucceeded()
    {
        return 'charge succeed';
        // return response('Webhook Received');
    }

    public function whenChargeFailed()
    {
        return 'charge failed';
        // return response('Webhook Received');
    }

    public function eventToMethod($payload)
    {
        return 'when' . studly_case(str_replace('.', '_', $payload));
    }
}
