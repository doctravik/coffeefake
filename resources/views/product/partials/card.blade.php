{{-- <div class="card">
    <div class="card-image">
        <figure class="image is-4by3">
          <img src="{{ $product->image }}" alt="{{ $product->title }}">
        </figure>
    </div>

    <div class="card-content">
        <div class="content">{{ $product->description }}</div>
    </div>
</div> --}}
<article class="media">
    <figure class="media-left is-hidden-mobile">
        <p class="image is-128x128">
            <img src="{{ $product->image }}" alt="{{ $product->title }}">
        </p>
    </figure>

    <div class="media-content">
        <div class="content is-medium">
            <p class="title is-4"><strong>{{ $product->title }}</strong></p>
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

{{-- <article class="columns">
    <figure class="column">
        <p class="image is-64x64">
            <img src="{{ $product->image }}" alt="{{ $product->title }}">
        </p>
    </figure>

    <div class="column is-11">
        <div class="columns level">
            <div class="column is-9">
                <div class="content">
                    <p class="title is-4"><strong>{{ $product->title }}</strong></p>
                    <p>{{ $product->description }}</p>
                </div>
            </div>

            <div class="column is-3">
                <div class="columns">
                    <div class="column">
                        <p class="tag is-warning is-large">${{ $product->price }}</p>
                    </div>

                    <div class="column">
                        <button class="button is-success">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article> --}}