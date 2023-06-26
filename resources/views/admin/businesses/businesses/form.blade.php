<div class="row">

    <div class="form-group col-md-6">

        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($business)->name) }}" minlength="1" maxlength="191" required="true" placeholder="Business name">

    </div>
    

    <div class="form-group col-md-6">

        <input class="form-control" name="physical_address" type="text" id="physical_address" value="{{ old('physical_address', optional($business)->physical_address) }}" minlength="1" maxlength="191" required="true" placeholder="Physical address">

    </div>

    <div class="form-group col-md-6 first-name-input">

        <input class="form-control" name="email" type="email" id="email" value="{{ old('email', optional($business)->email) }}" minlength="1" maxlength="191" placeholder="Email">

    </div>

    <div class="form-group col-md-6">

        <input class="form-control" name="phone" type="text" id="phone" value="{{ old('phone', optional($business)->phone) }}" minlength="1" maxlength="191" required="true" placeholder="Phone">

    </div>

    <div class="form-group col-md-6">

        <input class="form-control" name="website" type="text" id="website" value="{{ old('website', optional($business)->website) }}" minlength="1" maxlength="191" placeholder="Website">

    </div>

    <div class="form-group col-md-6 text-left">

        <select class="form-control" name="business_type" id="business_type" required="true" >

            @foreach ([1 => 'Non-Formal', 2 => 'Formal'] as $key => $business_type)

                <option value="{{ $key }}" {{ (old('business_type', optional($business)->business_type) == $key)?'selected':'' }}>
                    
                    {{ $business_type }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-md-6 text-left">

        <br>
        <h5>Choose currency</h5>

        <select class="form-control" name="currency" id="currency" required="true" >

            @if (count($currencies) > 0)

                @foreach ($currencies as $currency)

                    <option value="{{ $currency->id }}" {{ (old('currency_id', optional($business)->currency_id) == $currency->id)?'selected':'' }}>
                        
                        {{ $currency->name }}

                    </option>

                @endforeach

            @endif

        </select>

    </div>

    <div class="form-group col-md-6 text-left">

        <br>
        <h5>Choose business category</h5>

        <select class="form-control" name="business_category" id="business_category" required="true" >

            @if (count($business_categories) > 0)

                @foreach ($business_categories as $business_category)

                    <option value="{{ $business_category->id }}" {{ (old('business_category_id', optional($business)->business_category_id) == $business_category->id)?'selected':'' }}>
                        
                        {{ $business_category->name }}

                    </option>

                @endforeach

            @endif

        </select>

    </div>

    <div class="form-group col-md-12 text-left">
        <br>
        <h5>Attach certificate of registration</h5>

    </div>

    <div class="form-group col-md-12">

        <input class="form-control" name="certificate" type="file" id="certificate">

    </div>

    <div class="form-group col-md-12">

        <input hidden class="form-control" name="geo_tag" type="text" id="geo_tag" value="{{ old('geo_tag', optional($business)->name) }}" minlength="1" maxlength="191" placeholder="geo_tag">

    </div>

</div>
<!-- /. row -->