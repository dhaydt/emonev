@extends('layouts.template')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>RPJMD</li>
    <li>View</li>
    <li class="active">Program Indikator</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Indikator Program<small></small></h3>
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
    	        <h4 class="panel-title">Instansi : {{$opd->nm_instansi}}</h4>
    	    </div>
    	    <div class="panel-body">
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
    	    		@foreach($rpjmd_prog_indikator as $i)
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
    	    </div>
    	</div>
    </div>
</div>
@endsection