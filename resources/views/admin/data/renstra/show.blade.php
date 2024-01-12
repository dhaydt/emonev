@extends('layouts.template')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Renstra</li>
    <li>View</li>
    <li class="active">Kegiatan</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Data Kegiatan<small></small></h3>
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
    	        <h4 class="panel-title">Instansi : {{$prog->opd_program() }}</h4>
    	    </div>
    	    <div class="panel-body">
                <p><b>Urusan : {{$prog->urusan_program()}}</b></p>
                <p><b>Program : {{$prog->nmprgrm}}</b></p>
    	    	
    	    	<table class="table table-hover table-bordered table-striped">
    	    		<tr>
    	    			<th>#</th>
    	    			<th>Indikator</th>
    	    			<th>Satuan</th>
    	    			<th>Tahun 2016</th>
    	    			<th>Tahun 2017</th>
    	    			<th>Tahun 2018</th>
    	    			<th>Tahun 2019</th>
    	    			<th>Tahun 2020</th>
    	    			<th>Tahun 2021</th>
    	    		</tr>
    	    		@php $no=0; @endphp
    	    		@foreach($prog->indikator_program() as $i)
    	    		@php $no++; @endphp

    	    			<tr>
    	    				<td>{{$no}}</td>
    	    				<td>{{$i->indikator}}</td>
    	    				<td>{{$i->satuan}}</td>
    	    				<td>{{$i->t1}}</td>
    	    				<td>{{$i->t2}}</td>
    	    				<td>{{$i->t3}}</td>
    	    				<td>{{$i->t4}}</td>
    	    				<td>{{$i->t5}}</td>
    	    				<td>{{$i->t6}}</td>
    	    			</tr>
    	    		@endforeach
    	    	</table>
                <p><b>Data Kegiatan</b></p>
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Kode Kegiatan</th>
                        <th>Nama Kegiatan</th>
                        <th>Type</th>
                    </tr>
                    @php $no2=1; @endphp
                    @foreach($prog->kegiatan as $k)
                    <tr>
                        <td>{{$no2++}}</td>
                        <td>{{$k->id}}</td>
                        <td>{{$k->nmkegunit}}</td>
                        <td>{{$k->type}}</td>
                    </tr>
                    @endforeach
                </table>
    	    </div>
    	</div>
    </div>
</div>
@endsection