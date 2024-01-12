@extends('layouts.template')

@section('content')

<div class="bs-example4" style="padding:15px;" data-example-id="contextual-table">            
   <ol class="breadcrumb">
        <li><i class="lnr lnr-home"></i> Home</li>
        <li>OPD</li>
        <li class="active">Input</li>

        <div class="pull-right"><b>Input Data OPD</b></div>
    </ol>
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
					<form method="POST" class="form-horizontal" action="{{route('urusan.store')}}" >
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
					      <label class="control-label col-sm-4" for="kdunit">Nama Urusan:</label>
					      <div class="col-sm-6">
							    <input type="text" class="form-control" name="nm_urusan" placeholder="nama urusan" value="">
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
