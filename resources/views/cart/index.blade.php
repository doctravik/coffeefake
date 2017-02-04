@extends('app')
@section('title', 'Cart')
@section('content')
    <table class="table content is-medium">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Expresso</td>
                <td>$2.00</td>
                <td>2</td>
                <td>$4.00</td>
            </tr>
            <tr>
                <th><strong>Total</strong></th>
                <th><strong>-</strong></th>
                <th><strong>2</strong></th>
                <th><strong>$4.00</strong></th>
            </tr>
        </tbody>
    </table>
    <br>
    <div class="level">
        <div class="level-left"></div>
        <div class="level-right">
            <p class="level-item">
                <a href="/products" class="button is-link is-medium">Back to shopping</a>
            </p>        
            <p class="level-item">
                <button class="button is-success is-medium">Proceed to checkout</button>
            </p>
        </div>
    </div>

    {{-- @include('cart.partials.item') --}}
@endsection