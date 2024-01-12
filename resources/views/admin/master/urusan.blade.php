@extends('layouts.template')

@section('content')
<div class="bs-example4" style="padding:15px;" data-example-id="contextual-table">            
   <ol class="breadcrumb">
        <li><i class="lnr lnr-home"></i> Home</li>
        <li>List Urusan</li>
        <li class="active">View</li>

        <div class="pull-right"><b>Data Urusan</b></div>
    </ol>

    <!-- datatables js -->
    <script type="text/javascript" src="{{ asset('public/template/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/template/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js') }}"></script>

    <style type="text/css">
    	.dataTables_filter{
    		text-align:right;
    	}
    	.dataTables_paginate{
    		text-align:right;
    	}
    </style>
<table class="table table-hover table-bordered table-stripped" id="example">
	<thead>
	<tr>
		<th>No</th>
		<th>ID Urusan</th>
		<th>Urusan</th>
	</tr>
	</thead>
	<tbody>
	@php $no=0; @endphp
	@foreach($urusan as $vurusan)
	@if($vurusan->kdlevel==2)
	@php $no++; @endphp
	<tr>
		<td>{{$no}}</td>
		<td>{{$vurusan->unitkey}}</td>
		<td>{{$vurusan->nmunit}}</td>
	</tr>
	@endif
	@endforeach
	</tbody>
</table>
	<script>
		$(document).ready( function () {
			$('#example').DataTable();
		} );
	</script>
</div>
@endsection