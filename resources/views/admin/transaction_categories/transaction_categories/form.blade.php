<div class="row">

    <div class="form-group col-md-12">

        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($transaction_category)->name) }}" minlength="1" maxlength="191" required="true" placeholder="Category name">

    </div>
    

    <div class="form-group col-md-12">

        <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Category description">{{ old('name', optional($transaction_category)->description) }}</textarea>

    </div>

    <div class="form-group col-md-12 text-left">

        <h5>Choose type</h5>

        <select class="form-control" name="transaction_type_id" id="transaction_type_id" required="true" >

            <option value="" style="display: none;" {{ old('transaction_type_id', optional($transaction_category)->transaction_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select transaction type</option>

            @if (count($transaction_types) > 0)

                @foreach ($transaction_types as $transaction_type)

                    <option value="{{ $transaction_type->id }}" {{ (old('transaction_type_id', optional($transaction_category)->transaction_type_id) == $transaction_type->id)?'selected':'' }}>
                        
                        {{ $transaction_type->name }}

                    </option>

                @endforeach

            @endif

        </select>

    </div>

    <div id="parent_category_1" class="form-group col-md-12 text-left">

        <h5>Choose category</h5>

        <select class="form-control parent_id" id="parent_id" name="parent_id" required="true" >

            <option value="0" {{ (old('parent_id', optional($transaction_category)->parent_id) == 0)?'selected':'' }}>NONE</option>

        </select>

    </div>

</div>
<!-- /. row -->