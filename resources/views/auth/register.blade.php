@extends('layouts.master_register')

@section("css")

<style>
    .page-section{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .multi-step-form-options-card-title{
        font-family: 'Playfair Display', serif;
    }
    .multi-step-form-options-card{
        width: 800px;
        margin-top: 9%;
        padding: 60px 80px 50px 80px;
        border: 1px solid #d5e0d5;
        border-radius: 25px;
        background: #fff;
    }

    @media screen and (max-width: 992px) {
        .multi-step-form-options-card{
            width: auto;
            padding: 10px 20px 20px 20px;
        }

    }
    .multi-step-form-selection-card{
        padding: 10px 10px;
        border: 1px solid #d5e0d5;
        border-radius: 7px;
    }

    @media screen and (max-width: 992px) {
        .multi-step-form-selection-card{
            margin-top: 10px;
        }

    }

    .multi-step-form-selection-card:hover{
        border: 1px solid #14a800;
        cursor: pointer;
    }

    .multi-step-form-selection-card.active{
        border: 2px solid #14a800;
        cursor: pointer;
    }

    .multi-step-form-selection-card-item-icon{
        padding: 18px 18px;
        color: #818285;
    }

    .multi-step-form-selection-card.active > .row > .col-1 > .multi-step-form-selection-card-circle-icon{
        color: #14a800;
    }

    .multi-step-form-selection-card-circle-icon{
        margin-left: auto;
        color: #9aaa97;
        font-size: 22px;
    }

    .multi-step-form-selection-text-holder{
        padding: 0px 18px;
    }
    .multi-step-form-options-card-submit-button-holder{
        padding: 35px 10px;
    }

    .multi-step-form-options-card-submit-button.disabled{
        width: 53%;
        background-color: #e4ebe4;
        font-size: 18px;
        font-weight: 400;
        padding: 5px;
        border: 1px solid #e4ebe4;
        border-radius: 30px;
    }

    .multi-step-form-options-card-submit-button.disabled:hover{
        cursor: not-allowed;
    }

    .continue-with-apple-button{
        width: 100%;
        background-color: #fff;
        padding: 10px 7px 7px 7px;
        border-radius: 30px;
    }

    .continue-with-google-button{
        width: 100%;
        background-color: #3367d6;
        color: #fff;
        margin-top: 10px;
        padding: 10px 7px 7px 7px;
        border: 1px solid #3367d6;
        border-radius: 30px;
    }

    .continue-with-google-button-icon{
        width: 23px;
        heigh: 23px;
        border-radius: 8px;
    }

    .form-control{
        height: 45px;
        border-radius: 8px;
        margin-top: 10px;
    }

    @media screen and (min-width: 993px) {

        .first-name-input{
            padding-right: 5px;
        }
        .middle-name-input{
            padding-right: 5px;
            padding-left: 5px;
        }
        .last-name-input{
            padding-left: 5px;
        }

    }

    .multi-step-form-options-card-create-account-button-holder{
        padding: 20px 10px;
    }

    .multi-step-form-options-card-create-account-button{
        width: 100%;
        height: 45px;
        background-color: #14a600;
        color: #fff;
        font-size: 18px;
        font-weight: 400;
        padding: 5px;
        border: 1px solid #14a600;
        border-radius: 30px;
    }

    .multi-step-form-options-card-create-account-button:hover{
        cursor: pointer;
    }

    .step-2, .step-3{
        display: none;
    }

</style>

@endsection

@section('content')

@php

	$app_url = \Config::get('env.APP_URL');

@endphp

<div class="page-section">

    <div class=""></div>

    <div class="">

        <div class="step-1">

            <div class="multi-step-form-options-card">

                <h2 class="multi-step-form-options-card-title">Join as a start-up or registered business owner</h2><br><br>

                <div class="row margin-0 padding-0">

                    <div class="col-md-6">

                        <div class="multi-step-form-selection-card margin-0 text-left" id="m-1">

                            <div class="row margin-0 padding-0">

                                <div class="col-11 margin-0 padding-0">

                                    <i class="fas fa-business-time fa-2x multi-step-form-selection-card-item-icon"></i>

                                </div>

                                <div class="col-1 margin-0 padding-0 text-right">

                                    <i class="far fa-circle fa-2x multi-step-form-selection-card-circle-icon"></i>

                                </div>

                                <div class="col-md-12 margin-0 padding-0 multi-step-form-selection-text-holder">

                                    <h4>My business is not registered</h4>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="multi-step-form-selection-card margin-0 text-left" id="m-2">

                            <div class="row margin-0 padding-0">

                                <div class="col-11 margin-0 padding-0">

                                    <i class="fas fa-building fa-2x multi-step-form-selection-card-item-icon"></i>

                                </div>

                                <div class="col-1 margin-0 padding-0 text-right">

                                    <i class="far fa-circle fa-2x multi-step-form-selection-card-circle-icon"></i>

                                </div>

                                <div class="col-md-12 margin-0 padding-0 multi-step-form-selection-text-holder">

                                    <h4>I have a registered business</h4>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.row  -->

                <div class="multi-step-form-options-card-submit-button-holder">

                    <button type="submit" disabled type="submit"  class="multi-step-form-options-card-submit-button disabled" id="business-class-option-button">Create Account</button>
                    
                </div>

            </div>
            <!-- /.multi-step-form-options-card  -->

        </div>
        <!-- /. form-step-1  -->

        <div class="step-2">

            <div class="multi-step-form-options-card">

                <h2 class="multi-step-form-options-card-title">Sign up & make your business work easier</h2><br><br>

                <div class="row margin-0 padding-0">

                    <div class="col-md-12">

                        <button class="continue-with-apple-button text-center">

                            <h5><i class="fab fa-apple"></i> Continue with Apple<h5>

                        </button>
                        
                    </div>

                    <div class="col-md-12">

                        <button class="continue-with-google-button text-center">

                            <!-- <h5><img src="{{ asset($app_url . '/img/google.png') }}" class="continue-with-google-button-icon"> Continue with Google<h5> -->
                            <h5><i class="fab fa-google"></i> Continue with Google<h5>

                        </button>
                        
                    </div>

                    <div class="col-md-12">
                        <br>
                        <hr>

                    </div>

                    <div class="col-md-4 margin-0 first-name-input">

                        <input class="form-control" name="first_name" type="text" id="first_name" value="{{ old('first_name') }}" minlength="1" maxlength="191" required="true" placeholder="First name">

                    </div>

                    <div class="col-md-4 margin-0 middle-name-input">

                        <input class="form-control" name="middle_name" type="text" id="middle_name" value="{{ old('middle_name') }}" minlength="1" maxlength="191" required="true" placeholder="Middle name">

                    </div>

                    <div class="col-md-4 margin-0 last-name-input">

                        <input class="form-control" name="last_name" type="text" id="last_name" value="{{ old('last_name') }}" minlength="1" maxlength="191" required="true" placeholder="Last name">

                    </div>

                    <div class="col-md-12 margin-0 text-left">

                        <select class="form-control" name="gender" id="gender">

                        <option value="" style="display: none;" disabled selected>Choose gender</option>

                            @foreach (['Male' => 'Male', 'Female' => 'Female'] as $key => $gender)

                                <option value="{{ $key }}">{{ $gender }}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="email" type="email" id="email" value="{{ old('email') }}" minlength="1" maxlength="191" required="true" placeholder="Email">

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="phone" type="text" id="phone" value="{{ old('phone') }}" minlength="1" maxlength="191" required="true" placeholder="Phone">

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="national_id" type="text" id="national_id" value="{{ old('national_id') }}" minlength="1" maxlength="191" placeholder="National ID">

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="password" type="password" id="password" value="{{ old('password') }}" minlength="1" maxlength="191" required="true" placeholder="Password (8 or more characters)">

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="confirm_password" type="password" id="confirm_password" value="{{ old('confirm_password') }}" minlength="1" maxlength="191" required="true" placeholder="Confirm Password">

                    </div>

                    <div class="col-md-12 margin-0 text-left">

                        <br><br>
                        <label class="checkbox-inline">
                            <h6><input type="checkbox" class="medium-size-radio-btn agree-terms" value="">&nbsp;&nbsp;Yes, I understand and agree to the <a href="{{ route('terms_and_conditions') }}">Terms of Service</a></h6>
                        </label>

                    </div>

                </div>
                <!-- /. row -->

                <div class="multi-step-form-options-card-create-account-button-holder">

                    <button type="submit" type="submit"  class="multi-step-form-options-card-create-account-button" id="create-user-account-button" style="display: none;">Create my account</button>
                    
                </div>

            </div>
            <!-- /.multi-step-form-options-card  -->

        </div>
        <!-- /. form-step-2  -->

        <div class="step-3">

            <!-- <h4 class="welcome-word">Welcome, <b id="user-name"></b></h4> -->

            <div class="multi-step-form-options-card">

                <h2 class="multi-step-form-options-card-title">Complete business information</h2><br><br>
                <form method="POST" action="{{ route('create_external_business') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}

                <div class="row margin-0 padding-0">

                    <div hidden class="col-md-12 margin-0">

                        <input class="form-control" name="business_type" type="text" id="business_type" value="{{ old('business_type') }}" minlength="1" maxlength="191" required="true" placeholder="Business Type">

                    </div>

                    <div hidden class="col-md-12 margin-0">

                        <input class="form-control" name="auth_id" type="text" id="auth_id" value="{{ old('auth_id') }}" minlength="1" maxlength="191" required="true" placeholder="Auth ID">

                    </div>

                    <div hidden class="col-md-12 margin-0">

                        <input class="form-control" name="redirect_route" type="text" id="redirect_route" value="{{ old('redirect_route') }}" minlength="1" maxlength="191" placeholder="Redirect URL">

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="business_name" type="text" id="business_name" value="{{ old('business_name') }}" minlength="1" maxlength="191" required="true" placeholder="Business name">

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="physical_address" type="text" id="physical_address" value="{{ old('physical_address') }}" minlength="1" maxlength="191" required="true" placeholder="Physical address">

                    </div>

                    <div class="col-md-6 margin-0 first-name-input">

                        <input class="form-control" name="b_email" type="email" id="b_email" value="{{ old('b_email') }}" minlength="1" maxlength="191" placeholder="Email">

                    </div>

                    <div class="col-md-6 margin-0 last-name-input">

                        <input class="form-control" name="b_phone" type="text" id="b_phone" value="{{ old('b_phone') }}" minlength="1" maxlength="191" required="true" placeholder="Phone">

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="website" type="text" id="website" value="{{ old('website') }}" minlength="1" maxlength="191" placeholder="Website">

                    </div>

                    <div class="col-md-6 margin-0 text-left">

                        <br>
                        <h5>Choose currency</h5>

                        <select class="form-control" name="currency" id="currency" required="true" >

                            @if (count($currencies) > 0)

                                @foreach ($currencies as $currency)

                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>

                                @endforeach

                            @endif

                        </select>

                    </div>

                    <div class="col-md-6 margin-0 text-left">

                        <br>
                        <h5>Choose business category</h5>

                        <select class="form-control" name="business_category" id="business_category" required="true" >

                            @if (count($business_categories) > 0)

                                @foreach ($business_categories as $business_category)

                                    <option value="{{ $business_category->id }}">{{ $business_category->name }}</option>

                                @endforeach

                            @endif

                        </select>

                    </div>

                    <div class="col-md-12 margin-0 text-left">
                        <br>
                        <h5>Attach certificate of registration</h5>

                    </div>

                    <div class="col-md-12 margin-0">

                        <input class="form-control" name="certificate" type="file" id="certificate">

                    </div>

                    <div class="col-md-12 margin-0">

                        <input hidden class="form-control" name="geo_tag" type="text" id="geo_tag" value="{{ old('geo_tag') }}" minlength="1" maxlength="191" placeholder="geo_tag">

                    </div>

                </div>
                <!-- /. row -->

                <div class="multi-step-form-options-card-create-account-button-holder">

                    <button type="submit" type="submit"  class="multi-step-form-options-card-create-account-button" id="create-business-button">Create my business account</button>
                    
                </div>

                </form>

            </div>
            <!-- /.multi-step-form-options-card  -->

        </div>
        <!-- /. form-step-3  -->

        <div>
            <br>
            <h5>Already have an account?<a href="{{ route('login') }}" class="text-decoration-none">Log In</a></h5>
         
        </div>

    </div>

    <div class=""></div>

</div>

@endsection


@section("js")
<script>
    $(document).ready(function () {

        $(document).on("click",".multi-step-form-selection-card",function () {

            let __this = $(this);

            let rowChild = __this.children('div.row').eq(0);
            let col1Child = rowChild.children('div.col-1').eq(0);
            var circleChild = col1Child.children('i.multi-step-form-selection-card-circle-icon').eq(0);
            let circleChildClassAttr = circleChild.attr("class");

            if (circleChildClassAttr.includes("fa-circle")) {

                __this.attr("class","multi-step-form-selection-card active margin-0 text-left");
                __this.css("background-color","#f2f7f2");
                circleChild.replaceWith('<i class="fas fa-dot-circle fa-2x multi-step-form-selection-card-circle-icon"></i>');

                if (__this.attr("id") == "m-1") {

                    $(".multi-step-form-options-card-submit-button").text("Join with unregistered business");
                    $("#business_type").val(1);
                    
                    clearSelection("m-2");

                } else {

                    $(".multi-step-form-options-card-submit-button").text("Join with registered business");
                    $("#business_type").val(2);
                    clearSelection("m-1");

                }

                $("#business-class-option-button").attr("disabled",false);

                $(".multi-step-form-options-card-submit-button").css("background-color","#14a600");
                $(".multi-step-form-options-card-submit-button").css("border","1 px solid #14a600");
                $(".multi-step-form-options-card-submit-button").css("color","#fff");
                $(".multi-step-form-options-card-submit-button").css("cursor","pointer");

            } else {

                __this.attr("class","multi-step-form-selection-card margin-0 text-left");
                __this.css("background-color","#fff");
                circleChild.replaceWith('<i class="far fa-circle fa-2x multi-step-form-selection-card-circle-icon"></i>');

                $(".multi-step-form-options-card-submit-button").text("Create Account");
                $(".multi-step-form-options-card-submit-button").css("background-color","#e4ebe4");
                $(".multi-step-form-options-card-submit-button").css("border","1 px solid #e4ebe4");
                $(".multi-step-form-options-card-submit-button").css("color","#ccc");
                $(".multi-step-form-options-card-submit-button").css("cursor","not-allowed");

                $("#business-class-option-button").attr("disabled",true);

            }

        });

        function clearSelection(selection){

            console.log(selection);
            let ___this = $(selection);

            ___this.attr("class","multi-step-form-selection-card margin-0 text-left");
            ___this.css("background-color","#fff");

            let rowClearChild = ___this.children('div.row').eq(0);
            console.log(rowClearChild);
            let col1ClearChild = rowClearChild.children('div.col-1').eq(0);
            console.log(col1ClearChild);
            var circleClearChild = col1ClearChild.children('i.multi-step-form-selection-card-circle-icon').eq(0);
            console.log(circleClearChild);

            circleClearChild.replaceWith('<i class="far fa-circle fa-2x multi-step-form-selection-card-circle-icon"></i>');

        }

        $(document).on("click","#create-user-account-button", function (){

            $.ajax({
                'url':'{{ route("register_external_user") }}',
                'method':'POST',
                'data':{
                    _token:$('meta[name="csrf-token"]').attr('content'),
                    'first_name':$("#first_name").val(),
                    'middle_name':$("#middle_name").val(),
                    'last_name':$("#last_name").val(),
                    'gender':$("#gender").val(),
                    'phone':$("#phone").val(),
                    'email':$("#email").val(),
                    'password':$("#password").val(),
                    'confirm_password':$("#confirm_password").val()
                },
                success:function (response) {

                    if (response.success == 1) {

                        $.ajax({
                            'url':'{{ route("login_json") }}',
                            'method':'POST',
                            'data':{
                                _token:$('meta[name="csrf-token"]').attr('content'),
                                'email':$("#email").val(),
                                'password':$("#password").val()
                            },
                            success:function (response) {

                                if (response.success == 1) {

                                    // window.location.href = response.redirect_route;
                                    $("#auth_id").val(response.auth_id);
                                    $("#redirect_route").val(response.redirect_route);
                                    // $("#user-name").val(response.auth_name);

                                    $(".step-2").css("display","none");
                                    $(".step-3").css("display","block");

                                }
                            },
                            error:function (response) {
                                // console.log(response);
                            }
                        });
                        
                    }

                },
                error:function (response) {
                    // console.log(response);
                }
            });

        });

        $(document).on('click',"#business-class-option-button", function () {

            $(".step-1").css("display","none");
            $(".step-2").css("display","block");
            
        });

        $(document).on('click',".agree-terms", function () {

            if ($(this).is(':checked')){
                $("#create-user-account-button").css("display","block");
            }else{
                $("#create-user-account-button").css("display","none");
            }
            
        });

    });
</script>
@endsection