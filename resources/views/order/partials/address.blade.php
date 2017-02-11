<nav class="panel">
    <p class="panel-heading">Address</p>
    <div class="panel-block">
        <div class="control">
            <br>
            <div class="control is-horizontal">
                <div class="control-label">
                    <label class="label">Country</label>
                </div>
                <div class="control is-grouped">
                    <p class="control is-expanded">
                        <input class="input" type="text" name="country" placeholder="country" value="{{ old('country') }}">
                        <span class="help is-danger">{{ $errors->first('country') }}</span>
                    </p>

                    <p class="control is-expanded">
                        <input class="input" type="text" name="city" placeholder="city" value="{{ old('city') }}">
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
                        <input class="input" type="text" name="address1" placeholder="address1" value="{{ old('address1') }}">
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
                        <input class="input" type="text" name="address2" placeholder="address2" value="{{ old('address2') }}">
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
                        <input class="input" type="text" name="postal_code" placeholder="postal code" value="{{ old('postal_code') }}">
                        <span class="help is-danger">{{ $errors->first('postal_code') }}</span>
                    </p>
                </div>
            </div>
            <br>
        </div>
    </div>
</nav>