<div class="tabs is-centered">
    <ul>
        <li class="{{ $route === 'login' ? 'is-active' : '' }}">
            <a href="{{ url('/login') }}">Login</a>
        </li>
        <li class="{{ $route === 'register' ? 'is-active' : '' }}">
            <a href="{{ url('/register') }}">Register</a>
        </li>
        <li class="{{ $route === 'password.request' ? 'is-active' : '' }}">
            <a href="{{ url('/password/reset') }}">Remind password</a>
        </li>
    </ul>
</div>