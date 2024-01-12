<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>SIMONEV Dokumen Perencanaan Kota</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ asset('public/assets/img/logo.png') }}">

	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
	<link href="{{ asset('public/template/color_admin/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/template/color_admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/template/color_admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/template/color_admin/css/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/template/color_admin/css/style.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/template/color_admin/css/style-responsive.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/template/color_admin/css/theme/default.css') }}" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{ asset('public/template/color_admin/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/template/color_admin/plugins/DataTables/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/template/color_admin/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('public/template/color_admin/plugins/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script src="{{ asset('public/template/color_admin/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('public/template/color_admin/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
	<script src="{{ asset('public/template/color_admin/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
	
	<script src="{{ asset('public/template/color_admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!--<script>
	alert('Database sedang perbaikan, Belum bisa untuk menyimpan data, tetapi masih bisa untuk melihat data Renja, Data baru bisa di entry kan mulai tanggal 23 Mei 2019');
</script>-->
	
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
				<div id="header" class="header navbar navbar-default navbar-fixed-top">
					<!-- begin container-fluid -->
					<div class="container-fluid">
						<!-- begin mobile sidebar expand / collapse button -->
						<div class="navbar-header">
							<span class="navbar-logo"><img src="{{ asset('public/assets/img/sumbar.png') }}" alt="logo" height="30px"> <img src="{{ asset('public/assets/img/lkb.png') }}" alt="logo" height="30px"></span>
							
							<a href="#" class="navbar-brand hidden-xs">
							SIMONEV Dokumen Perencanaan Kota
							</a>
							<a href="#" class="navbar-brand hidden-lg hidden-sm hidden-md ">
							SIMONEV
							</a>
							<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- end mobile sidebar expand / collapse button -->
						
						<!-- begin header navigation right -->
						<ul class="nav navbar-nav navbar-right">

							<li class="dropdown">
								<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
									<i class="fa fa-bell-o"></i>
									<!-- <span class="label">0</span> -->
								</a>
								<ul class="dropdown-menu media-list pull-right animated fadeInDown">
		                            <li class="dropdown-header">Notifications (0)</li>
		                            <!-- <li class="media">
		                                <a href="javascript:;">
		                                    <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
		                                    <div class="media-body">
		                                        <h6 class="media-heading">Server Error Reports</h6>
		                                        <div class="text-muted f-s-11">3 minutes ago</div>
		                                    </div>
		                                </a>
		                            </li> -->
		                            <li class="dropdown-footer text-center">
		                                <a href="javascript:;">View more</a>
		                            </li>
								</ul>
							</li>
							<li class="dropdown navbar-user">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
									<img src="{{ asset('public/assets/img/jg.jpg') }}" alt="" /> 
									<span class="hidden-xs">
										@php
				                           if (Auth::guard('web')->check()) {
				                        @endphp
										{{Auth::user()->username}}
										@php
											}elseif (Auth::guard('opd')->check()) {
											@endphp
											{{Auth::guard('opd')->user()->username}}
											@php
											}
										@endphp
									</span> <b class="caret"></b>
								</a>
								<ul class="dropdown-menu animated fadeInLeft">
									<li class="arrow"></li>
									<li><a href="{{ route('profil.index') }}">Edit Profile</a></li>
									<li><a href="@if(Auth::guard('web')->check()) javascript:; @else {{route('akun-opd.edit', Auth::guard('opd')->user()->id)}} @endif">Setting</a></li>
									<li class="divider"></li>
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> {{ __('Logout') }}</a> 
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        	</form>
									</li>
								</ul>
							</li>
						</ul>
						<!-- end header navigation right -->
					</div>
					<!-- end container-fluid -->
				</div>
				<!-- end #header -->
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="javascript:;"><img src="{{ asset('public/assets/img/jg.jpg') }}" alt="" /></a>
						</div>
						<div class="info">
							@php
	                           if (Auth::guard('web')->check()) {
	                        @endphp
							{{Auth::user()->username}}<small>Administrator</small>
							@php
								}elseif(Auth::guard('opd')->check()) {
								@endphp
								{{Auth::guard('opd')->user()->username}} <small>OPD</small>
								@php
								}
							@endphp
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<li class="{{ Route::is('opd') ? 'active' : ''}} {{ Route::is('home') ? 'active' : ''}}">
						<a href="{{ url('/') }}"><i class="fa fa-laptop"></i><span>Dashboard</span></a>
					</li>
					@php
                       if (Auth::guard('web')->check()) {
                    @endphp
                    @if(@Auth::user()->level!='Bidang')
					<li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-list-alt"></i> <span>Data Master</span></a>
						<ul class="sub-menu">
							<li><a href="{{ route('periode_rpjmd.index') }}">Periode RPJMD</a> </li>
							<li><a href="{{ route('periode_renja.index') }}">Periode Renja</a> </li>
							<li><a href="{{ route('urusan') }}">Urusan</a> </li>
							<li><a href="{{ route('bidang_urusan.index') }}">Bidang Urusan</a> </li>
							<li><a href="{{ route('data-opd.index') }}">OPD</a> </li>
							<li><a href="{{ route('program.index') }}">Program</a></li>
							<li><a href="{{ route('master-kegiatan') }}">Kegiatan</a></li>
							<li><a href="{{ route('mastersubkegiatan.index') }}">Sub Kegiatan</a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-user"></i> <span>Akun</span></a>
						<ul class="sub-menu">
							<li><a href="{{ route('akun-opd.index') }}">Akun OPD</a> </li>
							<li><a href="{{ route('akun-adm.index') }}">Akun User</a> </li>
							<li><a href="{{ route('log_user') }}">Log User</a> </li>
						</ul>
					</li>
<!-- 					<li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-list"></i> <span>Data</span></a>
						<ul class="sub-menu">
							<li><a href="{{ route('urusan-opd.index') }}">Urusan OPD</a> </li>
							<li><a href="{{ route('rpjmd.index') }}">RPJMD</a> </li>
							<li><a href="{{ route('renstra.index') }}">Rentra</a> </li>
							<li><a href="{{ route('data-renja.index') }}">RKPD Awal</a> </li>
							<li><a href="{{ url('/data-renja?data_renja=perubahan') }}">RKPD Perubahan</a> </li>
						</ul>
					</li> -->
					<li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-list"></i> <span>Dokumen</span></a>
						<ul class="sub-menu">
							<li><a href="{{ route('data-rkpd.index') }}">RKPD Awal</a> </li>
							<li><a href="{{ url('/data-rkpd?data_renja=perubahan') }}">RKPD Perubahan</a> </li>
						</ul>
					</li>
					<li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-book"></i> <span>Evaluasi</span></a>
						<ul class="sub-menu">
							<li><a href="{{ route('evaluasi-renja.index') }}">Evaluasi RKPD Awal</span></a></li>
							<li><a href="{{ url('/evaluasi-renja?data_renja=perubahan') }}">Evaluasi RKPD Perubahan</span></a></li>
						</ul>
					</li>
					@endif
					<!-- 
					
					<li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-files-o"></i> <span>APBD >< RKPD</span></a>
						<ul class="sub-menu">
							<li><a href="{{ url('/persandingan-apbd-rkpd') }}"><span>APBD Awal</span></a></li>
							<li><a href="#"><span>APBD Perubahan</span></a></li>
						</ul>
					</li>
					<li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-laptop"></i> <span>Monitoring Evaluasi</span></a>
						<ul class="sub-menu">
							<li><a href="{{ url('/monitoring_evaluasi_rkpd') }}"><span>RKPD awal</span></a></li>
							<li><a href="{{ url('/monitoring_evaluasi_rkpd?data_renja=perubahan') }}"><span>RKPD Perubahan</span></a></li>
						</ul>
					</li>
		
					<li>
						<a href="{{ url('/sdgs') }}"><i class="fa fa-file-text-o"></i><span>Data SDGs</span></a>
					</li>
					-->

					@if(@Auth::user()->level=='Super Admin')
					<li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-cogs"></i> <span>Settings</span></a>
						<ul class="sub-menu">
							<li><a href="{{ route('settings_triwulan.index') }}">Realisasi Triwulan</span></a></li>
							<li><a href="/2022/setrules">Rule</span></a></li>
						</ul>
					</li>
					@endif 
					@if(@Auth::user()->level=='Super Admin')
					<!-- <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-clone"></i> <span>Impor & Ekspor</span></a>
						<ul class="sub-menu">
							<li><a href="{{  url('/import?tbl=dafunit') }}">Dafunit</span></a></li>
							<li><a href="{{  url('/import?tbl=data_opd') }}">Data OPD</span></a></li>
							<li><a href="{{  url('/import?tbl=program') }}">Master Program</span></a></li>
							<li><a href="{{  url('/import?tbl=kegiatan') }}">Master Kegiatan</span></a></li>
							<li><a href="{{  url('/import?tbl=urusan_opd') }}">Urusan OPD</span></a></li>
							<li><a href="{{  url('/import?tbl=rpjmd_prog') }}">RPJMD Program OPD</span></a></li>
							<li><a href="{{  url('/import?tbl=rpjmd_prog_indikator') }}">RPJMD Program Indikator</span></a></li>
							<li><a href="{{  url('/import?tbl=renja') }}">Renja</span></a></li>
							<li><a href="{{  url('/import?tbl=renja_indikator') }}">Renja Indikator (Output)</span></a></li>
							<li><a href="{{  url('/import?tbl=renja_indikator_det') }}">Renja Indikator Det (Output)</span></a></li>
							<li><a href="{{  url('/import?tbl=renja_per') }}">Renja Perubahan</span></a></li>
							<li><a href="{{  url('/import?tbl=renja_indikator_per') }}">Renja Indikator Perubahan</span></a></li>
							<li><a href="{{  url('/import?tbl=realisasi') }}">Realisasi Kegiatan</span></a></li>
						</ul>
					</li> -->
					@endif
					@php
						}elseif (Auth::guard('opd')->check()) {
					@endphp
					<li class="has-sub {{ Route::is('data-rkpd.index') ? 'active' : ''}}"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-list"></i> <span>Data Renja</span></a>
						<ul class="sub-menu">
							<li class="#{{ Route::is('data-rkpd.index') ? 'active' : ''}}"><a href="{{ url('/data-rkpd?data_renja=awal') }}">Renja Awal</a> </li>
							<li><a href="{{ url('/data-rkpd?data_renja=perubahan') }}">Renja Perubahan</a> </li>
						</ul>
					</li>
					<li class="has-sub {{ Route::is('evaluasi-renja.index') ? 'active' : ''}}"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-book"></i> <span>Evaluasi Renja</span></a>
						<ul class="sub-menu">
							<li class="#{{ Route::is('evaluasi-renja.index') ? 'active' : ''}}"><a href="{{ route('evaluasi-renja.index') }}" title="Evaluasi Renja"> <span>Evaluasi Renja Awal</span></a></li>
							<li class="#"><a href="{{ url('/evaluasi-renja?periode=2022&pilih_triwulan=4&data_renja=perubahan') }}" title="Evaluasi Renja"><span>Evaluasi Renja Perubahan</span></a></li>
						</ul>
					</li>

					<!-- <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-laptop"></i> <span>Monitoring Evaluasi</span></a>
						<ul class="sub-menu">
							<li><a href="{{ url('/monitoring_evaluasi_rkpd') }}"><span>Renja awal</span></a></li>
							<li><a href="{{ url('/monitoring_evaluasi_rkpd?data_renja=perubahan') }}"><span>Renja Perubahan</span></a></li>
						</ul>
					</li> -->			
					@php
						}
					@endphp
			        
			        @if(@Auth::user()->level=='Bidang')
			        <li class="has-sub {{ Route::is('evaluasi-renja.index') ? 'active' : ''}}"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-book"></i> <span>Evaluasi Renja</span></a>
			        	<ul class="sub-menu">
			        		<li class="#{{ Route::is('evaluasi-renja.index') ? 'active' : ''}}"><a href="{{ route('evaluasi-renja.index') }}" title="Evaluasi Renja"> <span>Evaluasi Renja Awal</span></a></li>
			        		<li class="#"><a href="{{ url('/evaluasi-renja?periode=2022&pilih_triwulan=4&data_renja=perubahan') }}" title="Evaluasi Renja"><span>Evaluasi Renja Perubahan</span></a></li>
			        	</ul>
			        </li>
			        @endif
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			@yield('content')

		</div>
		<!-- end #content -->
		
		<center>Lama Render{{ number_format((microtime(true) - LARAVEL_START),2) }} Detik</center>
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success bg-red btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	

	
	<script src="{{ asset('public/template/color_admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!-- <script src="{{ asset('public/template/color_admin/plugins/jquery-cookie/jquery.cookie.js') }}"></script> -->
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{ asset('public/template/color_admin/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('public/template/color_admin/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/template/color_admin/plugins/DataTables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js') }}"></script>
	<script src="{{ asset('public/template/color_admin/plugins/DataTables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js') }}"></script>
	<script src="{{ asset('public/template/color_admin/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
	
	<script src="{{ asset('public/template/color_admin/js/table-manage-fixed-header.demo.min.js') }}"></script>
	<script src="{{ asset('public/template/color_admin/js/apps.min.js') }}"></script>

	<!-- <script src="https://cdn.datatables.net/plug-ins/1.10.19/features/pageResize/dataTables.pageResize.min.js"></script> -->
	
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			var table = $('.data-table2').DataTable( {
			        fixedHeader: true
			    } );
			App.init();
			TableManageFixedHeader.init();
		});
	</script>
<!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');

</script> -->

</body>
</html>
