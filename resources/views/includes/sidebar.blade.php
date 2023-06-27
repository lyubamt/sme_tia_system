@php

  $show_location_sub_menu = "";
  $show_administration_sub_menu = "";
  $show_report_sub_menu = "";

  $active_dashboard = "";
  $active_stations = "";
  $active_regions = "";
  $active_districts = "";

  $active_users = "";
  $active_roles = "";
  $active_system_settings = "";
  $active_user_login_logs = "";
  $active_logs = "";

  $active_businesses = "";
  $active_items = "";
  $active_transaction_categories = "";
  $active_transactions = "";
  $active_units = "";

  $active_profit_and_loss = "";

  if (strpos($ref,"dashboard") !== false){
    $active_dashboard = "active";
  }
  
  if (strpos($ref,"regions") !== false){
    $active_regions = "active";
    $show_location_sub_menu = "show";
  }elseif (strpos($ref,"districts") !== false){
    $active_districts = "active";
    $show_location_sub_menu = "show";
  }
  
  if (strpos($ref,"users") !== false){
    $active_users = "active";
    $show_administration_sub_menu = "show";
  }elseif (strpos($ref,"admin/roles") !== false){
    $active_roles = "active";
    $show_administration_sub_menu = "show";
  }elseif (strpos($ref,"admin/system_settings") !== false){
    $active_system_settings = "active";
    $show_administration_sub_menu = "show";
  }elseif (strpos($ref,"admin/user_login_logs") !== false){
    $active_user_login_logs = "active";
    $show_administration_sub_menu = "show";
  }elseif (strpos($ref,"admin/logs") !== false){
    $active_logs = "active";
    $show_administration_sub_menu = "show";
  }

  if (strpos($ref,"businesses") !== false){
    $active_businesses = "active";
  }

  if (strpos($ref,"items") !== false){
    $active_items = "active";
  }

  if (strpos($ref,"transaction_categories") !== false){
    $active_transaction_categories = "active";
  }

  if (strpos($ref,"transactions") !== false){
    $active_transactions = "active";
  }

  if (strpos($ref,"units") !== false){
    $active_units = "active";
  }

  if (strpos($ref,"profit_and_loss") !== false){
    $active_profit_and_loss = "active";
    $show_report_sub_menu = "show";
  }


@endphp

<!-- <h4 class="site-name"><b>SME-Business System</b></h4> -->

<!-- navigation-wrapper-large -->
<div class="side-navigation-large">

  <ul class="side-navigation-list">

    <li class="side-navigation-item {{ $active_dashboard }}">
      <a class="side-navigation-item-link" href="{{ route('dashboard') }}">
        <i class="fas fa-sliders-h"></i>
        Dashboard
      </a>
    </li>

    @hasanyrole("Admin")

    <li class="side-navigation-item">
      <a class="side-navigation-item-link collapse-btn" href="#" data-toggle="collapse" data-target="#administration-sub-menu" >
        <i class="fas fa-users-cog"></i>
        Administration&nbsp;

        @if ($show_administration_sub_menu == "show")
            <i class="fas fa-angle-down"></i>
        @else
            <i class="fas fa-angle-left"></i>
        @endif
      </a>
      <ul id="administration-sub-menu" class="collapse {{ $show_administration_sub_menu }} sub-menu">

        <li class="side-navigation-item {{ $active_users }}">
          <a class="side-navigation-item-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-users"></i>
            Users
          </a>
        </li>

        <li class="side-navigation-item {{ $active_roles }}">
          <a class="side-navigation-item-link" href="{{ route('admin.role.index') }}">
            <i class="fas fa-key"></i>
            Roles
          </a>
        </li>

        <li class="side-navigation-item {{ $active_system_settings }}">
          <a class="side-navigation-item-link" href="{{ route('admin.system_settings.system_setting.index') }}">
            <i class="fas fa-cogs"></i>
            Settings
          </a>
        </li>

        <li class="side-navigation-item {{ $active_user_login_logs }}">
          <a class="side-navigation-item-link" href="{{ route('admin.user_login_logs.user_login_log.index') }}">
            <i class="fas fa-user-clock"></i>
            Sign In Logs
          </a>
        </li>

        <li class="side-navigation-item {{ $active_logs }}">
          <a class="side-navigation-item-link" href="{{ route('admin.logs.log.index') }}">
            <i class="fas fa-history"></i>
            Activity Logs
          </a>
        </li>

      </ul>
    </li>

    <li class="side-navigation-item {{ $active_businesses }}">
      <a class="side-navigation-item-link" href="{{ route('admin.businesses.business.index') }}">
        <i class="fas fa-business-time"></i>
        Businesses
      </a>
    </li>

    <li class="side-navigation-item {{ $active_transaction_categories }}">
      <a class="side-navigation-item-link" href="{{ route('admin.transaction_categories.transaction_category.index') }}">
        <i class="fas fa-circle-notch"></i>
        Categories
      </a>
    </li>

    @endhasanyrole

    <li class="side-navigation-item {{ $active_items }}">
      <a class="side-navigation-item-link" href="{{ route('admin.items.item.index') }}">
        <i class="fas fa-circle-notch"></i>
        Items
      </a>
    </li>

    <li class="side-navigation-item {{ $active_units }}">
      <a class="side-navigation-item-link" href="{{ route('admin.units.unit.index') }}">
        <i class="fas fa-circle-notch"></i>
        Units
      </a>
    </li>

    <li class="side-navigation-item {{ $active_transactions }}">
      <a class="side-navigation-item-link" href="{{ route('admin.transactions.transaction.index') }}">
        <i class="fas fa-receipt"></i>
        Transactions
      </a>
    </li>

    <li class="side-navigation-item">
      <a class="side-navigation-item-link collapse-btn" href="#" data-toggle="collapse" data-target="#report-sub-menu" >
        <i class="far fa-chart-bar"></i>
        Analysis & Reports

        @if ($show_report_sub_menu == "show")
            <i class="fas fa-angle-down"></i>
        @else
            <i class="fas fa-angle-left"></i>
        @endif
      </a>
      <ul id="report-sub-menu" class="collapse {{ $show_report_sub_menu }} sub-menu">

        <li class="side-navigation-item {{ $active_profit_and_loss }}">
          <a class="side-navigation-item-link" href="{{ route('admin.reports.report.profit_and_loss') }}">
            <i class="fas fa-circle-notch"></i>
            Profit & Loss
          </a>
        </li>

      </ul>

    </li>

    @hasanyrole("Admin")

    <li class="side-navigation-item">
      <a class="side-navigation-item-link collapse-btn" href="#" data-toggle="collapse" data-target="#location-sub-menu" >
        <i class="fas fa-map-marker-alt"></i>
        Location(s)&nbsp;

        @if ($show_location_sub_menu == "show")
            <i class="fas fa-angle-down"></i>
        @else
            <i class="fas fa-angle-left"></i>
        @endif
      </a>
      <ul id="location-sub-menu" class="collapse {{ $show_location_sub_menu }} sub-menu">

        <li class="side-navigation-item {{ $active_regions }}">
          <a class="side-navigation-item-link" href="{{ route('admin.regions.region.index') }}">
            <i class="fas fa-thumbtack"></i>
            Regions
          </a>
        </li>

        <li class="side-navigation-item {{ $active_districts }}">
          <a class="side-navigation-item-link" href="{{ route('admin.districts.district.index') }}">
            <i class="fas fa-thumbtack"></i>
            Districts
          </a>
        </li>

      </ul>

    </li>

    @endhasanyrole

  </ul>

</div>
<!-- /.navigation-wrapper-large -->
