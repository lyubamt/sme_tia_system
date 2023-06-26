
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">{{ trans('user_login_logs.email') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($userLoginLog)->email) }}" minlength="1" maxlength="100" required="true" placeholder="{{ trans('user_login_logs.email__placeholder') }}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('http_client_ip') ? 'has-error' : '' }}">
    <label for="http_client_ip" class="col-md-2 control-label">{{ trans('user_login_logs.http_client_ip') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="http_client_ip" type="text" id="http_client_ip" value="{{ old('http_client_ip', optional($userLoginLog)->http_client_ip) }}" maxlength="100" placeholder="{{ trans('user_login_logs.http_client_ip__placeholder') }}">
        {!! $errors->first('http_client_ip', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('http_x_forwarded_for') ? 'has-error' : '' }}">
    <label for="http_x_forwarded_for" class="col-md-2 control-label">{{ trans('user_login_logs.http_x_forwarded_for') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="http_x_forwarded_for" type="text" id="http_x_forwarded_for" value="{{ old('http_x_forwarded_for', optional($userLoginLog)->http_x_forwarded_for) }}" maxlength="100" placeholder="{{ trans('user_login_logs.http_x_forwarded_for__placeholder') }}">
        {!! $errors->first('http_x_forwarded_for', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('remote_addr') ? 'has-error' : '' }}">
    <label for="remote_addr" class="col-md-2 control-label">{{ trans('user_login_logs.remote_addr') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="remote_addr" type="text" id="remote_addr" value="{{ old('remote_addr', optional($userLoginLog)->remote_addr) }}" minlength="1" maxlength="100" required="true" placeholder="{{ trans('user_login_logs.remote_addr__placeholder') }}">
        {!! $errors->first('remote_addr', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('server_name') ? 'has-error' : '' }}">
    <label for="server_name" class="col-md-2 control-label">{{ trans('user_login_logs.server_name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="server_name" type="text" id="server_name" value="{{ old('server_name', optional($userLoginLog)->server_name) }}" maxlength="100" placeholder="{{ trans('user_login_logs.server_name__placeholder') }}">
        {!! $errors->first('server_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('direction') ? 'has-error' : '' }}">
    <label for="direction" class="col-md-2 control-label">{{ trans('user_login_logs.direction') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="direction_1">
            	<input id="direction_1" class="" name="direction" type="checkbox" value="1" {{ old('direction', optional($userLoginLog)->direction) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('direction', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
    <label for="comment" class="col-md-2 control-label">{{ trans('user_login_logs.comment') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="comment" cols="50" rows="10" id="comment" placeholder="{{ trans('user_login_logs.comment__placeholder') }}">{{ old('comment', optional($userLoginLog)->comment) }}</textarea>
        {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">{{ trans('user_login_logs.status') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="status_1">
            	<input id="status_1" class="" name="status" type="checkbox" value="1" {{ old('status', optional($userLoginLog)->status) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

