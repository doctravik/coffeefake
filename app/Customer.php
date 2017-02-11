<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Customer has many orders.
     * 
     * @return \Illuminate\Eloquent\Relation\hasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Create and save customer if it doesn't exists in DB.
     * 
     * @param  array $attributes
     * @return Customer
     */
    public static function persist($attributes)
    {
        if (! is_null($customer = static::where($attributes)->first())) {
            return $customer;
        }

        $customer = new self();
        
        foreach ($attributes as $key => $value) {
            $customer[$key] = $value;
        }

        $customer->save();

        return $customer;
    }
}
