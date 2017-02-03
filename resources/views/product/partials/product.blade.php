<div class="card is-4">
    <div class="card-image">
        <figure class="image is-4by3">
          <img src="{{ $product->image }}" alt="{{ $product->title }}">
        </figure>
    </div>

    <div class="card-content">
        <div class="content">{{ $product->description }}</div>
    </div>
</div>