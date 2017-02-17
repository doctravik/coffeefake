<?php

namespace Tests\Feature\Listeners;

use App\Order;
use Tests\TestCase;
use App\Events\PaymentWasFailed;
use App\Listeners\RecordFailedPayment;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RecordFailedPaymentTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_record_failed_payment()
    {
        $order = factory(Order::class)->create();
        $paymentWasFailed = new PaymentWasFailed($order, 2000);
        $recordFailedPayment = new RecordFailedPayment($paymentWasFailed);

        $recordFailedPayment->handle($paymentWasFailed);

        $this->assertCount(1, $order->payments);
        $this->assertDatabaseHas('payments', [
            'success' => false,
            'amount' => 2000,
            'order_id' => $order->id,
            'transaction_id' => null
        ]);
    }
}
