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
                    <div class="column is-narrow has-text-right">${{number_format($product->price, 2) }}</div>
                </div>
            @endforeach
            <hr>
            <div class="columns is-mobile notification is-paddingless">
                <div class="column">
                    <b>Subtotal ({{ $cart->countProducts() }} items)</b>
                </div>
                <div class="column is-narrow has-text-right">
                    <b>${{ number_format($cart->subTotal($products), 2) }}</b>
                </div>
            </div>

            <button class="button is-success is-fullwidth is-medium">Place order</button></td>
        </div>
    </div>
</nav>