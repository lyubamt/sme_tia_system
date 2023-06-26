
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('basins.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($basin)->name) }}" minlength="1" maxlength="191" required="true" placeholder="{{ trans('basins.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">{{ trans('basins.description') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="3" id="description">{{ old('description', optional($basin)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('hydro_DTB') ? 'has-error' : '' }}">
    <label for="hydro_DTB" class="col-md-2 control-label">{{ trans('basins.hydro_DTB') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="hydro_DTB" type="number" id="hydro_DTB" value="{{ old('hydro_DTB', optional($basin)->hydro_DTB) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('basins.hydro_DTB__placeholder') }}">
        {!! $errors->first('hydro_DTB', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('CHP_ID') ? 'has-error' : '' }}">
    <label for="CHP_ID" class="col-md-2 control-label">{{ trans('basins.CHP_ID') }}</label>
    <div class="col-md-10">

        <input class="form-control" name="CHP_ID" type="text" id="CHP_ID" value="{{ old('CHP_ID', optional($basin)->CHP_ID) }}" minlength="1" maxlength="191" required="true" placeholder="Enter CHP ID here...">
        {!! $errors->first('CHP_ID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('basin_area') ? 'has-error' : '' }}">
    <label for="basin_area" class="col-md-2 control-label">{{ trans('basins.basin_area') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="basin_area" type="text" id="basin_area" value="{{ old('basin_area', optional($basin)->basin_area) }}" minlength="1" maxlength="5" required="true" placeholder="{{ trans('basins.basin_area__placeholder') }}">
        {!! $errors->first('basin_area', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('basin_area_percentage') ? 'has-error' : '' }}">
    <label for="basin_area_percentage" class="col-md-6 control-label">{{ trans('basins.basin_area_percentage') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="basin_area_percentage" type="text" id="basin_area_percentage" value="{{ old('basin_area_percentage', optional($basin)->basin_area_percentage) }}" min="0" max="5" placeholder="{{ trans('basins.basin_area_percentage__placeholder') }}">
        {!! $errors->first('basin_area_percentage', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('river_id') ? 'has-error' : '' }}">
    <label for="river_id" class="col-md-2 control-label">{{ trans('basins.river_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="river_id" name="river_id" required="true">
        	    <option value="" style="display: none;" {{ old('river_id', optional($basin)->river_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('basins.river_id__placeholder') }}</option>
        	@foreach ($rivers as $key => $river)
			    <option value="{{ $key }}" {{ old('river_id', optional($basin)->river_id) == $key ? 'selected' : '' }}>
			    	{{ $river }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('river_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Is Active</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="status_1">
            	<input id="status_1" class="" name="status" type="checkbox" value="1" {{ old('status', optional($basin)->status) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('is_deleted') ? 'has-error' : '' }}">
    <label for="is_deleted" class="col-md-2 control-label">{{ trans('basins.is_deleted') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_deleted_1">
            	<input id="is_deleted_1" class="" name="is_deleted" type="checkbox" value="1" {{ old('is_deleted', optional($basin)->is_deleted) == '1' ? 'checked' : '' }}>
                {{ trans('basins.is_deleted_1') }}
            </label>
        </div>

        {!! $errors->first('is_deleted', '<p class="help-block">:message</p>') !!}
    </div>
</div>
