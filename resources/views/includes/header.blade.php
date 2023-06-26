@php

    $app_url = \Config::get('env.APP_URL');

@endphp
<div class="row header-row">
    <div class="col-md-5">

        <h4 class="welcome-word">Welcome back, <b>{{ ucwords(strtolower(auth()->user()->name)) }}</b></h4>

    </div>

    <div class="col-md-7 text-right">

        <!-- <h4 class="welcome-word display-inline header-time" id="header-time">TIME:&nbsp;{{ date("d.m.Y H:s") }}</h4> -->

        <a href="{{route('logout')}}">
            <i class="fas fa-sign-out-alt fa-2x" title="Sign Out"></i>
        </a>
        &nbsp;

        <div class="dropdown header-menu-dropdown">
            <i class="fas fa-ellipsis-v fa-2x" title="Menu" data-toggle="dropdown"></i>
            <ul class="dropdown-menu dropdown-menu-left header-menu-dropdown-items-container">

              <li>
                  <h6 data-toggle="modal" data-target="#change-password-modal"><a href="#"><i class="fas fa-key"></i> Change Password</a></h6>
              </li>

              <li class="divider"></li>

              <li></li>
            </ul>
        </div>

    </div>

    <div class="col-md-12">
      <div class="alert-success"></div>
      <div class="alert-danger"></div>
    </div>
</div>
