<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register your SME&nbsp;|&nbsp;Choose Options</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- FONT AWESOME ICONS -->
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <!-- JQuery CDN -->
    <link rel="stylesheet" href="{{asset($app_url.'/css/app.css')}}">
    <link rel="stylesheet" href="{{asset($app_url.'/css/header.css')}}">

    <link rel="stylesheet" href="{{ asset($app_url.'/map/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

    <style>
		
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

      .medium-size-radio-btn{
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
        transform: scale(1.5);
      }

      .nav-pills .nav-item.nav-link, .nav-pills .nav-link{
          background: #fff !important;
          color: black;
          border-radius: 0px;
      }

      .nav-pills .nav-item.nav-link, .nav-pills .nav-link:hover{
          background: #fff !important;
          color: #0F7E77;
          border-radius: 0px;
      }

      .nav-pills .nav-item.show .nav-link, .nav-pills .nav-link.active{
          background: #fff !important;
          color: #0F7E77;
          border-radius: 0px;
          border-bottom: 5px solid #0F7E77;
      }
      .tab-pane{
          padding: 3% 0px 0px 0px;
      }

      .margin-0{
          margin: 0px;
      }
      .padding-0{
          padding: 0px;
      }

      /* BILL STYLE  */
      .text-decoration-none{
        text-decoration: none;
      }

      .text-align-center{
          text-align: center;
      }
      .text-align-right{
          text-align: right;
      }
      .text-float-right{
          float: right;
      }
      .text-float-left{
          float: left;
      }
      .text-blue{
          color: blue;
      }
      .text-grey{
          color: grey;
      }
      h6,h5,h4,h3,p,b,code,small {
          font-family: Arial, Helvetica, sans-serif;
      }
      .content-wrapper{
          width: auto;
          border: 1px solid black;
          padding: 0px 2% 30px 2%;
          margin: 0px 2% 0px 2%;
      }
      @media screen and (max-width: 657px){
          .content-wrapper{
          width: auto;
          padding: 0px 1% 30px 1%;
          margin: 0%;
          overflow: auto;
          }
      }

    </style>

    @yield('css')

</head>
<body id="site_translate" style="background:url( {{ url('/img/coa_blur.png') }} ), #fff;background-position: center;background-repeat: no-repeat;background-size: contain;">


@php

	$app_url = \Config::get('env.APP_URL');

@endphp

    <div class="row  margin-0 padding-0">

        <div class="col-md-12 margin-0 welcome-word-section text-center">

            @yield('content')
            
        </div>

        <div class="col-md-12 text-center">

            <!-- <p class="rights" style="font-size: 26px;"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span><a href="{{ url('/') }}" style="color: purple;">Small & Medium Enterprise (SME)</a></span><span>.&nbsp;</span><span>All Rights Reserved.</span><span>&nbsp;</span></p> -->

        </div>
        <!-- /. row- 12 -->

    </div>

	<script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset($app_url.'/js/app.js')}}"></script>
    <!--
    <script>
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'},'site_translate')
      }
    </script>

    <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
   -->
    @yield('js')

</body>
</html>