<?php

namespace Tests\Feature\Listeners;

use App\Order;
use Tests\TestCase;
use App\Events\PaymentWasSuccessful;
use App\Listeners\RecordSuccessfulPayment;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RecordSuccessfulPaymentTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_record_successfull_payment()
    {
        $order = factory(Order::class)->create();
        $paymentWasSuccessful = new PaymentWasSuccessful($order, 'transaction_id', 2000);
        $recordSuccessfulPayment = new RecordSuccessfulPayment($paymentWasSuccessful);

        $recordSuccessfulPayment->handle($paymentWasSuccessful);

        $this->assertCount(1, $order->payments);
        $this->assertDatabaseHas('payments', [
            'success' => true,
            'amount' => 2000,
            'order_id' => $order->id,
            'transaction_id' => 'transaction_id'
        ]);
    }
}
