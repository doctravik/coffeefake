<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all orders of the user.
     * 
     * @return Response
     */
    public function index()
    {
        $orders = auth()->user()->orders;

        return view('user.order.index', compact('orders'));
    }
}
