@extends('layouts.template')

@section('content')

<style>
  #notif {
    cursor: pointer;
    position: fixed;
    right: 0px;
    z-index: 9999;
    bottom: 0px;
    margin-bottom: 22px;
    margin-right: 15px;
    min-width: 300px; 
    max-width: 800px;
}
</style>

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Impor & Ekspor</li>
    <li class="active">Renja Indikator (Output)</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Impor & Ekspor<small></small></h3>
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
            <h4 class="panel-title">Impor & Ekspor</h4>
        </div>
        <div class="panel-body">
			  <div class="row">
				<div class="col-sm-2">
				  <a class="btn btn-success btn-sm" href="{{  url('/import?tbl=renja_indikator&eksport=true') }}"><i class="fa fa-arrow-up"></i> Eksport Renja Indikator</a>
				</div>
			  </div>
			  <hr/>
			  <div class="row">
				<div class="col-sm-2">
				  <a class="btn btn-info btn-sm" href="{{  url('/import?tbl=renja_indikator&eksport=template') }}"><i class="fa fa-download"></i> Download Template Import Renja Indikator</a>
				</div>
			  </div>
			  
			  <p/>
			  		@if ($sukses = Session::get('sukses'))
			  		<div class="alert alert-success alert-block">
			  			<button type="button" class="close" data-dismiss="alert">×</button> 
			  			<strong>{{ $sukses }}</strong>
			  		</div>
			  		@endif
			  <form method="post" action="{{route('import.store')}}" enctype="multipart/form-data">
			  	
			  			{{ csrf_field() }}
						@foreach($periode_renja as $pr)
						<label>Periode Renja</label>
			  			<div class="form-group">
							<select name='id_periode_renja' required>
								<option value=''>Pilih Periode Renja</option>
								<option value='{{$pr->id}}'>{{$pr->id}}</option>
							</select>
			  			</div>
						@endforeach

			  			<label>Pilih file excel</label>
			  			<div class="form-group">
			  				<input type="hidden" name="tbl" required="required" value="{{$tbl}}">
			  				<input type="file" name="file" required="required">
			  			</div>

			  			<button type="submit" class="btn btn-warning">Import</button>
			  		
			  </form>
			
			@if ($message = Session::get('sukses'))
				<div id="notif" class="alert alert-success">
					{{$message}}
				</div>
			@endif

			<script>
					$('#notif').slideDown('slow').delay(3000).slideUp('slow');
			</script>

		</div>
</div>
</div>
</div>
@endsection