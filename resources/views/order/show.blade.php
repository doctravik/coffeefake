@extends('app')
@section('title', 'Order')
@section('content')
    <h1 class="title">
        <strong>Order</strong>
        <span class="tag {{ $order->isPaid() ? 'is-success' : 'is-danger' }}">{{ $order->isPaid() ? 'Paid' : 'Not paid' }}</span>
    </h1>
    <h3 class="subtitle">{{ $order->created_at->toFormattedDateString() }}</h3>

    <div class="columns">
        <div class="column">
            <nav class="panel">
                <p class="panel-heading">To</p>
                <div class="panel-block">
                    <div>
                        <p class="control">{{ $order->customer->name }}</p>
                        <p class="control">{{ $order->customer->email }}</p>
                    </div>
                </div>
            </nav>
        </div>

        <div class="column">
            <nav class="panel">
                <p class="panel-heading">Ship To</p>
                <div class="panel-block">
                    <div>
                        <p class="control">
                            <span>{{ $order->address->address1 }}</span>                            
                        </p>
                        <p class="control">
                            <span>{{ $order->address->address2 }}</span>
                        </p>
                        <p class="control">
                            <span>{{ $order->address->postal_code }}</span>
                            <span>{{ $order->address->city }}, </span>
                            <span>{{ $order->address->country }}</span>
                        </p>
                    </div>
                </div>
            </nav>
        </div>
    </div>


<nav class="panel">
    <p class="panel-heading">Products</p>
    <div class="panel-block">
        <table class="table is-marginless">
          <thead>
            <tr>
                <td><b>Name</b></td>
                <td class="has-text-right"><b>Quantity</b></td>
                <td class="has-text-right"><b>Price</b></td>
                <td class="has-text-right"><b>Subtotal</b></td>
            </tr>
          </thead>
          <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td class="has-text-right">x{{ $product->pivot->quantity }}</td>
                        <td class="has-text-right">{{ $product->priceInDollars() }}</td>
                        <td class="has-text-right">${{ number_format($product->price * $product->pivot->quantity / 100, 2) }}</td>
                    </tr>
                @endforeach
          </tbody>
          <tfoot>
            <tr class="notification">
                <td><strong>Total</strong></td>
                <td class="has-text-right"><strong>{{ $order->products->count() }} {{ str_plural('item', $order->products->count()) }}</strong></td>
                <td class="has-text-right">-</td>
                <td class="has-text-right"><strong>${{ number_format($order->subtotal/100, 2) }}</strong></td>
            </tr>
          </tfoot>
        </table>
    </div>
</nav>
@endsection