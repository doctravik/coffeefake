<?php

namespace App\Queries;

use App\Queries\UpdateProductStock;
use Illuminate\Database\Eloquent\Collection;

class UpdateProductStockMysql extends UpdateProductStock
{
    /**
     * Prepare bindings for statement.
     * 
     * @return array
     */
    public function prepareBindings()
    {
        $ids = $this->products->pluck('id')->all();

        $updateStocks = $this->products->map(function($product) {
            return $product->stock -= $product->quantity;
        })->all();

        return array_merge($ids, $updateStocks, $ids);
    }

    /**
     * Prepare statement.
     * 
     * @return string
     */
    public function prepareStatement()
    {
        $placeholders = implode(',', array_fill(1, count($this->products), '?'));

        return "UPDATE products SET stock = ELT(FIELD(id, $placeholders),$placeholders) WHERE id IN ($placeholders)";
    }
}