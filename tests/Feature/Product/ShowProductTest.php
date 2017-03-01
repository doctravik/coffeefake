<?php

namespace Tests\Feature\Product;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowProductTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function it_can_show_product_info()
    {
        $product = factory(Product::class)->create();

        $response = $this->get("/products/{$product->slug}");

        $response->assertStatus(200);
        $response->assertViewHas('product');
    }
}
