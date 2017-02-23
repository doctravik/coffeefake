@extends('app')
@section('title', 'Dashboard')
@section('content')
    @include('dashboard.menu')

    <div class="columns">
        <div class="column is-8 is-offset-2">
            @foreach($payments as $payment)
                <div class="columns is-mobile">
                    <div class="column has-text-centered">
                        <span>Payment</span>
                    </div>
                    <div class="column has-text-centered">
                        <span>{{ $payment->created_at->toFormattedDateString() }}</span>
                    </div>
                    <div class="column has-text-centered">
                        <span>${{ number_format($payment->amount / 100, 2) }}</span>
                    </div>
                    <div class="column has-text-centered">
                        <span>{{ $payment->success ? 'success' : 'failed' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection