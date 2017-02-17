<?php

namespace Tests\Unit\Product;

use App\Product;
use Tests\TestCase;
use App\Queries\UpdateProductStocks;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateProductStocksTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_update_product_stocks()
    {
        $products = factory(Product::class, 2)->create(['stock' => 10]);
        $products->each(function($product) {
            $product->quantity = 3;
        });

        (new UpdateProductStocks($products))->update();

        $products->each(function($product) {
            $this->assertEquals(7, $product->stock);            
        });
    }
}
