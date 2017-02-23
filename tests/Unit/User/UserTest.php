<?php

namespace Tests\Unit\User;

use App\User;
use App\Order;
use App\Payment;
use App\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function it_can_return_all_customers_for_the_user()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);
        $customerOne = factory(Customer::class)->create(['email' => 'johndoe@example.com']);
        $customerTwo = factory(Customer::class)->create(['email' => 'another@example.com']);

        $customers = $user->customers;

        $this->assertTrue($customers->contains('id', $customerOne->id));
        $this->assertFalse($customers->contains('id', $customerTwo->id));
    }

    /** @test */
    public function it_can_return_all_orders_for_the_user()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);
        $customerOne = factory(Customer::class)->create(['email' => 'johndoe@example.com']);
        $customerTwo = factory(Customer::class)->create(['email' => 'another@example.com']);
        $orderOne = factory(Order::class)->create(['customer_id' => $customerOne->id]);
        $orderTwo = factory(Order::class)->create(['customer_id' => $customerTwo->id]);

        $orders = $user->orders;

        $this->assertTrue($orders->contains('id', $orderOne->id));
        $this->assertFalse($orders->contains('id', $orderTwo->id));
    }

    /** @test */
    public function it_can_return_all_payments_of_the_user()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);
        $customerOne = factory(Customer::class)->create(['email' => $user->email]);
        $customerTwo = factory(Customer::class)->create(['email' => 'another@example.com']);
        $orderOne = factory(Order::class)->create(['customer_id' => $customerOne->id]);
        $orderTwo = factory(Order::class)->create(['customer_id' => $customerTwo->id]);
        $paymentOne = factory(Payment::class)->create(['order_id' => $orderOne->id]);
        $paymentTwo = factory(Payment::class)->create(['order_id' => $orderTwo->id]);

        $payments = $user->payments()->get();

        $this->assertTrue($payments->contains('id', $paymentOne->id));
        $this->assertFalse($payments->contains('id', $paymentTwo->id));
    }
}
