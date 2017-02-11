<?php

namespace App;

use App\Address;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Create and save address if it doesn't exists in DB.
     * 
     * @param  array $attributes
     * @return Address
     */
    public static function persist($attributes)
    {
        if (! is_null($address = static::where($attributes)->first())) {
            return $address;
        }

        $address = new self();
        
        foreach ($attributes as $key => $value) {
            $address[$key] = $value;
        }

        $address->save();

        return $address;
    }
}
