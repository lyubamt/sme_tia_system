
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>HAWAME|USER-INFOS</title>


  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/header.css')}}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/min/tiny-slider.js"></script>

   <!-- Leaflet Scripts-->
   <script src="{{ asset('map/libs/leaflet-src.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('map/libs/leaflet.css')}}">

  <script src="{{ asset('map/src/Leaflet.draw.js') }}"></script>
  <script src="{{ asset('map/src/Leaflet.Draw.Event.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('map/src/leaflet.draw.css')}}">

  <script src="{{ asset('map/src/Toolbar.js') }}"></script>
  <script src="{{ asset('map/src/Tooltip.js') }}"></script>

  <script src="{{ asset('map/src/ext/GeometryUtil.js') }}"></script>
  <script src="{{ asset('map/src/ext/LatLngUtil.js') }}"></script>
  <script src="{{ asset('map/src/ext/LineUtil.Intersect.js') }}"></script>
  <script src="{{ asset('map/src/ext/Polygon.Intersect.js') }}"></script>
  <script src="{{ asset('map/src/ext/Polyline.Intersect.js') }}"></script>
  <script src="{{ asset('map/src/ext/TouchEvents.js') }}"></script>

  <script src="{{ asset('map/src/draw/DrawToolbar.js') }}"></script>
  <script src="{{ asset('map/src/draw/handler/Draw.Feature.js') }}"></script>
  <script src="{{ asset('map/src/draw/handler/Draw.SimpleShape.js') }}"></script>
  <script src="{{ asset('map/src/draw/handler/Draw.Polyline.js') }}"></script>
  <script src="{{ asset('map/src/draw/handler/Draw.Marker.js') }}"></script>
  <script src="{{ asset('map/src/draw/handler/Draw.Circle.js') }}"></script>
  <script src="{{ asset('map/src/draw/handler/Draw.CircleMarker.js') }}"></script>
  <script src="{{ asset('map/src/draw/handler/Draw.Polygon.js') }}"></script>
  <script src="{{ asset('map/src/draw/handler/Draw.Rectangle.js') }}"></script>


  <script src="{{ asset('map/src/edit/EditToolbar.js') }}"></script>
  <script src="{{ asset('map/src/edit/handler/EditToolbar.Edit.js') }}"></script>
  <script src="{{ asset('map/src/edit/handler/EditToolbar.Delete.js') }}"></script>

  <script src="{{ asset('map/src/Control.Draw.js') }}"></script>

  <script src="{{ asset('map/src/edit/handler/Edit.Poly.js') }}"></script>
  <script src="{{ asset('map/src/edit/handler/Edit.SimpleShape.js') }}"></script>
  <script src="{{ asset('map/src/edit/handler/Edit.Rectangle.js') }}"></script>
  <script src="{{ asset('map/src/edit/handler/Edit.Marker.js') }}"></script>
  <script src="{{ asset('map/src/edit/handler/Edit.CircleMarker.js') }}"></script>
  <script src="{{ asset('map/src/edit/handler/Edit.Circle.js') }}"></script>

  <link rel="stylesheet" href="{{ asset('map/style.css') }}">



  @yield('css')
  @yield('datatable_css')

  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/tiny-slider.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.helper.ie8.js">
</head>

<body class="hold-transition sidebar-mini">
<!-- <div id="app"> -->
<div id="app">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

  @include('includes.sidebar')

  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">



                <!-- Main Content -->

                   @yield('content')

                <!-- /.Main Content -->


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<!-- footer -->
  @include('includes.footer')
  <!-- /.footer -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('js/app.js')}}"></script>

@yield('js')
@yield('select2js')

</body>
</html>
