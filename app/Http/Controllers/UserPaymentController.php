<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    /**
     * Get all payments of the user.
     * 
     * @return Response
     */
    public function index()
    {
        $payments = auth()->user()->payments()->get();

        return view('user.payment.index', compact('payments'));
    }
}
