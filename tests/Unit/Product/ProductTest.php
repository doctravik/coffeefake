<?php

namespace Tests\Unit\Product;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_format_product_price()
    {
        $product = factory(Product::class)->create(['price' => 2500]);

        $this->assertEquals('$25.00', $product->priceInDollars());
    }
}
