<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Check if quantity of product is out of stock.
     * 
     * @return boolean
     */
    public function outOfStock()
    {
        return (bool) $this->stock <= 0;
    }

    /**
     * Check if quantity of product is in stock.
     * 
     * @return boolean
     */
    public function inStock()
    {
        return (bool) $this->stock >= 1;
    }

    /**
     * Check if quantity of product has low stock.
     * 
     * @return boolean
     */
    public function hasLowStock()
    {
        return $this->inStock() && $this->stock <= 3;
    }

    /**
     * Product has enough stock.
     *
     * @param $quantity
     * @return boolean
     */
    public function hasStock($quantity)
    {
        return $this->stock >= $quantity;
    }
}
