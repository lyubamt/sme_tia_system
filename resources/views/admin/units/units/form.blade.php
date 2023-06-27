
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('units.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($unit)->name) }}" minlength="1" maxlength="20" required="true" placeholder="{{ trans('units.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">{{ trans('units.description') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="3" id="description">{{ old('description', optional($unit)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('symbol') ? 'has-error' : '' }}">
    <label for="symbol" class="col-md-2 control-label">Symbol</label>
    <div class="col-md-10">
        <input class="form-control" name="symbol" type="text" id="symbol" value="{{ old('symbol', optional($unit)->symbol) }}" minlength="1" maxlength="20" required="true" placeholder="Enter symbol here...">
        {!! $errors->first('symbol', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
    <label for="user_id" class="col-md-2 control-label">User ID</label>
    <div class="col-md-10">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ (isset(optional($unit)->user_id))?optional($unit)->user_id:auth()->user()->id }}" minlength="1" maxlength="20" required="true" placeholder="{{ trans('units.user_id__placeholder') }}">
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div hidden class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Is Active</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="status_1">
            	<input id="status_1" class="" name="status" type="checkbox" value="1" checked>
                Yes
            </label>
        </div>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('is_deleted') ? 'has-error' : '' }}">
    <label for="is_deleted" class="col-md-2 control-label">{{ trans('units.is_deleted') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_deleted_1">
            	<input id="is_deleted_1" class="" name="is_deleted" type="checkbox" value="1" {{ old('is_deleted', optional($unit)->is_deleted) == '1' ? 'checked' : '' }}>
                {{ trans('units.is_deleted_1') }}
            </label>
        </div>

        {!! $errors->first('is_deleted', '<p class="help-block">:message</p>') !!}
    </div>
</div>
