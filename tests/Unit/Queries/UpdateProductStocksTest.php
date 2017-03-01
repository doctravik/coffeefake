<?php

namespace Tests\Unit\Queries;

use App\Product;
use Tests\TestCase;
use App\Queries\UpdateProductStock;
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

        resolve(UpdateProductStock::class)->setProducts($products)->execute();

        Product::all()->each(function($product) {
            $this->assertEquals(7, $product->stock);
        });
    }
}
