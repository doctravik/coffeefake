<?php

namespace Tests\Unit\Product;

use App\Product;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
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

    /** @test */
    public function it_can_return_local_url_for_product_image()
    {
        config(['filesystems.default' => 'local']);
        $product = factory(Product::class)->create(['image' => 'logo.png']);
        
        $url = $product->getImageUrl('images/' . $product->image);

        $this->assertEquals('/storage/images/logo.png', $url);
    }

    /** @test */
    public function it_can_return_public_url_for_product_image()
    {
        config(['filesystems.default' => 'public']);
        $product = factory(Product::class)->create(['image' => 'logo.png']);

        $url = $product->getImageUrl('images/' . $product->image);

        $this->assertEquals(env('APP_URL') . '/storage/images/logo.png', $url);
    }

    /** @test */
    public function it_can_return_s3_url_for_product_image()
    {
        config(['filesystems.default' => 's3']);
        $product = factory(Product::class)->create(['image' => 'logo.png']);
        
        $url = $product->getImageUrl('images/' . $product->image);

        $this->assertEquals(
            sprintf('https://s3.%s.amazonaws.com/%s/images/logo.png', env('AWS_REGION'), env('AWS_BUCKET')),
            $url
        );
    }
}
