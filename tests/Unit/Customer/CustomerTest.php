<?php

namespace Tests\Unit\Customer;

use App\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_persist_the_address()
    {
        $attributes = [
            'name' => 'John Doe',
            'email' => 'doe@example.com'
        ];

        $customer = Customer::persist($attributes);

        $this->assertDatabaseHas('customers', $attributes);
    }

    /** @test */
    public function it_doesnt_create_customer_if_it_already_exists()
    {
        $attributes = [
            'name' => 'John Doe',
            'email' => 'doe@example.com'
        ];
        $customer = factory(Customer::class)->create($attributes);

        $customer = Customer::persist($attributes);

        $this->assertDatabaseHas('customers', $attributes);
        $this->assertCount(1, Customer::all());   
    }
}
