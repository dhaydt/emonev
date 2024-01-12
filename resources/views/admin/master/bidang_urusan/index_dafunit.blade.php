@extends('layouts.template')

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Urusan</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">View Urusan <small></small></h3>
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
            <h4 class="panel-title">Urusan</h4>
        </div>
        <div class="panel-body">

<table class="table table-hover table-bordered table-striped" id="data-table" width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>ID Urusan</th>
        <th>Kode Unit</th>
        <th>Unit Key</th>
        <th>Urusan</th>
    </tr>
    </thead>
    <tbody>
    @php $no=0; @endphp
    @foreach($urusan as $vurusan)
    @php $no++; @endphp
    <tr>
        <td>{{$no}}</td>
        <td>{{$vurusan->unitkey}}</td>
        <td>{{$vurusan->kdunit}}</td>
        <td>{{$vurusan->unitkey}}</td>
        <td>{{$vurusan->nm_unit}}</td>
        
    </tr>
    @endforeach
    </tbody>
</table>
            </div>
        </div>
        </div>
    </div>


@endsection