<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given order can be viewed by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return bool
     */
    public function show(User $user, Order $order)
    {
        return $order->customer->email === $user->email; 
    }
}
