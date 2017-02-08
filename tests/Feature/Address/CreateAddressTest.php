<?php

namespace Tests\Feature\Address;

use App\Address;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateAddressTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_create_a_view_for_address()
    {
        $response = $this->get('/address/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_store_address()
    {
        $response = $this->post('/address', [
            'country' => 'USA',
            'city' => 'Washington DC',
            'address1' => 'Smith avenue',
            'address2' => 'apartment 55',
            'postal_code' => '00000'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('addresses', [
            'country' => 'USA',
            'city' => 'Washington DC',
            'address1' => 'Smith avenue',
            'address2' => 'apartment 55',
            'postal_code' => '00000'
        ]);
    }

    /** 
     * @test
     * @return [type] [description]
     */
    public function it_doesnt_validate_empty_address_fields()
    {
        $response = $this->post('/address', [
            'country' => '',
            'city' => '',
            'address1' => '',
            'address2' => '',
            'postal_code' => ''
        ]);

        $response->assertStatus(302);
        $this->assertCount(0, Address::all());
        $this->assertEquals([
            'country' => [0 => 'The country field is required.'],
            'city' => [0 => 'The city field is required.'],
            'address1' => [0 => 'The address1 field is required.'],
            'address2' => [0 => 'The address2 field is required.'],
            'postal_code' => [0 => 'The postal code field is required.']
        ], session('errors')->messages());
    }
}
