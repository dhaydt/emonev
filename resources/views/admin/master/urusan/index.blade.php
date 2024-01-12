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
<p><a href="{{route('urusan.create')}}" class="btn btn-primary btn-xs">Tambah</a></p><br>
    @if ($message = Session::get('sukses'))
        <div id="notif" class="alert alert-success" style="padding:0px;">
            <p>{{$message}}</p>
        </div>
    @endif
<table class="table table-hover table-bordered table-stripped" id="example">
    <thead>
    <tr>
        <th>No</th>
        <th>ID Urusan</th>
        <th>KdUnit</th>
        <th>Unit Key</th>
        <th>Urusan</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @php $no=0; @endphp
    @foreach($urusan as $vurusan)
    @php $no++; @endphp
    <tr>
        <td>{{$no}}</td>
        <td>{{$vurusan->id}}</td>
        <td>{{$vurusan->kdunit}}</td>
        <td>{{$vurusan->unit_key}}</td>
        <td>{{$vurusan->nm_urusan}}</td>
        <td align="center">
            <form action="{{route('urusan.destroy', $vurusan->id)}}" method="post" >
                @csrf
                @method('DELETE')
                <a href="{{route('urusan.edit', $vurusan->id)}}" class="btn btn-xs btn-default bg-info"><i class="fa fa-pencil"></i> Edit</a>
                <button class="btn btn-xs btn-danger" onclick="return confirm('yakin data ini dihapus?')"><i class="fa fa-trash-o"></i> Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        } );
            $('#notif').slideDown('slow').delay(3000).slideUp('slow');
    </script>

</div>
@endsection