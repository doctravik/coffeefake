@extends('app')
@section('title', 'Reset Password')
@section('content')

    <div class="columns">
        <div class="column is-9-mobile is-offset-1-mobile is-6-tablet is-offset-3-tablet is-4-desktop is-offset-4-desktop">
            @if (session('status'))
                <div class="notification is-primary">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ url('/password/reset') }}" method="POST">
                {{ csrf_field() }}
                    
                <input type="hidden" name="token" value="{{ $token }}">

                <label class="label">Email</label>
                <p class="control">
                    <input class="input" type="text" name="email" placeholder="Email" value="{{ $email or old('email') }}">
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
                    <button class="button is-success">Reset Password</button>
                </p>
            </form>
        </div>
    </div>
@endsection