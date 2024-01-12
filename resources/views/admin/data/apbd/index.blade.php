@extends('layouts.template')
@section('title', 'CRUD BLOG')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Persandingan APBD & RKPD</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Data Persandingan APBD & RKPD<small></small></h3>
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
            <h4 class="panel-title">Data APBD yang tidak ada didalam RKPD Tahun 2019</h4>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped table-bordered">
            	<tr>
            		<th>No</th>
            		<th>Program</th>
            		<th>Kegiatan</th>
            		<th>Unitkey</th>
            		<th>Idprgrm</th>
            		<th>Kdkegunit</th>
            		<th>Pagu</th>
            		<th>Id instansi</th>
            		<th>OPD</th>
            	</tr>
            	@foreach($apbd as $key=>$va)
		            	<!-- @if($va->idprgrm=="")
		            	@php
		            	$prog=DB::table('program')->where('nmprgrm',$va->nmprog_)->first();
		            	@endphp
		            	<tr>
		            		<td>{{($key+1)}}</td>
		            		<td>{{$va->idprgrm_}} / {{$va->nmprog_}}</td>
		            		<td>{{$va->kdkegunit_}} / {{$va->nmkeg_}}</td>
		            		<td>{{$va->unitkey}}</td>
		            		<td>{{$va->idprgrm}} @if($prog!=''){{$prog->nmprgrm}}@endif</td>
		            		<td>{{$va->kdkegunit}}</td>
		            		<td>{{number_format($va->pagu,0)}}</td>
		            		<td>{{$va->id_instansi}}</td>
		            		<td>{{$va->opd}}</td>
		            	</tr>
		            	@endif -->
		            	
		            	@if($va->kdkegunit=="")
		            	@php
		            	$keg=DB::table('renstra_keg')->where('nmkegunit',$va->nmkeg_)->first();
		            	@endphp
		            	<tr>
		            		<td>{{($key+1)}}</td>
		            		<td>{{$va->idprgrm_}} / {{$va->nmprog_}}</td>
		            		<td>{{$va->kdkegunit_}} / {{$va->nmkeg_}}</td>
		            		<td>{{$va->unitkey}}</td>
		            		<td>{{$va->idprgrm}} </td>
		            		<td>{{$va->kdkegunit}} @if($keg!=''){{$keg->nmkegunit}}@endif</td>
		            		<td>{{number_format($va->pagu,0)}}</td>
		            		<td>{{$va->id_instansi}}</td>
		            		<td>{{$va->opd}}</td>
		            	</tr>
		            	@endif
            	@endforeach
            </table>
        </div>
    </div>
    </div>
</div>


@endsection