<nav class="panel">
    <p class="panel-heading"><a href="{{ url('/cart') }}">Shopping-cart</a></p>
    <div class="panel-block notification">
        <div class="control notification">
            @foreach($products as $product)
                <div class="columns is-mobile">
                    <div class="column">
                        <div>
                            <span>{{ $product->title }}</span>
                            <span class="help is-primary">x{{ $product->quantity }}</span>
                        </div>
                    </div>
                    <div class="column is-narrow has-text-right">{{ $product->priceInDollars() }}</div>
                </div>
            @endforeach
            <hr>
            <div class="columns is-mobile notification is-paddingless">
                <div class="column">
                    <b>Subtotal ({{ $cart->countProducts() }} items)</b>
                </div>
                <div class="column is-narrow has-text-right">
                    <b>${{ number_format($cartSubtotal/100, 2) }}</b>
                </div>
            </div>

            <button type="sumbit" class="button is-success is-fullwidth is-medium" id="payOrder">Pay order</button>
        </div>
    </div>
</nav>