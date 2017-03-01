<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Address;
use App\Customer;
use Illuminate\Http\Request;
use App\Billing\PaymentGateway;
use App\Events\OrderWasCreated;
use App\Events\PaymentWasFailed;
use App\Http\Requests\OrderForm;
use App\Events\PaymentWasSuccessful;

class OrderController extends Controller
{
    private $cart;
    private $paymentGateway;

    public function __construct(Cart $cart, PaymentGateway $paymentGateway)
    {
        $this->cart = $cart;

        $this->paymentGateway = $paymentGateway;

        $this->middleware('auth')->only('show');
    }

    /**
     * Show order create form.
     * 
     * @return Response
     */
    public function create()
    {
        $this->cart->updateStock();

        if($this->cart->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $products = $this->cart->getAllProducts();

        return view('order.create')->with([
            'cart' => $this->cart,
            'products' => $products,
            'cartSubtotal' => $this->cart->subTotal($products)
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
        $this->cart->updateStock();

        if($this->cart->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $products = $this->cart->getAllProducts();
        $subtotal = $this->cart->subtotal($products);

        $order = $form->save($subtotal);
        $order->addProduct($products);

        try {
            $charge = $this->paymentGateway->charge($subtotal, request('stripeToken'));
        } catch (\Exception $e) {
            event(new PaymentWasFailed($order, $order->subtotal));
            return back()->withErrors(['billing' => $e->getMessage()]);
        }

        event(new OrderWasCreated($order, $this->cart));
        event(new PaymentWasSuccessful($order, $charge->id, $charge->amount));

        if(auth()->check()) {
            return redirect()->route('order.show', ['hash' => $order->hash])
                ->with('congratulations', 'congratulations');
        }
        return redirect()->route('home.index')->with('congratulations', 'congratulations');
    }

    /**
     * Show order.
     * 
     * @param  Order  $order
     * @return Response
     */
    public function show(Order $order)
    {
        $this->authorize('show', $order);

        $order->load(['customer', 'address', 'products']);

        return view('order.show', compact('order'));
    }
}
