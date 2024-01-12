@extends('layouts.template')

@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Akun OPD</li>
    <li class="active">Tambah</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Tambah Akun OPD <small></small></h3>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12">
    
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title">Form Input Akun OPD</h4>
        </div>
        <div class="panel-body">

   						@if ($message = Session::get('fail'))
							<div class="alert alert-danger" style="padding:0px;">
								<p>{{$message}}</p>
							</div>
						@endif

						<ul>
						@foreach($errors->all() as $error)
							<li class="alert alert-danger">{{$error}}</li>
						@endforeach
						</ul>
						<link href="{{ asset('public/template/color_admin/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
						
					<form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('akun-opd.store')}}" @endif>
						@csrf
					  <div class="form-group">
					      <label class="control-label col-sm-3" for="kdunit">Nama OPD:</label>
					      <div class="col-sm-8">
					      		<select name="id_instansi" class="form-control" id="sel">
					      			@foreach($data as $p)
						      			<option value="{{$p->id}}">{{$p->nm_instansi}}</option>
					      			@endforeach
					      		</select>
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-3" for="kdunit">Username:</label>
					      <div class="col-sm-4">
							    <input type="text" class="form-control" name="username" placeholder="username">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-3" for="kdunit">Password:</label>
					      <div class="col-sm-4">
							    <input type="password" class="form-control" name="password" placeholder="password">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-3" for="kdunit">Email:</label>
					      <div class="col-sm-4">
							    <input type="email" class="form-control" name="email" placeholder="email">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-3" for="kdunit">NIP:</label>
					      <div class="col-sm-4">
							    <input type="text" class="form-control" name="nip" placeholder="nomor induk Pegawai">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-3" for="kdunit">Nama Pegawai:</label>
					      <div class="col-sm-4">
							    <input type="text" class="form-control" name="nm_pegawai" placeholder="nama Pegawai">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-3" for="kdunit">Status:</label>
					      <div class="col-sm-3">
							    <input type="radio" name="status" value="1" checked>Aktif &nbsp;
							    <input type="radio" name="status" value="2">Tidak Aktif
					      </div>
					  </div>

					  <div class="form-group"> 
					    <div class="col-sm-offset-3 col-sm-8">
					      <button type="submit" class="btn btn-primary">Simpan</button>
					    </div>
					  </div>

					</form>			
</div>

<script src="{{ asset('public/template/color_admin/plugins/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sel').select2();
    });
</script>

@endsection
