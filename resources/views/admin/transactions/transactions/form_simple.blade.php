<div class="row">

    @if (!$transaction)

    <div hidden class="form-group col-md-4 text-left">

        <h5>Choose business</h5>

        <input type="text" class="form-control" name="business_id" id="business_id" required="true" value="{{ (Session::has('businessId'))?session('businessId'):'' }}">

    </div>

    <div hidden class="form-group col-md-4 text-left">

        <h5>Choose transaction type</h5>

        <input type="text" class="form-control" name="transaction_type_id" id="transaction_type_id" required="true" value="{{ $transactionTypeid }}">

    </div>

    @endif

    <div hidden class="form-group col-md-4 text-left">

        <h5>Choose entry item</h5>

        <input type="text" class="form-control" name="item_id" id="item_id" required="true" value="{{ $itemId }}">

    </div>

    <div class="form-group col-md-4 text-left">

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

    <div class="form-group col-md-4">

        <h5>Cost per item</h5>
        <input class="form-control" name="value" type="text" id="value" value="{{ old('value', optional($transaction)->value) }}" minlength="1" maxlength="191" required="true" placeholder="Cost per item">

    </div>

    <div class="form-group col-md-4">

        <h5>Total items</h5>
        <input class="form-control" name="quantity" type="text" id="quantity" value="{{ old('quantity', optional($transaction)->quantity) }}" minlength="1" maxlength="191" required="true" placeholder="Total items">

    </div>

    
    <div class="form-group col-md-6">

        <h5>Date</h5>
        <input class="form-control" name="date" type="date" id="date" value="{{ (isset(optional($transaction)->date))?optional($transaction)->date:date('Y-m-d') }}" minlength="1" maxlength="191" required="true">

    </div>

    @if (!$transaction)

    <div id="parent_category_1" class="form-group col-md-6 text-left">

        <h5>Choose category</h5>

        <select class="form-control parent_id" id="parent_id" name="parent_id" required="true" >

            <option value="" style="display: none;" {{ old('parent_id', optional($transaction)->parent_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select category</option>

            @if (count($transaction_categories) > 0)

                @foreach ($transaction_categories as $transaction_category)

                    <option value="{{ $transaction_category->id }}" {{ (old('transaction_category_id', optional($transaction)->transaction_category_id) == $transaction_category->id)?'selected':'' }}>
                        
                        {{ $transaction_category->name }}

                    </option>

                @endforeach

            @else

                <option value="0">None</option>

            @endif

        </select>

    </div>

    @endif
    

    <div class="form-group col-md-12">

        <h5>Description</h5>
        <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Description">{{ old('name', optional($transaction)->description) }}</textarea>

    </div>

</div>
<!-- /. row -->