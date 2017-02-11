<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Address;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\OrderForm;

class OrderController extends Controller
{
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Show order create form.
     * 
     * @return Response
     */
    public function create()
    {
        if($this->cart->countProducts() <= 0) {
            return redirect()->back();
        }

        return view('order.create')->with([
            'cart' => $this->cart,
            'products' => $this->cart->getAllProducts()
        ]);
    }

    /**
     * Store order request.
     * 
     * @param  StoreOrderRequest $request
     * @return Response
     */
    public function store(OrderForm $form)
    {
        $products = $this->cart->getAllProducts();

        $order = $form->save($this->cart->subtotal($products));

        $order->addProduct($products);

        return redirect()->route('order.show', ['hash' => $order->hash]);
    }

    /**
     * Show order.
     * 
     * @param  Order  $order
     * @return Response
     */
    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }
}
