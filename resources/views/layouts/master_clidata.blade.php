<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="The SME Business Management System">
    <meta name="X-UA-Compatible" content="ie=edge">
    <meta name="Content-Language" content="en-us">
    <meta name="keywords" content="TIA, Business, SME, Management System, Business System">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php

      $app_url = \Config::get('env.APP_URL');

    @endphp

    <title>SME-Business System | @yield("title")</title>


    <link rel="stylesheet" href="{{asset($app_url.'/css/app.css')}}">

    <link rel="stylesheet" href="{{ asset($app_url.'/map/style.css') }}">

    <style>
      .medium-size-radio-btn{
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
        transform: scale(1.5);
      }

      /* width */
      ::-webkit-scrollbar {
          width: 10px;
      }

      /* Track */
      ::-webkit-scrollbar-track {
          background: #f1f1f1;
          border-radius: 10px;
      }

      /* Handle */
      ::-webkit-scrollbar-thumb {
          background: #888;
          border-radius: 10px;
      }

      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
          background: #555;
      }

      .maximize-checkbox {
          transform: scale(1.7);
      }

      .container-fluid{
        margin: 0px;
        padding: 0px 0px;
        background: #F8FAFB;
        height: 100vh;
        position:fixed;
      }
      @media screen and (max-width: 657px){
        .container-fluid{
            height: 100%;
            position:relative;
            overflow-y: scroll;
        }
      }
      .side-bar-container{
          height: 100vh;
          padding: 0px 0px 100px 0px;
          overflow: auto;
          margin: 0px;
      }
      @media screen and (max-width: 657px){
        .side-bar-container{
          display: none;
        }
      }
      .content-container{
          height: 100vh;
          overflow: auto;
      }
      @media screen and (max-width: 657px){
        .content-container{
            height: 100%;
        }
      }
      .site-name{
        /* font-family: "Lucida Console", "Courier New", monospace; */
        font-family: Arial, Helvetica, sans-serif;
        color: #01579b;
      }
      .header-system-applications-icon{
        width: 30px;
        height: 30px;
        margin: 0px 0px 13px 0px;
      }
      .side-navigation-large{
        margin: 0px;
        padding: 0px;
        margin-top: 5px;
        overflow: auto;
      }
      @media screen and (max-width: 657px){
        .side-navigation-large{
          display: none;
        }
      }
      .side-navigation-list{
        list-style-type: none;
      }
      .side-navigation-item{
        font-family: Arial, Helvetica, sans-serif;
        padding: 7px 3px 7px 5px;
      }
      .side-navigation-item.active{
        background: #01579b;
        border-radius: 9px;
      }
      .side-navigation-item.active>a{
        color: #fff;
        background: #01579b;
      }
      .side-navigation-item-link{
        text-decoration: none;
        color: black;
        font-size: 17px;
      }
      .side-navigation-item-link:hover{
        text-decoration: none;
        color: #a39a99;
      }
      .header-row{
        padding: 0px 15px 0px 15px;
      }
      @media screen and (max-width: 657px){
        .header-row{
          padding: 0px 5px 0px 5px;
        }
      }
      .header-menu-dropdown{
        display: inline;
      }
      .header-menu-dropdown-items-container{
        padding: 15px 15px 15px 15px;
        width: 200px !important;
      }
      .welcome-word{
        font-family: Arial, Helvetica, sans-serif;
      }
      .page-wrapper{
        padding-top: 30px 0px 30px 0px;
      }
      .header-container{
        margin: 0px 0px 23px 0px;
      }
      .page-content-card{
        padding: 25px;
      }
      table > thead > tr > th {
        font-family: Arial, Helvetica, sans-serif;
      }
      dl > dt {
        font-family: Arial, Helvetica, sans-serif;
      }
      label {
        font-family: Arial, Helvetica, sans-serif;
      }
      .page-content-card > h4 {
        font-family: Arial, Helvetica, sans-serif;
      }
      h1,h2,h3,h4,h5,h6,p,label,a,div{
        font-family: Arial, Helvetica, sans-serif;
      }
      .sell-buy-drop-down{
        z-index: 638364849393938393;
      }
      .sell-buy-button{
        font-size: 18px;
        min-width: 170px;
        background-color: #fff;
        color: #01579b;
        border: 1px solid #01579b;
        border-radius: 8px;
      }
      @media screen and (max-width: 657px){
        .sell-buy-button{
          font-size: 18px;
          min-width: 120px;
        }
      }
      .sell-buy-button:hover{
        background-color: #01579b;
        color: #fff;
        border: 1px solid #01579b;
      }
      .sell-buy-icon{
        color: #01579b;
      }
      .sell-buy-button:hover > .sell-buy-icon{
        color: #fff;
      }
      .sell-buy-text{
        color: #01579b;
        font-weight: 300;
      }
      .sell-buy-button:hover > .sell-buy-text{
        color: #fff;
      }
      footer{
        margin: 0px;
        padding: 2% 0px;
      }
      .footer-link{
        text-decoration: none;
        color: grey;
      }
      .footer-copy-right{
        color: grey;
      }
      .form-inline{
        display: inline;
      }
      .input-inline{
        display: inline;
      }
      .close-modal-btn{
        color: grey;
        font-size: 25px;
      }
      .close-modal-btn:hover{
        cursor: pointer;
      }
      .save-btn-medium-size{
        font-size: 22px;
      }
      .white-color{
        color: white;
      }
      .load-image{
        width: 70px;
        height: 70px;
      }

      .hide-load-image{
        display: none;
      }
      .nav-tabs> li{
        padding: 3px 10px 3px 10px;
      }

      .nav-tabs> li > a {
        text-decoration: none;
        color: grey;
        font-size: 23px;
        font-family: Arial, Helvetica, sans-serif;
      }

      .nav-tabs> li.active > a {
        color: #48576e;
        font-weight: 800;
        border-bottom: 3px solid #48576e;
      }

      .nav-tabs> li > a:hover {
        color: black;
      }

      .nav-pills> li{
        padding: 3px 10px 3px 10px;
      }
      .nav-pills> li > a {
        text-decoration: none;
        color: grey;
        font-size: 23px;
        font-family: Arial, Helvetica, sans-serif;
      }

      .nav-pills> li.active > a {
        color: #48576e;
        font-weight: 800;
        border-bottom: 3px solid #48576e;
      }

      .nav-pills> li > a:hover {
        color: black;
      }
      .sub-menu{
        list-style-type: none;
      }

      .tab-pane{
        padding: 10px 3px 5px 3px;
      }

      /* SYSTEM PARAMETERS */
      .e-data-list-container,.n-data-container{
        padding: 0px;
      }
      .add-system-parameter-dependency-btn{
        color: white;
      }
      .add-system-parameter-dependency-btn-text{
        color: white;
      }
      .remove-system-parameter-dependency-btn{
        color: grey;
      }
      .remove-system-parameter-dependency-btn:hover{
        background: inherit;
        font-size: 20px;
        cursor: pointer;
      }
      .add-new-dependency-data-modal-title{
        color: grey;
        font-family: Arial, Helvetica, sans-serif;
      }
      .banner-section{
        padding: 10px 10px 10px 10px;
      }
      .site-title{
        font-size: 25px;
        font-weight: 700;
        color: #01579b;
        text-shadow: 0px 2px 2px rgba(255, 255, 255, 0.4);
      }
      @media screen and (max-width: 657px){
        .site-title{
          font-size: 16px;
          font-weight: 700;
          color: #01579b;
          text-shadow: 0px 2px 2px rgba(255, 255, 255, 0.4);
        }
      }
      .side-navigation-small{
        display: none;
      }
      @media screen and (max-width: 657px){
        .side-navigation-small{
          display: block;
        }
        .logout-link{
          display: none;
        }
        .header-menu-dropdown{
          display: none;
        }
      }
      .tia-logo{
        width: 100px;
        height: 61px;
      }
      @media screen and (max-width: 657px){
        .tia-logo{
          width: 80px;
          height: 49px;
        }
      }
      .card{
        margin-top: 20px;
      }

    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

  </head>
  <body id="site_translate">

    @php

        $ref = (isset($_SERVER['REQUEST_URI']))?$_SERVER['REQUEST_URI']:"NONE";
        $ip = (isset($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR']:"NONE"

    @endphp

    <!--change-password-modal-->
    <div class="modal" id="change-password-modal">
       <div class="modal-dialog">
           <div class="modal-content">

               <div class="modal-body">

                   <button type="button" class="close" data-dismiss="modal">&times;</button>

                   <form method="POST" action="{{ route('admin.user.change_password') }}" accept-charset="UTF-8" id="create_hp1_form" name="create_hp1_form" class="form-horizontal">
                   {{ csrf_field() }}

                       <input hidden id="change_password_form_id" name="change_password_id" type="text" value="{{ auth()->user()->id }}" >


                       <div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">

                           <div class="col-md-10">
                               <label for="old password" class="control-label">{{ trans('Old Password') }}</label>
                               <input class="form-control" name="password" type="password" id="password" value="" minlength="1" maxlength="255" required="required" placeholder="{{ trans('Old Password') }}">
                               {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                           </div>
                       </div>

                       <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">

                           <div class="col-md-10">
                               <label for="new password" class="control-label">{{ trans('New Password') }}</label>
                               <input class="form-control" name="new_password" type="password" id="new_password" value="" minlength="1" maxlength="255" required="required" placeholder="{{ trans('New Password') }}">
                               {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                           </div>
                       </div>

                       <button type="submit" class="btn btn-primary">Submit</button>

                   </form>

               </div>

           </div>
       </div>
     </div>
     <!--/.change-password-modal-->

     @yield('modals')

    <div class="container-fluid" id="app">

      <div class="row" style="margin: 0px;padding: 0px;">

        <div class="col-md-12" style="margin: 0px 0px 30px 0px;padding: 0px;background:url( {{ url('/img/tz_flag.jpg') }} );background-size: cover;background-repeat: no-repeat;">

          <div class="row banner-section">

            <div class="col-3">

              <img src="{{ url('img/em.png') }}" style="width: 61px;height: 61px;">

            </div>

            <div class="col-6 text-center">

                <h5 class="site-title">Tanzania Institute of Accountancy (TIA)</h5>
                <h4 class="site-title">SME Business Management System</h4>

            </div>

            <div class="col-3 text-right">

              <img src="{{ url('img/new_tia.png')}}"  class="tia-logo" alt="TIA LOGO" style="width: 100px;height: 61px;">

            </div>

          </div>

        </div>

        <div class="col-md-2 side-bar-container">

          @include("includes.sidebar")

        </div>

        <div class="col-md-10 content-container">

            <!-- header-wrapper -->
            <div class="header-wrapper">

                @include("includes.header")

            </div>
            <!-- /.header-wrapper -->

            <!-- page-wrapper -->
            <div class="page-wrapper">

                @yield("content")

            </div>
            <!-- /.page-wrapper -->

            <div class="footer-wrapper">

              @include("includes.footer")

            </div>

        </div>

      </div>
      <!-- /.page-row -->

    </div>
    <!-- /.container-fluid -->

    <!-- jQuery -->
    <script src="{{asset($app_url.'/js/app.js')}}"></script>

    <!--
    <script>
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'},'site_translate')
      }
    </script>

    <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
     -->
    
    <script src="https://code.highcharts.com/5.0.14/highcharts.src.js"></script>
    <script src="https://code.highcharts.com/5.0.14/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/5.0.14/modules/offline-exporting.js"></script>
    <script type="text/javascript">

      $(document).ready(function (){
        
        let table = new DataTable('#data-table');

        $('.tab-pill-item').on('click', function (){

          $(".tab-pill-item.active").attr("class","tab-pill-item");
          $(this).attr("class","tab-pill-item active");

        });

        $(document).on('click','.collapse-btn',function (){

            let angle = $(this).children().last();
            let angle_class = angle.attr('class');

            if (angle_class.includes("fa-angle-left")){
                angle.replaceWith('<i class="fas fa-angle-down"></i>');
            }else{
                angle.replaceWith('<i class="fas fa-angle-left"></i>');
            }

        });

        // CHECK AUTH USER SESSION
        // var is_session_cleared = 0;
        // var AuthSessionInterval = setInterval(function () {

        //   if (is_session_cleared == 0) {

        //     $.ajax({
        //       'url':'{{ route("check_user_session") }}',
        //       'method':'POST',
        //       'data':{
        //         _token:$('meta[name="csrf-token"]').attr('content')
        //       },
        //       success: function (response){
        //         if (response.data == 1) {
        //           is_session_cleared = 1;
        //           clearInterval(AuthSessionInterval);
        //           location.reload();
        //         }
        //       }
        //     });

        //   }

        // }, 3000);

        // // SIGN OUT IN-ACTIVE OR IDLE USER
        // var timeoutID;
        // function setup() {
        //     this.addEventListener("mousemove", resetTimer, false);
        //     this.addEventListener("mousedown", resetTimer, false);
        //     this.addEventListener("keypress", resetTimer, false);
        //     this.addEventListener("DOMMouseScroll", resetTimer, false);
        //     this.addEventListener("mousewheel", resetTimer, false);
        //     this.addEventListener("touchmove", resetTimer, false);
        //     this.addEventListener("MSPointerMove", resetTimer, false);

        //     startTimer();
        // }
        // setup();

        // function startTimer() {

        //   if (is_session_cleared == 0) {

        //     // GET SESSION IDLE TIME
        //     $.ajax({
        //       'url':'{{ route("get_session_idle_time") }}',
        //       'method':'POST',
        //       'data':{
        //         _token:$('meta[name="csrf-token"]').attr('content')
        //       },
        //       success: function (response){
        //         if (response.data) {
        //           let session_idle_time = response.data;
        //           if (session_idle_time !== 0) {
        //             timeoutID = window.setTimeout(goInactive, session_idle_time);
        //           }

        //         }
        //       }
        //     });

        //   }else{

        //     location.reload();

        //   }

        // }

        // function resetTimer(e) {
        //     window.clearTimeout(timeoutID);

        //     goActive();
        // }

        // function goInactive() {

        //     if (is_session_cleared == 0) {

        //       // TERMINATE USER SESSION
        //       $.ajax({
        //         'url':'{{ route("clear_user_session") }}',
        //         'method':'POST',
        //         'data':{
        //           _token:$('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function (response){
        //           if (response.data == 1) {
        //             is_session_cleared = 1;
        //             location.reload();
        //           }
        //         }
        //       });

        //     }

        // }

        // function goActive() {
        //     startTimer();
        // }

      });

    </script>
    @yield("js")

  </body>
</html>
