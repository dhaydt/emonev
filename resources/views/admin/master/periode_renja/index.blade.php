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
    <li>Periode Renja</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">View Periode Renja <small></small></h3>
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
            <h4 class="panel-title">Periode Renja</h4>
        </div>
        <div class="panel-body">

<p><a @if(Auth::user()->level=='Super Admin') href="{{route('periode_renja.create')}}" @endif class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Tambah</a></p>

    @if ($message = Session::get('sukses'))
        <div id="notif" class="alert alert-success">
            {{$message}}
        </div>
    @endif
<table class="table table-hover table-bordered table-striped" id="data-table" width="100%">
    <thead>
    <tr>
        <th>No</th>
        <th>ID Periode Renja</th>
        <th>ID Periode RPJMD</th>
        <th>Periode RPJMD</th>
        <th>Aktif</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @php $no=0; @endphp
    @foreach($prenja as $v)
    @php $no++; @endphp
    <tr>
        <td>{{$no}}</td>
        <td>{{$v->id}}</td>
        <td>{{$v->prpjmd->id}}</td>
        <td>{{$v->prpjmd->judul}} ({{$v->prpjmd->thn_awal}}-{{$v->prpjmd->thn_akhir}})</td>
        <td>@if($v->aktiv == 1) Aktif @else Tidak AKtif @endif</td>
        <td align="center" width='10%'>
            <form @if(Auth::user()->level=='Super Admin') action="{{route('periode_renja.destroy', $v->id)}}" method="post" @endif>
                @csrf
                @method('DELETE')
                <a @if(Auth::user()->level=='Super Admin') href="{{route('periode_renja.edit', $v->id)}}" @endif title="Edit data" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> </a>
                <button class="btn btn-xs btn-danger" title="Hapus data" onclick="return confirm('yakin data ini dihapus?')"><i class="fa fa-trash-o"></i> </button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
            </div>
        </div>
        </div>
    </div>

    <script type="text/javascript">   
        $('#notif').slideDown('slow').delay(3000).slideUp('slow');
        //alert('tes');
    </script>

@endsection