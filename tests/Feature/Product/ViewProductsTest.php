<?php

namespace Tests\Feature\Product;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewProductsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_has_collection_of_products()
    {
        factory(Product::class)->create();

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertViewHas('products');
    }

    /** @test */
    public function home_page_test()
    {
        factory(Product::class)->create();

        $response = $this->get('/home');

        $response->assertStatus(200);
        $response->assertViewHas('products');   
    }

    /** @test */
    public function root_page_test()
    {
        factory(Product::class)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('products');   
    }
}
