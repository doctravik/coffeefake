@extends('app')
@section('title', $product->title)
@section('content')
<article class="columns">
    <figure class="column is-narrow">
        <div class="media">
            <p class="image is-256x256 is-narrow">
                <img src="{{ $product->getImageUrl() }}" alt="{{ $product->title }}">
            </p>
        </div>
    </figure>

    <div class="column is-6">
        <p class="title is-3">
            <strong>{{ $product->title }}</strong>
        </p>
        <p class="subtitle is-5">
            @if($product->outOfStock())
                <span class="tag is-danger">Out of stock</span>
            @elseif($product->hasLowStock())
                <span class="tag is-warning">Low stock</span>
            @else
                <span class="tag is-success">In stock</span>
            @endif
        </p>
        <p class="subtitle is-4">
            <b>${{ number_format($product->price / 100, 2) }}</b>
        </p>
        <p>
            @if($cart->hasProduct($product))
                <a href="/cart" class="button is-medium is-primary">Show cart</a>
            @elseif($product->outOfStock())
                <span></span>
            @else
                <form action="{{ route('cart.store', $product->slug) }}" method="post">
                    {{ csrf_field() }}
                    <button class="button is-medium level-right">Add to cart</button>
                </form>
            @endif
        </p><br>
        <p class="content is-medium">{{ $product->description }}</p>
    </div>
</article>
@endsection