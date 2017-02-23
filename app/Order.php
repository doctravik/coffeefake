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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Order belongs to Address.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Order has many Products.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
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

    /**
     * Pay order.
     * 
     * @return void
     */
    public function pay()
    {
        $this->paid = true;

        $this->save();        
    }

    /**
     * Whether order is paid.
     * 
     * @return boolean
     */
    public function isPaid()
    {
        return $this->paid;
    }

    /**
     * Order has many payments.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Record successful payment.
     * 
     * @param  string $id
     * @param  integer $amount
     * @return Model
     */
    public function recordSuccessfulPayment($id, $amount)
    {
        return $this->payments()->create([
            'transaction_id' => $id,
            'amount' => $amount,
            'success' => true
        ]);
    }

    /**
     * Record failed payment.
     *
     * @param  integer $amount
     * @return Model
     */
    public function recordFailedPayment($amount)
    {
        return $this->payments()->create([
            'amount' => $amount,
            'success' => false
        ]);
    }

    public function scopeByEmail($query, $email)
    {
        $customers = Customer::findByEmail($email);

        return $query->whereIn('customer_id', $customers->pluck('id'));
    }
}
