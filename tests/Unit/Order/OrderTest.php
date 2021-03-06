<?php

namespace Tests\Unit\Order;

use App\Order;
use App\Product;
use App\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_add_one_product_to_order()
    {
        $product = factory(Product::class)->create();
        $product->quantity = 2;
        $order = factory(Order::class)->create();
        
        $order->addProduct($product);

        $this->assertDatabaseHas('order_product', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);
        $this->assertEquals(1, \DB::table('order_product')->count());
    }

    /** @test */
    public function it_can_add_collection_of_products_to_order()
    {
        $productOne = factory(Product::class)->create();
        $productOne->quantity = 1;
        $productTwo = factory(Product::class)->create();
        $productTwo->quantity = 2;
        $products = collect([$productOne, $productTwo]);
        $order = factory(Order::class)->create();
        
        $order->addProduct($products);
        
        $this->assertDatabaseHas('order_product', [
            'order_id' => $order->id,
            'product_id' => $productOne->id,
            'quantity' => 1
        ]); 
        $this->assertDatabaseHas('order_product', [
            'order_id' => $order->id,
            'product_id' => $productTwo->id,
            'quantity' => 2
        ]);
        $this->assertEquals(2, \DB::table('order_product')->count());
    }

    /** @test */
    public function it_can_record_successfull_payment()
    {
        $order = factory(Order::class)->create();

        $order->recordSuccessfulPayment('transaction_id', 2000);

        $this->assertCount(1, $order->payments);
        $this->assertDatabaseHas('payments', [
            'success' => true,
            'order_id' => $order->id,
            'amount' => 2000,
            'transaction_id' => 'transaction_id',
        ]);
    }

    /** @test */
    public function it_can_record_failed_payment()
    {
        $order = factory(Order::class)->create();

        $order->recordFailedPayment(2000);

        $this->assertCount(1, $order->payments);
        $this->assertDatabaseHas('payments', [
            'success' => false,
            'order_id' => $order->id,
            'amount' => 2000,
            'transaction_id' => null
        ]);
    }

    /** @test */
    public function it_can_pay_order()
    {
        $order = factory(Order::class)->create(['paid' => false]);

        $order->pay();

        $this->assertTrue($order->isPaid());
    }

    /** @test */
    public function it_can_find_all_orders_by_given_user()
    {
        $customerOne = factory(Customer::class)->create(['name' => 'John Doe', 'email' => 'johndoe@example.com']);
        $customerTwo = factory(Customer::class)->create(['name' => 'Garry Doe', 'email' => 'johndoe@example.com']);
        $customerTree = factory(Customer::class)->create(['name' => 'Bob Doe', 'email' => 'bobdoe@example.com']);
        $orderOne = factory(Order::class)->create(['customer_id' => $customerOne->id]);
        $orderTwo = factory(Order::class)->create(['customer_id' => $customerTwo->id]);
        $orderTree = factory(Order::class)->create(['customer_id' => $customerTree->id]);

        $orders = Order::byEmail('johndoe@example.com')->get();

        $this->assertTrue($orders->contains('id', $orderOne->id));
        $this->assertTrue($orders->contains('id', $orderTwo->id));
        $this->assertFalse($orders->contains('id', $orderTree->id));
    }
}
