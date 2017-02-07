<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Exceptions\ProductIsOutOfStock;

class CartController extends Controller
{
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * View cart.
     * 
     * @return Response
     */
    public function index()
    {
        $products = $this->cart->getAllProducts();

        return view('cart.index', compact('products'));
    }

    /**
     * Add product to the cart.
     * 
     * @param  Product $product
     * @return Response
     */
    public function store(Product $product)
    {
        try {
            $this->cart->addProduct($product);
        } catch(ProductIsOutOfStock $e) {
            return redirect()->back()->with('stockError', [$product->id => $e->getMessage()]);
        }

        return redirect()->back();
    }

    /**
     * Update quantity of product in the cart.
     * 
     * @param  Request $request
     * @param  Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'action' => 'required|in:minus,plus',
            'quantity' => 'required|integer'
        ]);

        if(! request()->exists('action')) {
            return redirect()->back();
        }

        $action = request('action');

        if($action == 'minus') {
            $quantity = request('quantity') - 1;
        } else {
            $quantity = request('quantity') + 1;
        }

        try {
            $this->cart->updateProduct($product, $quantity);
        } catch(ProductIsOutOfStock $e) {
            return redirect()->back()->with('stockError', [$product->id => $e->getMessage()]);
        }

        return redirect()->back();
    }

    /**
     * Remove product from the cart.
     * 
     * @param  Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $this->cart->removeProduct($product);

        return redirect()->route('cart.index');
    }
}
