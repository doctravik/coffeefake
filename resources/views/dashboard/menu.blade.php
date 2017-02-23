<div class="tabs is-centered is-medium">
    <ul>
        <li class="{{ $route === 'dashboard' ? 'is-active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <span>Orders</span>
            </a>
        </li>
        <li class="{{ $route === 'dashboard.payments' ? 'is-active' : '' }}">
            <a href="{{ route('dashboard.payments') }}">
                <span>Payments</span>
            </a>
        </li>
    </ul>
</div>