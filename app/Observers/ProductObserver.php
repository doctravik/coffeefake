<?php

namespace App\Observers;

use App\Product;

class ProductObserver
{
    public function creating(Product $product)
    {   
        $product->slug = str_slug($product->title);
    }
}