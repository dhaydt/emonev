<!DOCTYPE html>
<html>
    
<head>
	<title>SIMONEV KOTA BUKITTINGGI</title>
	<!-- Required meta tags -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="shortcut icon" href="{{ asset('public/assets/img/logo.png') }}">

	<link href="{{asset('public/assets/slide.css')}}" rel="stylesheet">
	<link href="{{asset('public/assets/loginopd.css')}}" rel="stylesheet">

	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" crossorigin="anonymous"> -->
	<link href="{{ asset('public/template/color_admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
	
	<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
	<link href="{{ asset('public/template/color_admin/plugins/bootstrap/css/bootstrap4.min.css') }}" rel="stylesheet" />
	<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
	<script src="{{ asset('public/template/color_admin/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<script src="{{ asset('public/template/color_admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<!------ Include the above in your HEAD tag ---------->

</head>
<!--Coded with love by Mutiullah Samim-->
<body>
<ul class="slideshow">
  <li><span>Image 01</span><div><h3>SIMONEV</h3></div></li>
  <li><span>Image 02</span></li>
  <li><span>Image 03</span></li>
  <li><span>Image 04</span></li>
  <li><span>Image 05</span></li>
  <li><span>Image 06</span></li>
</ul>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container" style="width: 300px; height: 150px;">
						<img src="{{asset('public/assets/img/favicon.png')}}" class="brand_logo" alt="Logo" style="width: 125px; height: 125px;">
						<img src="{{asset('public/assets/img/lkb.png')}}" class="brand_logo" alt="Logo" style="width: 110px; height: 125px; padding-top: 3px;">
					</div>
				</div>

				<div class="d-flex justify-content-center form_container" style="margin-top:80px;">
					<form action="{{route('cekopd')}}" method="post" >
					@csrf
						@if ($message = Session::get('fail'))
							<div class="alert alert-danger" style="padding:0px;">
								<p>{{$message}}</p>
							</div>
						@endif
							<center>
							<h4 class="" style="color: white;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;"><b>T.A {{date('Y')}}</b></h4>
							</center>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-user"></i></span>
							</div>
							<input type="text" name="username" required class="form-control input_user" value="" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-lock"></i></span>
							</div>
							<input type="password" name="password"  required class="form-control input_pass" value="" placeholder="password">
						</div>

						<div class="row">
							<!--div class="col-md-6" style="padding-right: 5px">
								<a href='../' class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>&nbsp;
							</div-->
							<div class="col-md-12">
								<button type="submit" name="button" class="btn btn-success btn-block"><i class="fa fa-sign-in"></i>&nbsp;Login</button>
							</div>
						</div>
					</form>
				</div>

				
			</div>
		</div>
	</div>
</body>
</html>
