
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('system_settings.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($systemSetting)->name) }}" minlength="1" maxlength="100" required="true" placeholder="{{ trans('system_settings.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
    <label for="value" class="col-md-2 control-label">{{ trans('system_settings.value') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="value" type="text" id="value" value="{{ old('value', optional($systemSetting)->value) }}" minlength="1" maxlength="100" required="true" placeholder="{{ trans('system_settings.value__placeholder') }}">
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('descrption') ? 'has-error' : '' }}">
    <label for="descrption" class="col-md-2 control-label">{{ trans('system_settings.descrption') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="descrption" cols="50" rows="10" id="descrption" placeholder="{{ trans('system_settings.descrption__placeholder') }}">{{ old('descrption', optional($systemSetting)->descrption) }}</textarea>
        {!! $errors->first('descrption', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">{{ trans('system_settings.status') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="status_1">
            	<input id="status_1" class="" name="status" type="checkbox" value="1" {{ old('status', optional($systemSetting)->status) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
    <label for="position" class="col-md-2 control-label">{{ trans('system_settings.position') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="position" type="number" id="position" value="{{ old('position', optional($systemSetting)->position) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('system_settings.position__placeholder') }}">
        {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('is_deleted') ? 'has-error' : '' }}">
    <label for="is_deleted" class="col-md-2 control-label">{{ trans('system_settings.is_deleted') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_deleted_1">
            	<input id="is_deleted_1" class="" name="is_deleted" type="checkbox" value="1" {{ old('is_deleted', optional($systemSetting)->is_deleted) == '1' ? 'checked' : '' }}>
                {{ trans('system_settings.is_deleted_1') }}
            </label>
        </div>

        {!! $errors->first('is_deleted', '<p class="help-block">:message</p>') !!}
    </div>
</div>
