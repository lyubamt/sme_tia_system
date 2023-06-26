<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SME&nbsp;|&nbsp;LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    @yield('css')

</head>
<body>

    <div class="container-fluid">

      @yield('content')

    </div>

    <script src="{{asset($app_url.'/js/app.js')}}"></script>

    @yield('js')

</body>
</html>
