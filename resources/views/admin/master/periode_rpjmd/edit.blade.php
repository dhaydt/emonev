@extends('layouts.template')

@section('content')
<!-- datatables customselect -->

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Periode RPJMD</li>
    <li class="active">Tambah</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Edit Periode RPJMD <small></small></h3>
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
            <h4 class="panel-title">Periode RPJMD</h4>
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
					<form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('periode_rpjmd.update',$periode_rpjmd->id)}}" @endif>
						@csrf
						@method('PUT')
					  
					  <div class="form-group">
  					      <label class="control-label col-sm-4" for="kdunit">Tahun Awal:</label>
  					      <div class="col-sm-1">
  					        <input type="number" class="form-control" name="thn_awal" value='{{$periode_rpjmd->thn_awal}}' placeholder="Tahun Awal">
  					      </div>
  					  </div>
  					  <div class="form-group">
  					      <label class="control-label col-sm-4" for="kdunit">Tahun Akhir:</label>
  					      <div class="col-sm-1">
  							    <input type="number" class="form-control" name="thn_akhir"  value='{{$periode_rpjmd->thn_akhir}}' placeholder="Tahun Akhir">	
  					      </div>
  					  </div>
  					  <div class="form-group">
  					      <label class="control-label col-sm-4" for="kdunit">Judul:</label>
  					      <div class="col-sm-6">
  							    <input type="text" class="form-control" name="judul" placeholder="Judul"  value='{{$periode_rpjmd->judul}}' value="">
  					      </div>
  					  </div>

					  <div class="form-group"> 
					    <div class="col-sm-offset-4 col-sm-8">
					      <button type="submit" class="btn btn-primary">Ubah</button>
					    </div>
					  </div>

					</form>			
</div>
</div>
</div>
</div>
@endsection
