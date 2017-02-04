<article class="media">
    <figure class="media-left is-hidden-mobile">
        <p class="image is-128x128">
            <img src="{{ $product->image }}" alt="{{ $product->title }}">
        </p>
    </figure>

    <div class="media-content">
        <div class="content is-medium">
            <p class="title is-4">
                <strong>{{ $product->title }}</strong>
                <span>&#8226</span>
                @if($product->outOfStock())
                    <span class="tag is-danger">Out of stock</span>
                @elseif($product->hasLowStock())
                    <span class="tag is-warning">Low stock</span>
                @else
                    <span class="tag is-success">In stock</span>
                @endif
            </p>
            <p>{{ $product->description }}</p>
        </div>
    </div>

    <div class="media-right">
            <div class="level-right">
                <p class="tag is-warning is-large level-item">${{ $product->price }}</p>
            </div><br>
            <div>
                <button class="button is-medium level-right">Add to cart</button>
            </div>
    </div>
</article>