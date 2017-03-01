<?php

namespace App\Queries;

use App\Queries\UpdateProductStock;
use Illuminate\Database\Eloquent\Collection;

class UpdateProductStockPostgres extends UpdateProductStock
{
    /**
     * Prepare bindings for statement.
     * 
     * @return array
     */
    public function prepareBindings()
    {
        return  $this->products->map(function($product) {
            return [
                ($product->stock - $product->quantity),
                $product->id
            ];
        })->flatten()->all();
    }

    /**
     * Prepare statement.
     * 
     * @return string
     */
    public function prepareStatement()
    {
        $placeholders = implode(',', array_fill(1, count($this->products), '(?, ?)'));

        return "update products set stock = cast(map.stock as integer) 
                from (values $placeholders) as map(stock, id) 
                where cast(map.id as integer) = products.id";
    }
}