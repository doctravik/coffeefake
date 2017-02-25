<?php

namespace Tests\Feature\Order;

use App\Cart;
use App\Order;
use App\Address;
use App\Product;
use App\Customer;
use Tests\TestCase;
use App\Billing\PaymentGateway;
use App\Billing\FakePaymentGateway;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateOrderTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function it_redirect_if_cart_has_no_products()
    {
        $response = $this->get('/order/create');

        $response->assertStatus(302);
    }

    /** @test */
    public function it_show_order_create_view()
    {
        $product = factory(Product::class)->create();
        $cart = resolve(Cart::class);
        $cart->addProduct($product);

        $response = $this->get('/order/create');

        $response->assertStatus(200);
        $response->assertViewHas(['cart', 'products']);
    }

    /** @test */
    public function it_can_store_order()
    {
        $paymentGateway = new FakePaymentGateway();
        $this->app->instance(PaymentGateway::class, $paymentGateway);
        $product = factory(Product::class)->create(['stock' => 10]);
        $cart = resolve(Cart::class);
        $cart->addProduct($product, 2);
        $subtotal = $cart->subTotal();

        $response = $this->post('/order', [
            'name' => 'John Doe',
            'email' => 'doe@example.com',
            'country' => 'USA',
            'city' => 'Washington DC',
            'address1' => 'Smith avenue',
            'address2' => 'apartment 55',
            'postal_code' => '00000'
        ]);

        $order = Order::first();
        $response->assertStatus(302);
        $response->assertSessionHas('congratulations');

        $this->assertDatabaseHas('customers', [
            'name' => 'John Doe',
            'email' => 'doe@example.com'
        ]);

        $this->assertDatabaseHas('addresses', [
            'country' => 'USA',
            'city' => 'Washington DC',
            'address1' => 'Smith avenue',
            'address2' => 'apartment 55',
            'postal_code' => '00000'
        ]);

        $this->assertDatabaseHas('orders', [
            'paid' => true,
            'subtotal' => $subtotal,
            'customer_id' => Customer::first()->id,
            'address_id' => Address::first()->id
        ]);

        $this->assertDatabaseHas('order_product', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        $this->assertDatabaseHas('payments', [
            'success' => true,
            'order_id' => $order->id,
            'amount' => $subtotal,
            'transaction_id' => 'valid_id'
        ]);

        $this->assertEquals(8, $product->fresh()->stock);

        $this->assertEquals(0, $cart->countProducts());
    }

    /** @test */
    public function it_doesnt_validate_empty_fields_in_order_form()
    {
        $response = $this->post('/order', [
            'name' => '',
            'email' => '',
            'country' => '',
            'city' => '',
            'address1' => '',
            'address2' => '',
            'postal_code' => ''
        ]);

        $response->assertStatus(302);
        $this->assertCount(0, Order::all());
        $this->assertCount(0, Customer::all());
        $this->assertCount(0, Address::all());
        $this->assertEquals(0, \DB::table('order_product')->count());
        $this->assertEquals([
            'name' => [0 => 'The name field is required.'],
            'email' => [0 => 'The email field is required.'],
            'country' => [0 => 'The country field is required.'],
            'city' => [0 => 'The city field is required.'],
            'address1' => [0 => 'The address1 field is required.'],
            'address2' => [0 => 'The address2 field is required.'],
            'postal_code' => [0 => 'The postal code field is required.']
        ], session('errors')->messages());
    }
}
