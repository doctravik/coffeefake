@extends('app')
@section('title', 'Register')
@section('content')
    <div class="columns">
        <div class="column is-9-mobile is-offset-1-mobile is-6-tablet is-offset-3-tablet is-4-desktop is-offset-4-desktop">
            @include('auth.partials.menu')
            
            <form action="{{ url('/register') }}" method="POST">
                {{ csrf_field() }}

                    <label class="label">Name</label>
                    <p class="control">
                        <input class="input" type="text" name="name" placeholder="Name" value="{{ old('name') }}" >
                        <span class="help is-danger">{{ $errors->first('name') }}</span>
                    </p>

                    <label class="label">Email</label>
                    <p class="control">
                        <input class="input" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                        <span class="help is-danger">{{ $errors->first('email') }}</span>
                    </p>

                    <label class="label">Password</label>
                    <p class="control">
                        <input class="input" type="password" name="password" placeholder="Password">
                        <span class="help is-danger">{{ $errors->first('password') }}</span>
                    </p>

                    <label class="label">Confirm Password</label>
                    <p class="control">
                        <input class="input" type="password" name="password_confirmation" placeholder="Confirm password">
                        <span class="help is-danger">{{ $errors->first('password_confirmation') }}</span>
                    </p>

                    <p class="control">
                        <button class="button is-success">Register</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection