<?php

namespace Tests\Unit\Product;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductStockTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function product_quantity_is_out_of_stock()
    {
        $product = factory(Product::class)->create(['stock' => 0]);

        $this->assertTrue($product->outOfStock());
    }

    /** @test */
    public function product_quantity_is_in_stock()
    {
        $product = factory(Product::class)->create(['stock' => 1]);

        $this->assertTrue($product->inStock());
    }

    /** @test */
    public function product_quantity_has_low_stock()
    {
        $productOne = factory(Product::class)->create(['stock' => 1]);
        $productTwo = factory(Product::class)->create(['stock' => 2]);
        $productThree = factory(Product::class)->create(['stock' => 3]);
        $productFour = factory(Product::class)->create(['stock' => 4]);

        $this->assertTrue($productOne->hasLowStock());
        $this->assertTrue($productTwo->hasLowStock());
        $this->assertTrue($productThree->hasLowStock());
        $this->assertFalse($productFour->hasLowStock());
    }
}
