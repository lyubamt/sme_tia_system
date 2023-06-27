@extends('auth_layout.index')

@section("css")

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
	#login-title{
		color: #01579b;
		font-weight: 400;
		font-size: 24px;
		font-family: Arial, Helvetica, sans-serif;
		margin-top: 10px;
		margin-bottom: 10px;
	}

	.input-text{
		box-sizing: border-box !important;
		font-size:22px !important;
		font-family: Arial, Helvetica, sans-serif !important;
		height: 50px !important;
		border: 1px solid #007bff !important;
		border-radius:10px !important;
		/* box-shadow:0 0 15px 4px rgba(0,0,0,0.06); */
		margin-bottom: 15px !important;
	}
	.input-text:active{
		outline:none !important;
		font-size:22px !important;
		font-family: Arial, Helvetica, sans-serif !important;
		height: 50px !important;
		border:0 !important;
		border-radius:10px !important;
		box-shadow:0 0 15px 4px rgba(0,0,0,0.06) !important;
	}
	.input-select{
		box-sizing: border-box!important;
		height: 50px !important;
		font-size:22px !important;
		font-family: Arial, Helvetica, sans-serif !important;
		border: 0 !important;
		border-radius:10px !important;
		box-shadow:0 0 15px 4px rgba(0,0,0,0.06) !important;
	}

	input:-webkit-autofill,
	input:-webkit-autofill:hover,
	input:-webkit-autofill:focus,
	input:-webkit-autofill::first-line {
		font-size:22px!important;
	}

	.form-control:focus{
		border: 1px solid #007bff !important;
		outline-color: #007bff !important;
	}

	#submit-btn{
		height: 50px!important;
		font-size:22px!important;
		font-family: Arial, Helvetica, sans-serif!important;
		background-color: #01579B!important;
		border-radius: 15px!important;
		box-shadow:0 0 15px 4px rgba(0,0,0,0.06)!important;
		width: 100%!important;
		color: white;
	}
	#password-toggle{
		position: absolute;
		top: 32%;
		right: 9%;
		font-size: 23px;
		cursor: pointer;
		color: lightgray;
	}
	#password-toggle:hover{
		color: grey;
	}
	.forgot-password-link{
		text-align: center;
		text-decoration: none;
		color: #7732a8;
	}
	.forgot-password-link:hover{
		text-decoration: none;
		color: #adaaa1;
	}
	.tz-logo-section, .tia-logo-section{
		padding: 10px;
	}
	.form-container-column{
		padding: 9% 3% 0px 3%;
	}
	.login-card{
		border-radius: 30px;
		padding: 10px 10px 10px 10px;
	}
	@media only screen and (max-width: 992px)  {
		#login-slide{
			display: none;
		}
		.slider-column{
			display: none;
		}
		.form-column{
			width: 100%!important;
		}
	}
	.slider-image{
		width: 400px;
		height: 360px;
		border-radius: 30px 0px 0px 30px;
	}
	/* change transition duration to control the speed of fade effect */
	.carousel-item {
		transition: transform 2.6s ease-in-out;
	}

	.carousel-fade .active.carousel-item-start,
	.carousel-fade .active.carousel-item-end {
		transition: opacity 0s 2.6s;
	}
	.carousel-control-prev-icon, .carousel-control-next-icon {
		font-size: 100px!important; 
		margin-top: -50px!important;
		color: #fff!important;
	}

</style>

@endsection

@section('content')

@if ($errors->any())
<ul class="alert alert-danger">
	@foreach ($errors->all() as $error)
			<li>

				{{ $error }}

			</li>
	@endforeach
</ul>
@endif
<!-- page-row  -->

@php

	$app_url = \Config::get('env.APP_URL');

@endphp

<div class="row">

<div class="col-md-2"></div>

<div class="col-md-8 form-container-column text-center">

	<div class="card login-card text-left">

		<div class="row">

			<div class="col-md-6 slider-column">

				<div id="login-slide" class="carousel slide carousel-fade" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
						<img class="d-block w-100 slider-image" src="{{asset($app_url .'/img/login5.jpeg')}}" alt="First slide">
						</div>
						<div class="carousel-item">
						<img class="d-block w-100 slider-image" src="{{asset($app_url .'/img/login7.jpeg')}}" alt="Second slide">
						</div>
						<div class="carousel-item">
						<img class="d-block w-100 slider-image" src="{{asset($app_url .'/img/login9.jpeg')}}" alt="Third slide">
						</div>
						<div class="carousel-item">
						<img class="d-block w-100 slider-image" src="{{asset($app_url .'/img/login10.jpeg')}}" alt="Third slide">
						</div>
						<div class="carousel-item">
						<img class="d-block w-100 slider-image" src="{{asset($app_url .'/img/login11.jpeg')}}" alt="Third slide">
						</div>
					</div>
					<a class="carousel-control-prev" href="#login-slide" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#login-slide" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

			</div>

			<div class="col-md-6 form-column">

				<div class="text-center">

					<img src="{{asset($app_url .'/img/new_tia.png')}}" alt="TIA LOGO" style="width: 150px;height: 92px;">
					<h2 id="login-title">SME <b style="color: black;">Business System</b></h2>

				</div>

				<!-- form start -->
				<form method="POST" action="{{ route('login_api') }}">
				{{ csrf_field() }}

					<div class="form-group">
						<div class="col-md-12">
							<input class="form-control input-text" type="email" name="email" required placeholder="Username">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<input class="form-control input-text" type="password" name="password" id="password" required placeholder="Password">
							<i class="far fa-eye" id="password-toggle"></i>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<input type="submit" class="btn btn-info" value="Log In" id="submit-btn">
						</div>
					</div>

				</form>

				<div class="text-center">
					<h6>Dont have an account?<a href="{{ route('register') }}" class="text-decoration-none">register here</a></h6>
				
				</div>

			</div>

		</div>
		<!-- /.row  -->

	</div>
	<!-- /.card -->

</div>
<!-- /.col-md-5  -->

<div class="col-md-2"></div>

</div>
<!-- /.page-row  -->
@endsection

@section("js")


<script src="{{asset('js/app.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

	<script>
		$(document).ready(function (){
			$(document).on("click","#password-toggle",function (){

				let type = $("#password").attr("type") == "password" ? "text":"password";
				$("#password").attr("type",type);
				let toggler_class =$(this).attr("class") == "far fa-eye" ? "far fa-eye-slash":"far fa-eye";
				$(this).attr("class",toggler_class);

			});
		});
	</script>

@endsection
