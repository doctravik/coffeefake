<div class="columns is-mobile content is-medium">
    <div class="column"><b>Total</b></div>
    <div class="column has-text-right"><b>-</b></div>
    <div class="column has-text-right"><b>{{ $cart->countProducts() }} items</b></div>
    <div class="column has-text-right is-hidden-mobile"><b>${{ number_format($cart->subTotal($products), 2) }}</b></div>
</div><br>

@include('cart.partials.subtotal')

<div class="level">
    <div class="level-left"></div>
    <div class="level-right">
        <div class="level-item">
            <a href="/products">Back to shopping</a>
        </div>
    </div>
</div>
<div class="level">
    <div class="level-left"></div>
    <div class="level-right">
       <div class="level-item">
            <form action="{{ url('/cart/clear') }}" method="POST">
                {{ csrf_field() }}
                <button class="button">Clear cart</button>
            </form>
        </div>
    </div>
</div>