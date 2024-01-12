@extends('layouts.template')

@section('content')
<!-- datatables customselect -->

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Periode Renja</li>
    <li class="active">Tambah</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Tambah Periode Renja <small></small></h3>
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
            <h4 class="panel-title">Periode Renja</h4>
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
					<form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('periode_renja.store')}}" @endif>
						@csrf
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Periode Renja:</label>
					      <div class="col-sm-1">
					        <input type="number" class="form-control" name="id" value="{{date('Y')}}" placeholder="Tahun Awal">
					      </div>
					  </div>
					  <div class="form-group">
					      <label class="control-label col-sm-4" for="kdunit">Periode RPJMD:</label>
					      <div class="col-sm-2">
							   <select name='id_periode_rpjmd' class="form-control">
							   		<option value=''>Pilih Periode RPJMD</option>
							   		@foreach($prpjmd as $r)
							   		<option value='{{$r->id}}'>{{$r->judul}} ({{$r->thn_awal}}-{{$r->thn_akhir}})</option>
							   		@endforeach
							   </select>	
					      </div>
					  </div>
			            <div class="form-group">
			                <label class="control-label col-sm-4" for="aktif">Aktif:</label>
			                <div class="col-sm-2">
			                 <select name='aktiv' class="form-control">
			                    <option value="0">Tidak Aktif</option>
			                    <option value="1">Aktif</option>
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
