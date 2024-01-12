@extends('layouts.template')

@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>OPD</li>
    <li class="active">Tambah</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Tambah OPD <small></small></h3>
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
            <h4 class="panel-title">Form Input OPD</h4>
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
					<form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('data-opd.store')}}" @endif>
						@csrf
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Kode Unit:</label>
					      <div class="col-sm-2">
					        <input type="text" class="form-control" name="kdunit" placeholder="kode unit">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">UnitKey:</label>
					      <div class="col-sm-2">
							    <input type="text" class="form-control" name="unit_key" placeholder="unitkey">	
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Kode Level:</label>
					      <div class="col-sm-1">
							    <select class="form-control" name="kdlevel">
							    	<option>3</option>
							    	<option>4</option>
							    </select>	
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Tipe:</label>
					      <div class="col-sm-1">
							    <input type="text" class="form-control" name="tipe" placeholder="tipe">	
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Nama Instansi:</label>
					      <div class="col-sm-5">
							    <input type="text" class="form-control" name="nm_instansi" placeholder="nama instansi">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Jenis Pimpinan:</label>
					      <div class="col-sm-2">
					      		<select name="pimpinan" class="form-control" >
					      			<option value="KEPALA">KEPALA</option>
					      			<option value="DIREKTUR">DIREKTUR</option>
					      		</select>
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Kepala Instansi:</label>
					      <div class="col-sm-5">
							    <input type="text" class="form-control" name="kepala" placeholder="kepala instansi">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">NIP:</label>
					      <div class="col-sm-3">
							    <input type="text" class="form-control" name="nip" placeholder="NIP Kepala Instansi" value="">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Sigkatan:</label>
					      <div class="col-sm-4">
							    <input type="text" class="form-control" name="singkatan" placeholder="Singkatan" value="">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Akrounit:</label>
					      <div class="col-sm-4">
							    <input type="text" class="form-control" name="akrounit" placeholder="Akrounit" value="">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Nomor Telepon:</label>
					      <div class="col-sm-4">
							    <input type="text" class="form-control" name="telp" placeholder="Nomor Telepon" value="">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Alamat:</label>
					      <div class="col-sm-5">
							    <textarea class="form-control" name="alamat"></textarea>
					      </div>
					  </div>

					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Non Urusan:</label>
					      <div class="col-sm-4">
							    <input type="radio" name="non_urusan" value="1" checked>Ada 
							    <input type="radio" name="non_urusan" value="0">Tidak Ada
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
