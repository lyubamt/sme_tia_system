
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('units.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($item)->name) }}" minlength="1" maxlength="20" required="true" placeholder="{{ trans('units.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">{{ trans('units.description') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="3" id="description">{{ old('description', optional($item)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">

    <div class="col-md-2 form-group {{ $errors->has('is_asset') ? 'has-error' : '' }}">
        <label for="is_asset" class="col-md-12 control-label">Is Asset?</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_asset_1">
                    <input id="is_asset_1" class="" name="is_asset" type="checkbox" value="1" {{ old('is_asset', optional($item)->is_asset) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_asset', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-2 form-group {{ $errors->has('is_liability') ? 'has-error' : '' }}">
        <label for="is_liability" class="col-md-12 control-label">Is Liability?</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_liability_1">
                    <input id="is_liability_1" class="" name="is_liability" type="checkbox" value="1" {{ old('is_liability', optional($item)->is_liability) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_liability', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-2 form-group {{ $errors->has('is_capital') ? 'has-error' : '' }}">
        <label for="is_capital" class="col-md-12 control-label">Is Capital?</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_capital_1">
                    <input id="is_capital_1" class="" name="is_capital" type="checkbox" value="1" {{ old('is_capital', optional($item)->is_capital) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_capital', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-2 form-group {{ $errors->has('is_purchase') ? 'has-error' : '' }}">
        <label for="is_purchase" class="col-md-12 control-label">Is Purchase?</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_purchase_1">
                    <input id="is_purchase_1" class="" name="is_purchase" type="checkbox" value="1" {{ old('is_purchase', optional($item)->is_purchase) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_purchase', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-2 form-group {{ $errors->has('is_sale') ? 'has-error' : '' }}">
        <label for="is_sale" class="col-md-12 control-label">Is Sale?</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_sale_1">
                    <input id="is_sale_1" class="" name="is_sale" type="checkbox" value="1" {{ old('is_sale', optional($item)->is_sale) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_sale', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-2 form-group {{ $errors->has('is_expense') ? 'has-error' : '' }}">
        <label for="is_expense" class="col-md-12 control-label">Is Expense?</label>
        <div class="col-md-10">
            <div class="checkbox">
                <label for="is_expense_1">
                    <input id="is_expense_1" class="" name="is_expense" type="checkbox" value="1" {{ old('is_expense', optional($item)->is_expense) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_expense', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div hidden class="col-md-2 form-group {{ $errors->has('status') ? 'has-error' : '' }}">
        <label for="status" class="col-md-12 control-label">Is Active</label>
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

</div>
<!-- /.row  -->

<div hidden class="form-group {{ $errors->has('is_deleted') ? 'has-error' : '' }}">
    <label for="is_deleted" class="col-md-2 control-label">{{ trans('units.is_deleted') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_deleted_1">
            	<input id="is_deleted_1" class="" name="is_deleted" type="checkbox" value="1" {{ old('is_deleted', optional($item)->is_deleted) == '1' ? 'checked' : '' }}>
                {{ trans('units.is_deleted_1') }}
            </label>
        </div>

        {!! $errors->first('is_deleted', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div hidden class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
    <label for="user_id" class="col-md-2 control-label">User ID</label>
    <div class="col-md-10">
        <input class="form-control" name="user_id" type="text" id="user_id" value="{{ (isset(optional($item)->user_id))?optional($item)->user_id:auth()->user()->id }}" minlength="1" maxlength="20" required="true" placeholder="{{ trans('units.user_id__placeholder') }}">
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>