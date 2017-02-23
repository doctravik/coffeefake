@extends('app')
@section('title', 'Dashboard')
@section('content')
    @include('dashboard.menu')

    <div class="columns">
        <div class="column is-8 is-offset-2">
            @foreach($orders as $order)
                <div class="columns is-mobile">
                    <div class="column has-text-centered">
                        <a href="{{ route('order.show', $order->hash) }}">Order</a>
                    </div>
                    <div class="column has-text-centered">
                        <span>{{ $order->created_at->toFormattedDateString() }}</span>
                    </div>
                    <div class="column has-text-centered">
                        <span>{{ $order->isPaid() ? 'Paid' : 'Not paid' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection