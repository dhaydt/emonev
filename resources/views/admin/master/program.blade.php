@extends('layouts.template')

@section('content')
<div class="bs-example4" style="padding:15px;" data-example-id="contextual-table">            
   <ol class="breadcrumb">
        <li><i class="lnr lnr-home"></i> Home</li>
        <li>List Program</li>
        <li class="active">View</li>

        <div class="pull-right"><b>Data Program</b></div>
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
		<th>ID Program</th>
		<th>Program</th>
	</tr>
	</thead>
	<tbody>
	@php $no=0; @endphp
	@foreach($program as $vp)
	@php $no++; @endphp
	<tr>
		<td>{{$no}}</td>
		<td>{{$vp->idprgrm}}</td>
		<td>{{$vp->nmprgrm}}</td>
	</tr>
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