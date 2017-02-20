@if(session()->has('status'))
    <div class="notification">{{ session('status') }}</div>
@endif