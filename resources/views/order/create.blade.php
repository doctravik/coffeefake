@extends('app')
@section('title', 'Address')
@section('content')
    <form action="{{ route('order.store') }}" method="POST">
        {{ csrf_field() }}
        
        <div class="columns">
            <div class="column is-8">
                @include('order.partials.customer')
                @include('order.partials.address')
            </div>
            <div class="column is-4">
                @include('order.partials.summary')
                <div class="has-text-centered"><a href="/products">Back to shopping</a></div>
            </div>
        </div>
    </form>
@endsection