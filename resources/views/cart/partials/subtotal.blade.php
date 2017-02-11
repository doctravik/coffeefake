{{-- <div class="level">
    <div class="level-left"></div>
    <div class="level-right">
       <div class="level-item">
            <div class="box notification has-text-centered is-mobile">
                <div>
                    <p class="title"><strong>Subtotal:&emsp;</strong><b>${{ $cart->subTotal($products) }}</b></p>
                    <br>
                        <a href="{{ route('order.create') }}" class="button is-success is-medium">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="columns">
    <div class="column"></div>
    <div class="column is-narrow">
        <div class="box notification has-text-centered">
            <p class="title"><strong>Subtotal:&emsp;</strong><b>${{ $cart->subTotal($products) }}</b></p>
            <a href="{{ route('order.create') }}" class="button is-success is-medium">Proceed to checkout</a>
        </div>
    </div>
</div>