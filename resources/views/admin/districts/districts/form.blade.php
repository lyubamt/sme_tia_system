
<div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
    <label for="region_id" class="col-md-2 control-label">{{ trans('districts.region_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="region_id" name="region_id" required="true">
        	    <option value="" style="display: none;" {{ old('region_id', optional($district)->region_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('districts.region_id__placeholder') }}</option>
        	@foreach ($regions as $key => $region)
			    <option value="{{ $key }}" {{ old('region_id', optional($district)->region_id) == $key ? 'selected' : '' }}>
			    	{{ $region }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('region_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('districts.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($district)->name) }}" minlength="1" maxlength="191" required="true" placeholder="{{ trans('districts.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">{{ trans('districts.description') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="3" id="description">{{ old('description', optional($district)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Is Active</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="status_1">
            	<input id="status_1" class="" name="status" type="checkbox" value="1" {{ old('status', optional($district)->status) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('is_deleted') ? 'has-error' : '' }}">
    <label for="is_deleted" class="col-md-2 control-label">{{ trans('districts.is_deleted') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_deleted_1">
            	<input id="is_deleted_1" class="" name="is_deleted" type="checkbox" value="1" {{ old('is_deleted', optional($district)->is_deleted) == '1' ? 'checked' : '' }}>
                {{ trans('districts.is_deleted_1') }}
            </label>
        </div>

        {!! $errors->first('is_deleted', '<p class="help-block">:message</p>') !!}
    </div>
</div>
