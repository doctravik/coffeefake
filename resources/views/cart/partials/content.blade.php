@foreach($products as $product)
    <div class="columns content is-mobile is-gapless">
        <div class="column">
            <p><strong class="content is-medium">{{ $product->title }}</strong></p>
            <form action="{{ route('cart.destroy', $product->slug) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="button is-small">Remove</button>
            </form>
            <p class="help is-danger">
                {{ session()->has('stockError') ? session('stockError.' . $product->id) : '' }}
            </p>
        </div>

        <div class="column has-text-right content is-medium">
            {{ $product->price }}
        </div>

        <div class="column content is-medium">
            <div class="control is-pulled-right is-grouped">
                <form action="{{ '/cart/' . $product->slug . '?action=minus' }}" method="POST" class="control">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="quantity" value="{{ $product->quantity }}">
                    <button class="button is-white">-</button>
                </form>

                <p class="control">
                    {{ $product->quantity }}
                </p>
                
                <form action="{{ '/cart/' . $product->slug . '?action=plus' }}" method="POST" class="control">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="quantity" value="{{ $product->quantity }}">
                    <button class="button is-white">+</button>
                </form>
            </div>
        </div>

        <div class="column has-text-right content is-medium is-hidden-mobile">
            ${{ number_format($product->price * $product->quantity, 2) }}
        </div>
    </div>
@endforeach

@if($cart->countProducts() > 0)
    <hr>
@endif