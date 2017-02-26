<div class="columns is-mobile">
    <div class="column">
        <div class="tabs is-boxed">
            <ul>
                <li class="{{ $route === 'product.index' ? 'is-active' : '' }}">
                    <a href="{{ route('product.index') }}" class="content is-medium is-marginless">Products</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="column">
        <div class="tabs is-boxed is-right">
            <ul>
                <li>
                    <a href="{{ route('cart.index') }}" class="content is-medium is-marginless">
                        <img class="image is-24x24" src="{{ Storage::url('images/shopping-cart.svg') }}"/>
                        <span>&emsp; ({{ $cart->countProducts() }})</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>