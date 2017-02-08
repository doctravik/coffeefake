<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['country', 'city', 'address1', 'address2', 'postal_code'];
}
