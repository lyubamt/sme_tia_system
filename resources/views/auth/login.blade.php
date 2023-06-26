@extends('auth_layout.index')

@section("css")

<style>
	#login-title{
		color: #adaaa1;
		font-weight: 600;
		font-family: Arial, Helvetica, sans-serif;
		margin-bottom: 40px;
	}

	.input-text{
		box-sizing: border-box;
		font-size:22px;
		font-family: Arial, Helvetica, sans-serif;
		height: 50px;
		border:0;
		border-radius:10px;
  	box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
	}
	.input-text:active{
		outline:none !important;
		font-size:22px !important;
		font-family: Arial, Helvetica, sans-serif !important;
		height: 50px !important;
		border:0;
		border-radius:10px;
  	box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
	}
	.input-select{
		box-sizing: border-box;
		height: 50px !important;
		font-size:22px !important;
		font-family: Arial, Helvetica, sans-serif !important;
		border: 0;
		border-radius:10px;
		box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
	}

	input:-webkit-autofill,
	input:-webkit-autofill:hover,
	input:-webkit-autofill:focus,
	input:-webkit-autofill::first-line {
	  /* border: 1px solid green; */
		font-size:22px!important;
	  /* -webkit-text-fill-color: inherit;
	  -webkit-box-shadow: 0 0 0px 1000px #000 inset;
	  transition: background-color 5000s ease-in-out 0s; */
	}

	#recaptcha{
		display: none;
		box-sizing: border-box;
		width: 360;
		height: 130;
		padding: 15px;
		background-color: #fcba03;
		font-size: 30px;
		font-family: "Times New Roman", Times, serif;
	}
	#submit-btn{
		height: 50px;
		font-size:22px;
		font-family: Arial, Helvetica, sans-serif;
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
<div class="row">

	<div class="col-md-4"></div>

	<div class="col-md-4 text-center" style="padding: 30px 0px 0px 0px;">

		<div class="card text-left" style="border-radius: 30px;padding: 30px 20px 20px 20px;">

			<div class="text-center">
				<h2 id="login-title">SME</h2>
			</div>

			<!-- form start -->
			<form method="POST" action="{{ route('login_api') }}">
				@csrf

				<div class="form-group">
					<div class="col-md-12">
						<input class="form-control input-text" type="email" name="email" value="{{ old('email') }}" required placeholder="Username, email">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<input class="form-control input-text" type="password" name="password" id="password" value="{{ old('password') }}" required placeholder="Password">
						<i class="far fa-eye" id="password-toggle"></i>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<input type="submit" class="btn btn-primary form-control" value="Sign In" id="submit-btn">
					</div>
				</div>

			</form>

		</div>
		<!-- /.card -->

	</div>
	<!-- /.col-md-5  -->

	<div class="col-md-4"></div>

</div>
<!-- /.page-row  -->
@endsection
