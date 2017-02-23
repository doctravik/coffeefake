<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a class="nav-item">
                <b class="content is-medium">CoffeeFun</b>
            </a>
        </div>
        <div class="nav-right nav-menu">
            @if (Auth::guest())
                <a class="nav-item is-tab" href="{{ url('/register') }}">Sign up</a>
                <a class="nav-item is-tab" href="{{ url('/login') }}">Login</a>
            @else
                <a class="nav-item is-tab" href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a>
                <a class="nav-item is-tab" href="{{ url('/logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            @endif
        </div>
    </div>
</nav>