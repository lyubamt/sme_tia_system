@extends('layouts.master_dashboard')

@section('title')
Choose-your-business
@endsection

@section("css")

<style>
  .my-account-column-link {
     text-decoration: none;
  }

  .my-account-column-link:hover {
     text-decoration: none;
  }

  .my-account-button {
     padding: 0px;
     margin-bottom: 10px;
     border: 1px solid #e4ebe4;
     border-radius: 14px;
     min-height: 170px;
     background: #f7f5f5;
     color: #e4ebe4;
  }

  .my-account-button:hover {
     background-color: #fff;/* #E3E6ED */
     color: #01579b;
  }

  .my-account-card {
     padding: 20px;
     margin: 0px;
     border: 1px solid #e4ebe4;
     border-radius: 14px;
     min-height: 170px;
     background: #f7f5f5;
     color: #e4ebe4;
  }

  .my-account-card:hover {
     background-color: #fff;/* #E3E6ED */
     color: #01579b;
  }
  .my-account-card-img{
    width: 64px;
    height: 64px;
    color: #888888;
  }

  .my-account-card-title {
     color: #636060;
     font-family: Arial, Helvetica, sans-serif;
     font-size: 25px;
     font-weight: 550;
  }

  .my-account-card-subtitle {
     color: #01579b;
     font-family: Arial, Helvetica, sans-serif;
     font-size: 16px;
     font-weight: 500;
  }

  .add-business-column-link {
     text-decoration: none;
  }

  .add-business-column-link:hover {
     text-decoration: none;
  }

  .add-business-card {
     padding: 30px 20px;
     margin-bottom: 10px;
     border: 2px solid #e4ebe4;
     border-radius: 14px;
     min-height: 150px;
     background: #fff;
  }

  .add-business-card:hover {
     background-color: #f7f5f5;/* #E3E6ED */
     color: #007BFF;
  }
  .add-business-card-img{
    width: 64px;
    height: 64px;
    color: #01579b;
    vertical-align: middle;
  }

  .add-business-card-subtitle {
     color: #7e8c82;
     font-family: Arial, Helvetica, sans-serif;
     font-size: 16px;
  }
</style>

@endsection

@section('modals')

<!-- Modal -->
<div class="modal fade" id="registerBusinessModal" tabindex="-1" role="dialog" aria-labelledby="registerBusinessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fas fa-times"></span>
        </button>

        <h2>Add your new business</h2>

        <div class="form-container">

            <form method="POST" action="{{ route('admin.businesses.business.store') }}" accept-charset="UTF-8" enctype="multipart/form-data" id="create_business_form" name="create_business_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.businesses.businesses.form', [
                                        'business' => null,
                                      ])

                <div class="form-group text-left">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </div>

            </form>

        </div>

      </div>
    </div>
  </div>
</div>

@endsection

@section('content')

@php

    $app_url = \Config::get('env.APP_URL');

@endphp

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <span class="fas fa-ok"></span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}
                
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

            </li>
        @endforeach
    </ul>
@endif

            

<div class="row">

  <div class="col-md-2">
      <a class="add-business-column-link" data-toggle="modal" data-target="#registerBusinessModal">
          <div class="add-business-card">

              <div class="row">

                  <div class="col-md-12 text-center">

                    <i class="fas fa-plus add-business-card-img fa-6x"></i>

                  </div>

              </div>
              <!--/.add-business-card-row-->

          </div>
          <!--/.add-business-card-->
      </a>

  </div>

  @if (count($businesses) > 0)

    @foreach ($businesses as $business)

        <div class="col-md-3">
          <form method="POST" action="{{ route('select_business') }}" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input hidden type="text" name="businessName" value="{{ $business->name }}">
            <input hidden type="text" name="businessId" value="{{ $business->id }}">
            <!-- <a class="my-account-column-link"> -->
              <button type="submit" class="my-account-button">
                <div class="my-account-card">

                    <div class="row">

                        <div class="col-md-3">

                            <span class="far fa-building my-account-card-img fa-3x"></span>

                        </div>

                        <div class="col-md-9 text-left">

                            <h5 class="my-account-card-title">{{ $business->name }}</h5>
                            <p class="my-account-card-subtitle">{{ optional($business->businessCategory)->name }}</p>

                        </div>

                    </div>
                    <!--/.my-account-card-row-->

                </div>
                <!--/.my-account-card-->
            <!-- </a> -->
            </button>
            </form>

        </div>

    @endforeach

  @endif

</div>
<!-- /.row -->

@endsection
