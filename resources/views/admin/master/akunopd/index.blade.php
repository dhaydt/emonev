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
    <li>Akun OPD</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">View Akun OPD <small></small></h3>
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
            <h4 class="panel-title">List Akun OPD</h4>
        </div>
        <div class="panel-body">

<p><a @if(Auth::user()->level=='Super Admin') href="{{route('akun-opd.create')}}" @endif class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Tambah</a></p>
    @if ($message = Session::get('sukses'))
        <div id="notif" class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

<table class="table table-hover table-bordered table-striped" id="data-table">
	<thead>
	<tr>
		<th>No</th>
		<th>ID Instansi</th>
		<th>Instansi</th>
		<th>Unitkey</th>
		<th>Username</th>
		<th>Email</th>
		<th>Status</th>
		<th>Aksi</th>
	</tr>
	</thead>
	<tbody>
	@php $no=0; @endphp
	@foreach($data as $v)
	@php $no++; @endphp
	<tr>
		<td>{{$no}}</td>
		<td>{{$v->id_instansi}}</td>
        <td>{{$v->data_opd->nm_instansi??''}}</td>
        <td>{{$v->data_opd->unit_key??''}}</td>
		<td>{{$v->username}}</td>
		<td>{{$v->email}}</td>
		<td>
			@if($v->status==1)
			    <span class="badge badge-success">Aktif</span>
			@else
			    <span class="badge badge-danger">Tidak Aktif</span>
			@endif
		</td>
		<td align="center">
            <form @if(Auth::user()->level=='Super Admin') action="{{route('akun-opd.destroy', $v->id)}}" @endif method="post" >
                @csrf
                @method('DELETE')
                <a @if(Auth::user()->level=='Super Admin') href="{{route('akun-opd.edit', $v->id)}}" @endif class="btn btn-xs btn-info bg-info"><i class="fa fa-pencil"></i></a>
                <button class="btn btn-xs btn-danger" onclick="return confirm('yakin data ini dihapus?')"><i class="fa fa-trash-o"></i> </button>
            </form>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>

    <script>
            $('#notif').slideDown('slow').delay(3000).slideUp('slow');
    </script>

</div>
</div>
</div>
</div>
@endsection