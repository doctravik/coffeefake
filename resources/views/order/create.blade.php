@extends('app')
@section('title', 'Address')
@section('content')

    <form action="{{ route('order.store') }}" method="POST" id="order-form">
        {{ csrf_field() }}
        
        <div class="columns">
            <div class="column is-8">
            
                @if($errors->has('billing'))
                    <div class="notification is-danger">
                        {{ $errors->first('billing') }}
                    </div>
                @endif

                @include('order.partials.customer')
                @include('order.partials.address')
            </div>
            <div class="column is-4">
                @include('order.partials.summary')
                <div class="has-text-centered"><a href="/products">Back to shopping</a></div>
            </div>
        </div>
        <input type="hidden" name="stripeEmail" id="stripeEmail">
        <input type="hidden" name="stripeToken" id="stripeToken">
    </form>

    <script src="https://checkout.stripe.com/checkout.js"></script>

    <script>
        var stripe = StripeCheckout.configure({
            key: "{{ config('services.stripe.key') }}",
            image: "https://stripe.com/img/documentation/checkout/marketplace.png",
            locale: "auto",
            email: document.getElementById('customer_email').value,
            token: function(token) {
                document.getElementById('stripeEmail').value = token.email;
                document.getElementById('stripeToken').value = token.id;

                document.getElementById('order-form').submit();
            }
        });

        document.getElementById('payOrder').addEventListener('click', function(e) {
            stripe.open({
                name: 'CoffeeFun',
                description: 'Pay for your coffee',
                email: document.getElementById('customer_email').value,
                zipCode: true,
                amount: {{ $cartSubtotal }}
            });
            
          e.preventDefault();
        });
    </script>
@endsection