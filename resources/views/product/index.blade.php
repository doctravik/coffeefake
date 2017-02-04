@extends('app')
@section('title', 'Product list')
@section('content')
    @foreach($products as $product)
        @include('product.partials.item')
    @endforeach
@endsection