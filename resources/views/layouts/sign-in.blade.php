<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>SIMONEV DokRenDa</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ asset('public/assets/img/logo.png') }}">


<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="{{ asset('public/template/color_admin/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/template/color_admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/template/color_admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/template/color_admin/css/animate.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/template/color_admin/css/style.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/template/color_admin/css/style-responsive.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/template/color_admin/css/theme/default.css') }}" rel="stylesheet" id="theme" />
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('public/template/color_admin/plugins/pace/pace.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->


</head> 
   
 <body class="pace-top bg-white">
    
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    	
    <div id="page-container" class="fade">
    	@yield('content')
   	</div>
	
		<!-- ================== BEGIN BASE JS ================== -->
		<script src="{{ asset('public/template/color_admin/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
		<script src="{{ asset('public/template/color_admin/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
		<script src="{{ asset('public/template/color_admin/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
		<script src="{{ asset('public/template/color_admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
		<!--[if lt IE 9]>
			<script src="{{ asset('public/template/color_admin/crossbrowserjs/html5shiv.js') }}"></script>
			<script src="{{ asset('public/template/color_admin/crossbrowserjs/respond.min.js') }}"></script>
			<script src="{{ asset('public/template/color_admin/crossbrowserjs/excanvas.min.js') }}"></script>
		<![endif]-->
		<script src="{{ asset('public/template/color_admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
		<script src="{{ asset('public/template/color_admin/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
		<!-- ================== END BASE JS ================== -->
		
		<!-- ================== BEGIN PAGE LEVEL JS ================== -->
		<script src="{{ asset('public/template/color_admin/js/apps.min.js') }}"></script>
		<!-- ================== END PAGE LEVEL JS ================== -->

		<script>
			$(document).ready(function() {
				App.init();
			});
		</script>

</body>
</html>