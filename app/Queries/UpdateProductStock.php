<?php

namespace App\Queries;

use App\Queries\RawQuery;
use Illuminate\Database\Eloquent\Collection;

abstract class UpdateProductStock implements RawQuery 
{
    protected $products;

    /**
     * Set products for update.
     * 
     * @param Collection $products
     * @return $this
     */
    public function setProducts(Collection $products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Execute update query.
     * 
     * @return boolean
     */
    public function execute() 
    {
        $query = $this->prepareStatement();

        $bindings = $this->prepareBindings();

        \DB::statement($query, $bindings);
    }
}