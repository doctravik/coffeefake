@extends('app')
@section('title', 'Address')
@section('content')
    @include('order.partials.menu')
    <br>
    {{ var_dump($errors->all()) }}
    <div class="columns">
        <div class="column is-8 is-offset-2">
            <form action="{{ route('address.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="control is-horizontal">
                    <div class="control-label">
                        <label class="label">Country</label>
                    </div>
                    <div class="control is-grouped">
                        <p class="control is-expanded">
                            <input class="input" type="text" name="country" placeholder="Country">
                            <span class="help is-danger">{{ $errors->first('country') }}</span>
                        </p>

                        <p class="control is-expanded">
                            <input class="input" type="text" name="city" placeholder="City">
                            <span class="help is-danger">{{ $errors->first('city') }}</span>
                        </p>
                    </div>
                </div>

                <div class="control is-horizontal">
                    <div class="control-label">
                        <label class="label">Address1</label>
                    </div>
                    <div class="control is-grouped">
                        <p class="control is-expanded">
                            <input class="input" type="text" name="address1" placeholder="Address1">
                            <span class="help is-danger">{{ $errors->first('address1') }}</span>
                        </p>
                    </div>
                </div>

                <div class="control is-horizontal">
                    <div class="control-label">
                        <label class="label">Address2</label>
                    </div>
                    <div class="control is-grouped">
                        <p class="control is-expanded">
                            <input class="input" type="text" name="address2" placeholder="Address2">
                            <span class="help is-danger">{{ $errors->first('address2') }}</span>
                        </p>
                    </div>
                </div>

                <div class="control is-horizontal">
                    <div class="control-label">
                        <label class="label">Postal code</label>
                    </div>
                    <div class="control is-grouped">
                        <p class="control is-expanded">
                            <input class="input" type="text" name="postal_code" placeholder="Postal code">
                            <span class="help is-danger">{{ $errors->first('postal_code') }}</span>
                        </p>
                    </div>
                </div>
                <div class="level">
                    <div class="level-left"></div>
                    <div class="level-right">
                    <div class="control is-grouped">
                            <p class="control">
                                <a href="/products" class="button">Cancel</a>
                            </p>
                            <p class="control">
                                <button class="button is-primary">Next</button>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection