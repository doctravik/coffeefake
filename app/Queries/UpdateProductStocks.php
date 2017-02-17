<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Collection;

class UpdateProductStocks
{
    private $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    /**
     * Update product stocks in the database.
     * 
     * @return boolean
     */
    public function update() 
    {
        $query = $this->prepareUpdateStatement();

        $bindings = $this->prepareBindings();

        \DB::statement($query, $bindings);
    }

    /**
     * Prepare raw statement for update multiple products.
     * 
     * @return string
     */
    private function prepareUpdateStatement()
    {
        $placeholders = implode(',', array_fill(1, count($this->products), '?'));

        return "UPDATE products SET stock = ELT(FIELD(id, $placeholders),$placeholders) WHERE id IN ($placeholders)";
    }

    /**
     * Prepare bindings for raw statement.
     * 
     * @return array
     */
    private function prepareBindings() 
    {
        $ids = $this->products->pluck('id')->all();

        $updateStocks = $this->products->map(function($product) {
            return $product->stock -= $product->quantity;
        })->all();

        return array_merge($ids, $updateStocks, $ids);
    }
}