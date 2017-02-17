<nav class="panel">
    <p class="panel-heading">Customer</p>
    <div class="panel-block">
        <div class="control">
            <br>
            <div class="control is-horizontal">
                <div class="control-label">
                    <label class="label">Name</label>
                </div>
                <div class="control is-grouped">
                    <p class="control is-expanded">
                        <input class="input" type="text" name="name" placeholder="name" value="{{ old('name') }}">
                        <span class="help is-danger">{{ $errors->first('name') }}</span>
                    </p>
                </div>
            </div>

            <div class="control is-horizontal">
                <div class="control-label">
                    <label class="label">Email</label>
                </div>
                <div class="control is-grouped">
                    <p class="control is-expanded">
                        <input class="input" id="customer_email" type="text" name="email" placeholder="email" value="{{ old('email') }}">
                        <span class="help is-danger">{{ $errors->first('email') }}</span>
                    </p>
                </div>
            </div>
            <br>
        </div>
    </div>
</nav>