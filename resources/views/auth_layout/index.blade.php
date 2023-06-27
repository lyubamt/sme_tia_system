<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SME-Business System&nbsp;|&nbsp;LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The SME Business Management System">
    <meta name="X-UA-Compatible" content="ie=edge">
    <meta name="Content-Language" content="en-us">
    <meta name="keywords" content="TIA, Business, SME, Management System, Business System">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php

      $app_url = \Config::get('env.APP_URL');

    @endphp


    <!-- FONT AWESOME ICONS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!------MY CSS-->
  	<link rel="stylesheet" href="{{asset($app_url.'/css/app.css')}}">

    <!-- JQuery CDN -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
    <style>
      .footer, .footer-link, .footer-copy-right{
        color: #01579b;
      }
    </style>
    @yield('css')

</head>
<body id="site_translate" style="background-image:url( {{ url('/img/coa_blur.png') }} );background-position: center;background-repeat: no-repeat;background-size: contain;transition: background 300ms ease-in 200ms;">

    <div class="container-fluid">

      @yield('content')

      @include("includes.footer")

    </div>

    <script src="{{asset($app_url.'/js/app.js')}}"></script>
    <script>
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'},'site_translate')
      }
    </script>

    <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


    @yield('js')

</body>
</html>
