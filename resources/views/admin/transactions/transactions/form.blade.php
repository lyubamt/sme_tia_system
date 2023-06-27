<div class="row">

    @if (!$transaction)

    <div class="form-group col-md-6 text-left">

        <h5>Choose business</h5>

        <select class="form-control" name="business_id" id="business_id" required="true" >

            <option value="" style="display: none;" {{ old('business_id', optional($transaction)->business_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select business</option>

            @if (count($businesses) > 0)

                @foreach ($businesses as $business)

                    <option value="{{ $business->id }}" {{ (old('business_id', optional($transaction)->business_id) == $business->id)?'selected':'' }}>
                        
                        {{ $business->name }}

                    </option>

                @endforeach

            @endif

        </select>

    </div>

    <div class="form-group col-md-6 text-left">

        <h5>Choose transaction type</h5>

        <select class="form-control" name="transaction_type_id" id="transaction_type_id" required="true" >

            <option value="" style="display: none;" {{ old('transaction_type_id', optional($transaction)->transaction_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select transaction type</option>

            @if (count($transaction_types) > 0)

                @foreach ($transaction_types as $transaction_type)

                    <option value="{{ $transaction_type->id }}" {{ (old('transaction_type_id', optional($transaction)->transaction_type_id) == $transaction_type->id)?'selected':'' }}>
                        
                        {{ $transaction_type->name }}

                    </option>

                @endforeach

            @endif

        </select>

    </div>

    @endif

    <div class="form-group col-md-6 text-left">

        <h5>Choose entry item</h5>

        <select class="form-control" name="item_id" id="item_id" required="true" >

            <option value="" style="display: none;" {{ old('item_id', optional($transaction)->item_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select entry item</option>

            @if (count($items) > 0)

                @foreach ($items as $item)

                    <option value="{{ $item->id }}" {{ (old('item_id', optional($transaction)->item_id) == $item->id)?'selected':'' }}>
                        
                        {{ $item->name }}

                    </option>

                @endforeach

            @endif

        </select>

    </div>

    <div class="form-group col-md-6 text-left">

        <h5>Choose unit of measurement</h5>

        <select class="form-control" name="unit_id" id="unit_id" required="true" >

            <option value="" style="display: none;" {{ old('unit_id', optional($transaction)->unit_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select unit</option>

            @if (count($units) > 0)

                @foreach ($units as $unit)

                    <option value="{{ $unit->id }}" {{ (old('unit_id', optional($transaction)->unit_id) == $unit->id)?'selected':'' }}>
                        
                        {{ $unit->name }}

                    </option>

                @endforeach

            @endif

        </select>

    </div>

    <div class="form-group col-md-6">

        <h5>Cost per item</h5>
        <input class="form-control" name="value" type="text" id="value" value="{{ old('value', optional($transaction)->value) }}" minlength="1" maxlength="191" required="true" placeholder="Cost per item">

    </div>

    <div class="form-group col-md-6">

        <h5>Total items</h5>
        <input class="form-control" name="quantity" type="text" id="quantity" value="{{ old('quantity', optional($transaction)->quantity) }}" minlength="1" maxlength="191" required="true" placeholder="Total items">

    </div>
    

    <div class="form-group col-md-12">

        <h5>Description</h5>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description">{{ old('name', optional($transaction)->description) }}</textarea>

    </div>

    <div class="form-group col-md-12">

        <h5>Date</h5>
        <input class="form-control" name="date" type="date" id="date" value="{{ (isset(optional($transaction)->date))?optional($transaction)->date:date('Y-m-d') }}" minlength="1" maxlength="191" required="true">

    </div>

    @if (!$transaction)

    <div id="parent_category_1" class="form-group col-md-12 text-left">

        <h5>Choose category</h5>

        <select class="form-control parent_id" id="parent_id" name="parent_id" required="true" >

            <option value="0" {{ (old('parent_id', optional($transaction)->parent_id) == 0)?'selected':'' }}>NONE</option>

        </select>

    </div>

    @endif

</div>
<!-- /. row -->