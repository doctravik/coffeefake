<?php

namespace Tests\Feature\Cart;

use App\Cart;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewCartTest extends TestCase
{
    /** @test */
    public function it_can_view_products_in_cart()
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
        $response->assertViewHas('products');
    }
}
