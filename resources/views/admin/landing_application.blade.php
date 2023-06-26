@extends('layouts.master_clidata')

@section('title')
Dashboard
@endsection

@section("css")

<style>
  .dashboard-column-link {
     text-decoration: none;
  }

  .dashboard-column-link:hover {
     text-decoration: none;
  }

  .dashboard-card {
     padding: 20px;
     margin-bottom: 10px;
     border: 1px solid #E6E6E6;
     border-radius: 14px;
     min-height: 170px;
     background: #ffffff;
     color: #007BFF;
     z-index: 5000;
  }

  .dashboard-card:hover {
     outline-style: outset;
     outline-color: #C8FF25;
     box-shadow: 0px 0px 15px 0px #C8FF25;
     color: #007BFF;
     cursor: pointer;
  }
  .dashboard-card-img{
    width: 64px;
    height: 64px;
  }
  .dashboard-card-total-container{
    padding: 5% 0px 0px;
  }
  .dashboard-card-total-number{
    color: #7e8c82;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 50px;
  }
  .dashboard-card-sub-total-number{
    color: #007BFF;
  }
  .dashboard-card-title {
     color: black;
     font-family: Arial, Helvetica, sans-serif;
     font-size: 16px;
     font-weight: 700;
  }
  .dashboard-card-subtitle {
     color: #7e8c82;
     font-family: Arial, Helvetica, sans-serif;
     font-size: 16px;
  }
</style>

@endsection

@section('content')

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
            <li>
              {{ $error }}
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </li>
        @endforeach
    </ul>
@endif

<div class="row">

  <div class="col-md-4">
      <!-- <a href="#" class="dashboard-column-link"> -->
          <div class="dashboard-card">

              <div class="row">

                  <div class="col-md-4">

                      <span class="fas fa-users fa-3x"></span>

                      <div class="text-center dashboard-card-total-container">
                        <h4 class="dashboard-card-total-number">0</h4>
                      </div>

                  </div>

                  <div class="col-md-8 text-left">

                      <h5 class="dashboard-card-title">USERS</h5>
                      <p class="dashboard-card-subtitle">
                      <b class="dashboard-card-sub-total-number">0</b> Administrators<br>
                      <b class="dashboard-card-sub-total-number">0</b> Business Owners<br>

                  </div>

              </div>
              <!--/.dashboard-card-row-->

          </div>
          <!--/.dashboard-card-->
      <!-- </a> -->

  </div>

</div>
<!-- /.row -->

@endsection
