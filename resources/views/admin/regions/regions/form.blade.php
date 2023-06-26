
<div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
    <label for="country_id" class="col-md-2 control-label">{{ trans('regions.country_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="country_id" name="country_id" required="true">
        	    <option value="" style="display: none;" {{ old('country_id', optional($region)->country_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('regions.country_id__placeholder') }}</option>
        	@foreach ($countries as $key => $country)
			    <option value="{{ $key }}" {{ old('country_id', optional($region)->country_id) == $key ? 'selected' : '' }}>
			    	{{ $country }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('regions.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($region)->name) }}" minlength="1" maxlength="191" required="true" placeholder="{{ trans('regions.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">{{ trans('regions.description') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="3" id="description">{{ old('description', optional($region)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Is Active</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="status_1">
            	<input id="status_1" class="" name="status" type="checkbox" value="1" {{ old('status', optional($region)->status) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('is_deleted') ? 'has-error' : '' }}">
    <label for="is_deleted" class="col-md-2 control-label">{{ trans('regions.is_deleted') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_deleted_1">
            	<input id="is_deleted_1" class="" name="is_deleted" type="checkbox" value="1" {{ old('is_deleted', optional($region)->is_deleted) == '1' ? 'checked' : '' }}>
                {{ trans('regions.is_deleted_1') }}
            </label>
        </div>

        {!! $errors->first('is_deleted', '<p class="help-block">:message</p>') !!}
    </div>
</div>
