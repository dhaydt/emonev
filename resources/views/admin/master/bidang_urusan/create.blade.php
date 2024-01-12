@extends('layouts.template')

@section('content')
<!-- datatables customselect -->

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Bidang Urusan</li>
    <li class="active">Tambah</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Tambah Bidang Urusan <small></small></h3>
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
            <h4 class="panel-title">Bidang Urusan</h4>
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
					<form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('bidang_urusan.store')}}" @endif>
						@csrf
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Urusan:</label>
					      <div class="col-sm-4">
					      		<select id="urusan" name="id_urusan" class="form-control" required>
					      			@foreach($urusan as $vu)
					      			<option value="{{$vu->id}}">{{$vu->nm_unit}}</option>
					      			@endforeach
					      		</select>
					      </div>
					  </div>
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
					      <label class="control-label col-sm-4" for="kdunit">Bidang Urusan:</label>
					      <div class="col-sm-6">
							    <input type="text" class="form-control" name="nm_burusan" placeholder="nama urusan" value="">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Tipe:</label>
					      <div class="col-sm-1">
							    <select class="form-control" name="tipe">
							    	<option value="">-</option>
							    	<option>D</option>
							    	<option>H</option>
							    </select>
					      </div>
					  </div>

					  <div class="form-group"> 
					    <div class="col-sm-offset-4 col-sm-8">
					      <button type="submit" class="btn btn-primary">Simpan</button>
					    </div>
					  </div>

					</form>			
			</div>
		</div>
	</div>
</div>

@endsection
