<?php

namespace Tests\Unit\Address;

use App\Address;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddressTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_persist_the_address()
    {
        $attributes = [
            'country' => 'USA',
            'city' => 'Washington DC',
            'address1' => 'Smith avenue',
            'address2' => 'apartment 55',
            'postal_code' => '00000'
        ];

        $address = Address::persist($attributes);

        $this->assertDatabaseHas('addresses', $attributes);
    }

    /** @test */
    public function it_doesnt_create_address_if_it_already_exists()
    {
        $attributes = [
            'country' => 'USA',
            'city' => 'Washington DC',
            'address1' => 'Smith avenue',
            'address2' => 'apartment 55',
            'postal_code' => '00000'
        ];
        $address = factory(Address::class)->create($attributes);

        $address = Address::persist($attributes);

        $this->assertDatabaseHas('addresses', $attributes);
        $this->assertCount(1, Address::all());   
    }
}
