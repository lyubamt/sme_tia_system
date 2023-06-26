@extends('layouts.master_landing')

@section('title')
Applications
@endsection

@section("css")

<style>
  .my-account-column-link {
     text-decoration: none;
  }

  .my-account-column-link:hover {
     text-decoration: none;
  }

  .my-account-card {
     padding: 20px;
     margin-bottom: 10px;
     border: 1px solid #7e8c82;
     border-radius: 14px;
     min-height: 170px;
     background: #E6E6E6;
  }

  .my-account-card:hover {
     background-color: #f7f5f5;/* #E3E6ED */
     color: #007BFF;
  }
  .my-account-card-img{
    width: 64px;
    height: 64px;
  }

  .my-account-card-subtitle {
     color: #7e8c82;
     font-family: Arial, Helvetica, sans-serif;
     font-size: 16px;
  }
</style>

@endsection

@section('content')

@php

    $app_url = \Config::get('env.APP_URL');

@endphp

<div class="row">

  <div class="col-md-3">
      <a href="#" class="my-account-column-link">
          <div class="my-account-card">

              <div class="row">

                  <div class="col-md-3">

                      <span class="far fa-building fa-3x"></span>

                  </div>

                  <div class="col-md-9 text-left">

                      <h5>Station Data</h5>
                      <p class="my-account-card-subtitle">Archive, Manage and Manipulate Station Data and ensure Quality Control</p>

                  </div>

              </div>
              <!--/.my-account-card-row-->

          </div>
          <!--/.my-account-card-->
      </a>

  </div>

  <div class="col-md-3">
      <a href="#" class="my-account-column-link">
          <div class="my-account-card">

              <div class="row">

                  <div class="col-md-4">

                      <span class="fas fa-map-marker-alt fa-3x"></span>

                  </div>

                  <div class="col-md-8 text-left">

                      <h5>GIS</h5>
                      <p class="my-account-card-subtitle">Climatorologiacal Data based on Geographic Information System</p>

                  </div>

              </div>
              <!--/.my-account-card-row-->

          </div>
          <!--/.my-account-card-->
      </a>

  </div>

  <div class="col-md-3">
      <a href="#" class="my-account-column-link">
          <div class="my-account-card">

              <div class="row">

                  <div class="col-md-3">

                      <span class="far fa-folder-open fa-3x"></span>

                  </div>

                  <div class="col-md-9 text-left">

                      <h5>Scanned Document(s)</h5>
                      <p class="my-account-card-subtitle">Archive,  Manage and Index Scanned Weather forms</p>

                  </div>

              </div>
              <!--/.my-account-card-row-->

          </div>
          <!--/.my-account-card-->
      </a>

  </div>

  <div class="col-md-3">
      <a href="#" class="my-account-column-link">
          <div class="my-account-card">

              <div class="row">

                  <div class="col-md-3">

                      <img src="{{ asset($app_url.'/img/aws.png') }}" alt="AWS">

                  </div>

                  <div class="col-md-9 text-left">

                      <h5>AWS</h5>
                      <p class="my-account-card-subtitle">Gather, Organise, Manage, Export and QC of Automatic Wx Station Data</p>

                  </div>

              </div>
              <!--/.my-account-card-row-->

          </div>
          <!--/.my-account-card-->
      </a>

  </div>

  <div class="col-md-3">
      <a href="#" class="my-account-column-link">
          <div class="my-account-card">

              <div class="row">

                  <div class="col-md-4">

                      <span class="fas fa-satellite-dish fa-3x"></span>

                  </div>

                  <div class="col-md-8 text-left">

                      <h5>Satellite Data</h5>
                      <p class="my-account-card-subtitle">Satelite Data Aggregation based on different formats</p>

                  </div>

              </div>
              <!--/.my-account-card-row-->

          </div>
          <!--/.my-account-card-->
      </a>

  </div>

  <div class="col-md-3">
      <a href="#" class="my-account-column-link">
          <div class="my-account-card">

              <div class="row">

                  <div class="col-md-4">

                      <img src="{{ asset($app_url.'/img/ocr1.png') }}" class="my-account-card-img" alt="OCR">

                  </div>

                  <div class="col-md-8 text-left">

                      <h5>OCR</h5>
                      <p class="my-account-card-subtitle">Read & Translate Scanned  Document(s) including Handwritten</p>

                  </div>

              </div>
              <!--/.my-account-card-row-->

          </div>
          <!--/.my-account-card-->
      </a>

  </div>

  <div class="col-md-3">
      <a href="{{ route('admin.customers.customer.index') }}" class="my-account-column-link">
          <div class="my-account-card">

              <div class="row">

                  <div class="col-md-4">

                      <i class="fas fa-users fa-3x"></i>

                  </div>

                  <div class="col-md-8 text-left">

                      <h5>Customers Manager</h5>
                      <p class="my-account-card-subtitle">Manage customers per time, per parameter & station</p>

                  </div>

              </div>
              <!--/.my-account-card-row-->

          </div>
          <!--/.my-account-card-->
      </a>

  </div>

  <div class="col-md-3">
      <a href="{{ route('admin_dashboard') }}" class="my-account-column-link">
          <div class="my-account-card">

              <div class="row">

                  <div class="col-md-4">

                      <i class="fas fa-users-cog fa-3x"></i>

                  </div>

                  <div class="col-md-8 text-left">

                      <h5>Administration</h5>
                      <p class="my-account-card-subtitle">System administration, Metadata, Users & roles Management</p>

                  </div>

              </div>
              <!--/.my-account-card-row-->

          </div>
          <!--/.my-account-card-->
      </a>

  </div>

</div>
<!-- /.row -->

@endsection
