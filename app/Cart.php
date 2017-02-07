<?php

namespace App;

use App\Product;
use App\Exceptions\ProductIsOutOfStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Cart extends Model
{
    public function __construct()
    {
        $this->name = 'cart';

        if(! session()->exists($this->name)) { 
            session([$this->name => []]);
        }
    }

    /**
     * Get product from the cart.
     * 
     * @param  Product $product
     * @return array
     */
    public function getProduct(Product $product)
    {
        return session($this->key($product->id));
    }

    /**
     * Get name of the cart bucket.
     * 
     * @param  integer $productId
     * @return string
     */
    protected function key($productId) {
        return "{$this->name}.$productId";
    }

    /**
     * Whether cart has the product.
     *  
     * @param  Product $product
     * @return boolean
     */
    public function hasProduct(Product $product)
    {
        if(! session()->has($this->name)) {
            return false;
        }

        return array_has(session($this->name), $product->id);
    }

    /**
     * Add product to the cart.
     * 
     * @param Product $product
     * @param void
     */
    public function addProduct(Product $product, $quantity = 1)
    {
        if($this->hasProduct($product)) {
            $quantity = $this->getQuantity($product) + $quantity; 
        }

        $this->updateProduct($product, $quantity);
    }

    /**
     * Update product quantity in the cart.
     * 
     * @param  Product $product
     * @param  integer  $quantity
     * @return void
     */
    public function updateProduct(Product $product, $quantity)
    {
        if(! $product->hasStock($quantity)) {
            throw new ProductIsOutOfStock;
        }

        if ($quantity == 0) {
            $this->removeProduct($product);
            return;
        }

        session()->put($this->key($product->id), [
            'product_id' => $product->id,
            'quantity' => $quantity
        ]);
    }

    /**
     * Remove product from the cart.
     * 
     * @param  Product $product
     * @return void
     */
    public function removeProduct(Product $product)
    {
        if($this->hasProduct($product)) {
            session()->forget($this->key($product->id));
        }
    }

    /**
     * Get quantity of the product in the cart.
     * 
     * @param  Product $product
     * @return integer
     */
    public function getQuantity(Product $product)
    {
        return $this->getProduct($product)['quantity'];        
    }

    /**
     * Get product collection from the cart.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        if(! is_array(session($this->name))) {
            return [];
        }
        
        $ids = array_keys(session($this->name));

        $products = Product::whereIn('id', $ids)->get();

        $products = $products->map(function($product) {
            $product['quantity'] = $this->getQuantity($product);
            return $product;
        });

        return $products;
    }

    /**
     * Count the product in the cart.
     * 
     * @return integer
     */
    public function countProducts() {
        return array_reduce(session($this->name), function($sum, $product) {
            return $sum + $product['quantity'];
        }, 0);
    }

    /**
     * Get cart value
     * 
     * @param mixed $products
     * @return float
     */
    public function subTotal($products = null)
    {
        $items = $products ?? $this->getAllProducts();

        if(! $items instanceof Collection) {
            return;
        }

        return $items->reduce(function($sum, $product) {
            return $sum + $product->price * $product->quantity;
        }, 0);
    }
}
