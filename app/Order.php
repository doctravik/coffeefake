<?php

namespace App;

use App\Address;
use App\Product;
use App\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

class Order extends Model
{
    protected $fillable = ['hash', 'subtotal', 'customer_id', 'address_id'];

    /**
     * Order belongs to Customer.
     * 
     * @return \Illuminate\Eloquent\Relation\belongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Order belongs to Address.
     * 
     * @return \Illuminate\Eloquent\Relation\belongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Order has many Products.
     * 
     * @return \Illuminate\Eloquent\Relation\belongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Add product to the order.
     * 
     * @param Model|Collection
     * @return void
     */
    public function addProduct($product)
    {
        if($product instanceof Model) {
            return $this->products()->attach($product, ['quantity' => $product->quantity]);
        }

        if($product instanceof Collection || $product instanceof BaseCollection) {
            $products = $this->parseProducts($product);

            return $this->products()->attach($products);
        }
    }

    /**
     * Parse products and get id with quantities.
     * 
     * @param  Collection $products
     * @return array
     */
    protected function parseProducts($products)
    {
        return $products->reduce(function($carry, $product) {
            $carry[$product->id] = ['quantity' => $product->quantity];
            return $carry;
        }, []);
    }
}
