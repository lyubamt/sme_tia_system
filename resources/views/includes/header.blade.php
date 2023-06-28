@php

    $app_url = \Config::get('env.APP_URL');

@endphp
<div class="row header-row">

    <div class="col-6">

        <h4 class="welcome-word">Welcome back, <b>{{ ucwords(strtolower(auth()->user()->name)) }}</b></h4>

    </div>

    <div class="col-6 text-right" style="padding: 0px;">

        <div class="row" style="margin: 0px;padding: 0px;">

            <!-- <h4 class="welcome-word display-inline header-time" id="header-time">TIME:&nbsp;{{ date("d.m.Y H:s") }}</h4> -->
            <!-- <div class="col-3 change-lang-container text-right" style="display: inline;margin: 0px;padding: 0px 10px;">
                <select class="form-select changeLang form-control float-right" style="width: 100px;margin: 0px;">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="sw" {{ session()->get('locale') == 'sw' ? 'selected' : '' }}>Swahili</option>
                    <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>
                </select>
            </div> -->

            <div class="col-12" style="margin: 0px;padding: 0px;">

                <a href="{{route('logout')}}" class="logout-link">
                    <i class="fas fa-sign-out-alt fa-2x" title="Sign Out"></i>
                </a>

                @include("includes.sidebar-small")

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

            </div>
            <!-- /.row  -->

        <!-- <h4 class="welcome-word display-inline header-time" id="header-time">TIME:&nbsp;{{ date("d.m.Y H:s") }}</h4> -->

    </div>

    <div class="col-md-12">
      <div class="alert-success"></div>
      <div class="alert-danger"></div>
    </div>

    <div class="col-md-12" style="padding-top: 20px;">

        <div class="row">

            <div class="col-6 text-center">

                <div class="dropdown sell-buy-drop-down">
                    <a class="btn btn-primary text-left sell-buy-button" data-toggle="dropdown" id="buy-button"><b class="sell-buy-text">Purchase</b>&nbsp;&nbsp;<i class="fas fa-plus float-right sell-buy-icon"></i></a>
                    <div class="dropdown-menu">

                        @php

                            $purchase_items = \App\Helpers\AuthenticateTokenActivationKey::getAuthPurchaseItems();

                        @endphp

                        @if (count($purchase_items) > 0)
                            @foreach($purchase_items as $item)
                                <a class="dropdown-item" href="{{ route('admin.purchases.purchase.create',$item->id) }}">{{ $item->name }}</a>
                                <div class="dropdown-divider"></div>
                            @endforeach
                        @endif
                    </div>

                </div>
                <!-- /.drop-down  -->

            </div>

            <div class="col-6 text-center">

                <div class="dropdown sell-buy-drop-down">
                    <a class="btn btn-primary text-left sell-buy-button" data-toggle="dropdown" id="sell-button"><b class="sell-buy-text">Sell</b>&nbsp;&nbsp;<i class="fas fa-plus float-right sell-buy-icon"></i></a>
                    <div class="dropdown-menu">

                        @php

                            $sale_items = \App\Helpers\AuthenticateTokenActivationKey::getAuthSaleItems();

                        @endphp

                        @if (count($sale_items) > 0)
                            @foreach($sale_items as $item)
                                <a class="dropdown-item" href="{{ route('admin.sales.sale.create',$item->id) }}">{{ $item->name }}</a>
                                <div class="dropdown-divider"></div>
                            @endforeach
                        @endif
                    </div>

                </div>
                <!-- /.drop-down  -->
            </div>

        </div>
      
    </div>

</div>
