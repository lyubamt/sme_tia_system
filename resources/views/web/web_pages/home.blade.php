@extends('web.layouts.master_thunder')

@section("page-title")
Deliver Your Product
@endsection

@section("css")

<style>

	.page-wrapper{
		position: fixed;
		width: 100%;
		height: 100%;
		z-index: -1;
		padding: 3%;
	}

	#site-name{
		position: fixed;
		top: 3%;
		left: 40%;
		color: black;
		font-size: 2em;
		z-index: 4353433425246343537;
	}

	#main-menu-toggler-btn{
		position: fixed;
		top: 3%;
		left: 92%;
		background: #ffff;
		color: #0070E6;
		font-size: 2em;
		min-width: 50px;
		min-height: 50px;
		border-radius: 30px;
		z-index: 4353433425246343537;
	}

	#account-toggler-btn{
		position: fixed;
		top: 14%;
		left: 92%;
		background: #a832a0;
		color: white;
		font-size: 2em;
		min-width: 50px;
		min-height: 50px;
		border-radius: 30px;
		z-index: 4353433425246343537;
	}

	#package-track-toggler-btn{
		position: fixed;
		top: 25%;
		left: 92%;
		background: #EC407A;
		color: white;
		font-size: 2em;
		min-width: 50px;
		min-height: 50px;
		border-radius: 30px;
		z-index: 4353433425246343537;
	}

	#more-info-toggler-btn{
		position: fixed;
		top: 36%;
		left: 92%;
		/* background: red; */
		color: white;
		font-size: 2em;
		min-width: 50px;
		min-height: 50px;
		border-radius: 30px;
		z-index: 4353433425246343537;
	}

	.make-shipping-order-container{
		background-color: #ffff;
		position: fixed;
		top: 77%;
		left: 5%;
		min-width: 90%;
		border-radius: 26px;
		z-index: 4353433425246343537;
	}

	#search-pickup-dropoff{
		height: 56px;
		padding: 0px 0px 0px 15px;
		margin: 0px;
	}

	.make-shipping-order-action-btn{
		margin: 10px 10px 10px 23px;
	}

</style>

@endsection

@section('content')

	<div class="page-wrapper" id="map" >

		<div class="card" id="site-name-box">
			<h1 id="site-name">Thunder Truck Movers
			</h1>
		</div>

		<a class="btn btn-primary" id="main-menu-toggler-btn">
				<span class="fas fa-sliders-h"></span>
		</a>

		<a class="btn btn-primary" id="account-toggler-btn">
				<span class="fas fa-user-alt"></span>
		</a>

		<a class="btn btn-primary" id="package-track-toggler-btn">
				<span class="fas fa-map-marker-alt"></span>
		</a>

		<a class="btn btn-info" id="more-info-toggler-btn">
				<span class="fas fa-info"></span>
		</a>


		<div class="make-shipping-order-container">

			<div class="row">
				<div class="col-md-3">
					<input class="form-control" id="search-pickup-dropoff" type="text" name="" placeholder="Where is your item?">
				</div>
				<div class="col-md-3">
					<input class="form-control" id="search-pickup-dropoff" type="text" name="" placeholder="Where is your pick up location?">
				</div>

				<div class="col-md-2">
					<span class="fas fa-search fa-3x make-shipping-order-action-btn"></span>
				</div>

			</div>

		</div>

	</div>

@endsection


@section("js")

<script type="text/javascript">

var all_polylines = [];
    var x = "The Location for your storage has not been set!";
    var startlat = -6.3690;
    var startlon = 34.8888;

    var options = {
     center: [startlat, startlon],
     zoomSnap: 0.5,
     zoom: 6
    }

    var map = L.map('map', options);
    var nzoom = 12;

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OSM'}).addTo(map);

</script>

@endsection
