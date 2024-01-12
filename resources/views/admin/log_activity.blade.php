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
    <li>Data Akun</li>
    <li class="active">Log Activity User</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Log Activity User <small></small></h3>
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
            <h4 class="panel-title">Log Activity User</h4>
        </div>
        <div class="panel-body">

<table class="table table-hover table-bordered table-striped" id="data-table">
	<thead>
	<tr>
		<th>No</th>
		<th>ID User</th>
        <th>Username</th>
		<th>Nama Lengkap</th>
        <th>Email</th>
        <th>Instansi</th>
		<th>Level</th>
		<th>Online</th>
	</tr>
	</thead>
	<tbody>
	@php $no=0; @endphp
	@foreach($user as $v)
    @php $no++; @endphp
    <tr>
        <td>{{$no}}</td>
        <td>{{$v->id}}</td>
        <td>{{$v->email}}</td>
        <td>{{$v->name}}</td>
        <td>{{$v->email}}</td>
        <td>BAPPEDA BID. PEDIPP</td>
        <td>Admin</td>
        <td align="center">
            @if($v->isOnline())
                <i class="fa fa-circle text-info"></i> Online
            @else
                <i class="fa fa-circle text-danger"></i> Offline
            @endif
        </td>
    </tr>
    @endforeach

    @foreach($opd as $v2)
	@php $no++; @endphp
	<tr>
		<td>{{$no}}</td>
		<td>{{$v2->id}}</td>
        <td>{{$v2->username}}</td>
		<td>{{$v2->nm_pegawai}}</td>
        <td>{{$v2->email}}</td>
        <td>{{$v2->data_opd->nm_instansi??''}}</td>
        <td>OPD Prov</td>
        <td align="center" class="bg-info">
            @if($v2->isOnline())
                <i class="fa fa-circle text-info"></i> Online
            @else
                <i class="fa fa-circle text-danger"></i> Offline
            @endif
        </td>
	</tr>
	@endforeach
	</tbody>
</table>

</div>
</div>
</div>
</div>
@endsection