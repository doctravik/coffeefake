<nav class="nav">
    <div class="container">
        <span class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </span>
        <div class="nav-right nav-menu">
            <span class="nav-item">
                <a href="/cart" class="button is-large">
                    <img class="image is-32x32" src="image/shopping-cart.svg"/>
                    <span class="content is-medium">&emsp; {{ $cart->countProducts() }}</span>
                </a>
            </span>
        </div>
    </div>
</nav>