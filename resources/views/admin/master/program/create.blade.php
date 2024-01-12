@extends('layouts.template')

@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Master Program</li>
    <li class="active">Tambah</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Tambah Program <small></small></h3>
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
            <h4 class="panel-title">Form Input Program</h4>
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
					<form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('program.store')}}" @endif>
						@csrf
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">ID Program:</label>
					      <div class="col-sm-5">
							    <input type="text" class="form-control" name="id" value="{{$idprgrm}}" placeholder="nama program">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Nama Program:</label>
					      <div class="col-sm-5">
							    <input type="text" class="form-control" name="nmprgrm" placeholder="nama program">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Status:</label>
					      <div class="col-sm-5">
							    <input type="radio" value='1' name="id_status" checked>Aktif
							    <input type="radio" value='2' name="id_status">Tidak Aktif
					      </div>
					  </div>
					    <div class="form-group">
					        <label class="control-label col-sm-4" for="kdunit">Non Urusan:</label>
					        <div class="col-sm-4">
					  		    <input type="radio" name="non_urusan" value="1" checked>Ya 
					  		    <input type="radio" name="non_urusan" value="0">Tidak
					        </div>
					    </div>
					  <div class="form-group"> 
					    <div class="col-sm-offset-4 col-sm-8">
					      <button type="submit" class="btn btn-primary">Simpan</button>
					    </div>
					  </div>

					</form>			
</div>

@endsection
