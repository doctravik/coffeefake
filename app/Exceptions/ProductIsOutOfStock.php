<?php

namespace App\Exceptions;

use Exception;

class ProductIsOutOfStock extends Exception
{
    protected $message = 'You have added the maximum stock for this item.';
}