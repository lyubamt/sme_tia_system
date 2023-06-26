<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thunder Truck Movers | @yield("page-title")</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/5.0.14/highcharts.src.js"></script>
    <script src="https://code.highcharts.com/5.0.14/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/5.0.14/modules/offline-exporting.js"></script>
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

    <style>
      .container-fluid{
        padding: 0px;
        margin: 0px;
      }
    </style>

    @yield('css')

  </head>
  <body>

    <div class="container-fluid">
      @yield('content')
    </div>

    <!-- jQuery -->
    <script src="{{asset('js/app.js')}}"></script>

    @yield('js')

  </body>
</html>
