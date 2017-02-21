<?php

namespace Tests\Unit\Cart;

use App\Cart;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_define_quantity_of_the_certain_product_in_the_cart()
    {
        $product = factory(Product::class)->create(['stock' => 5]);
        $cart = resolve(Cart::class);

        $cart->addProduct($product, 4);

        $this->assertEquals(4, $cart->getQuantity($product));
    }

    /** @test */
    public function it_can_get_all_products_from_the_cart()
    {
        $productOne = factory(Product::class)->create();
        $productTwo = factory(Product::class)->create();
        $productThree = factory(Product::class)->create();
        $cart = resolve(Cart::class);

        $cart->addProduct($productOne);
        $cart->addProduct($productTwo);

        $products = $cart->getAllProducts();

        $this->assertEquals(2, $cart->countProducts());
        $this->assertTrue(in_array($productOne->id, $products->pluck('id')->all()));
        $this->assertTrue(in_array($productTwo->id, $products->pluck('id')->all()));
        $this->assertFalse(in_array($productThree->id, $products->pluck('id')->all()));
    }

    /** @test */
    public function it_can_add_product_to_cart()
    {
        $productOne = factory(Product::class)->create(['stock' => 1]);
        $productTwo = factory(Product::class)->create(['stock' => 1]);
        $cart = resolve(Cart::class);

        $cart->addProduct($productOne);

        $this->assertTrue($cart->hasProduct($productOne));
        $this->assertFalse($cart->hasProduct($productTwo));
        $this->assertEquals(1, $cart->getQuantity($productOne));
        $this->assertEquals(0, $cart->getQuantity($productTwo));
    }

    /** 
     * @test
     * @expectedException App\Exceptions\ProductIsOutOfStock
     */
    public function it_doesnt_allow_add_product_to_cart_if_it_is_out_of_stock()
    {
        $product = factory(Product::class)->create(['stock' => 1]);
        $cart = resolve(Cart::class);

        $cart->addProduct($product, 2);
    }

    /** @test */
    public function it_can_remove_product_from_cart()
    {
        $product = factory(Product::class)->create(['stock' => 1]);
        $cart = resolve(Cart::class);

        $cart->addProduct($product);
        $cart->removeProduct($product);

        $this->assertFalse($cart->hasProduct($product));
    }

    /** @test */
    public function it_can_remove_all_product_from_cart()
    {
        $productOne = factory(Product::class)->create(['stock' => 1]);
        $productTwo = factory(Product::class)->create(['stock' => 1]);
        $cart = resolve(Cart::class);
        $cart->addProduct($productOne);
        $cart->addProduct($productTwo);

        $cart->clear();

        $this->assertEquals(0, $cart->countProducts());
    }

    /** @test */
    public function it_can_increase_quantity_of_product()
    {
        $product = factory(Product::class)->create(['stock' => 2]);
        $cart = resolve(Cart::class);
        $cart->addProduct($product);

        $cart->updateProduct($product, 2);

        $this->assertEquals(2, $cart->countProducts());
    }

    /** 
     * @test
     * @expectedException App\Exceptions\ProductIsOutOfStock
     */
    public function it_doesnt_update_product_if_it_is_out_of_stock()
    {
        $product = factory(Product::class)->create(['stock' => 2]);
        $cart = resolve(Cart::class);
        $cart->addProduct($product);

        $cart->updateProduct($product, 3);

        $this->assertEquals(1, $cart->countProducts());
    }

    /** @test */
    public function it_can_decline_quantity_of_product()
    {
        $product = factory(Product::class)->create(['stock' => 5]);
        $cart = resolve(Cart::class);
        $cart->addProduct($product, 5);

        $cart->updateProduct($product, 2);

        $this->assertEquals(2, $cart->countProducts());
    }

    /** @test */
    public function it_remove_product_if_it_count_is_zero()
    {
        $product = factory(Product::class)->create(['stock' => 5]);
        $cart = resolve(Cart::class);
        $cart->addProduct($product);

        $cart->updateProduct($product, 0);

        $this->assertEquals(0, $cart->countProducts());
    }

    /** @test */
    public function it_do_nothing_when_remove_product_that_isnt_in_the_cart()
    {
        $product = factory(Product::class)->create(['stock' => 1]);
        $cart = resolve(Cart::class);

        $cart->removeProduct($product);

        $this->assertFalse($cart->hasProduct($product));
    }

    /** @test */
    public function it_can_count_products_in_cart()
    {
        $productOne = factory(Product::class)->create(['stock' => 5]);
        $productTwo = factory(Product::class)->create(['stock' => 5]);
        $cart = resolve(Cart::class);

        $cart->addProduct($productOne, 1);
        $cart->addProduct($productTwo, 2);

        $this->assertEquals(3, $cart->countProducts());
    }

    /** @test */
    public function it_can_define_subtotal_of_cart()
    {
        $productOne = factory(Product::class)->create(['stock' => 5, 'price' => 5]);
        $productTwo = factory(Product::class)->create(['stock' => 5, 'price' => 2]);
        $cart = resolve(Cart::class);

        $cart->addProduct($productOne, 1);
        $cart->addProduct($productTwo, 2);

        $this->assertEquals(9, $cart->subTotal());
    }

    /** @test */
    public function it_can_check_if_cart_is_empty()
    {
        $product = factory(Product::class)->create(['stock' => 5]);
        $cart = resolve(Cart::class);

        $this->assertTrue($cart->isEmpty());

        $cart->addProduct($product);

        $this->assertFalse($cart->isEmpty());
    }

    /** @test */
    public function it_can_syncronizes_cart_quantity_with_stock()
    {
        $product = factory(Product::class)->create(['stock' => 5]);
        $cart = resolve(Cart::class);
        $cart->addProduct($product, 5);
        
        $product->forceFill(['stock' => 3])->save();
        $cart->updateStock();

        $this->assertEquals(3, $cart->getQuantity($product));
    }
}
