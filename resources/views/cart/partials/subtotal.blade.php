<div class="columns">
    <div class="column"></div>
    <div class="column is-narrow">
        <div class="box notification has-text-centered">
            <p class="title"><strong>Subtotal:&emsp;</strong><b>${{ number_format($cart->subTotal($products)/100, 2) }}</b></p>
            <a href="{{ route('order.create') }}" class="button is-success is-medium">Proceed to checkout</a>
        </div>
    </div>
</div>