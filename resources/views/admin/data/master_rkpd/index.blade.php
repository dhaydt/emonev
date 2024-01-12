@extends('layouts.template')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Data RKPD {{$data_renja}}</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Data RKPD @if($periode!="") {{$periode}} {{$data_renja}} @endif<small></small></h3>
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
            <h4 class="panel-title">List Data RKPD {{$data_renja}}</h4>
        </div>
        <div class="panel-body">

        
        <form class="form-inline" action="" method="get">
            <div class="form-group m-r-10">
                Pilih Periode RKPD : <select name="periode" id="periode" class="form-control" onchange="this.form.submit()">
                    <option value="">Pilih Periode</option>
                    @foreach ($periode_renja as $per)
                        <option @if($periode==$per->id) selected @endif>{{ $per->id }}</option>
                    @endforeach
                </select> 
                <input type="hidden" name="data_renja" id="data_renja" value='{{$data_renja}}'><!--span style="color:red;font-size: 20px"><b>{{$data_renja}}</b></span-->
                <div id="wait_periode"><img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}">
                    Loading...<!-- Loading -->
                </div>
            </div>
        </form>
        
        @if($periode!="")
        <table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama Instansi</th>
        <th @if($data_renja=="perubahan") colspan="2" @endif >Pagu</th>
        <th rowspan="2">Lihat Program</th>
    </tr>
    <tr>
        <th>Awal</th>
        @if($data_renja=="perubahan") 
        <th>Perubahan</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @php 
    $no=0; 
    $tpagu_awal=0; 
    $tpagu_perubahan=0; 
    @endphp
    @foreach($data_opd as $v)
    @php 
    $no++; 
    $tpagu_awal=$tpagu_awal+$v->pagu($periode)->jpagu_awal; 
    $tpagu_perubahan=$tpagu_perubahan+$v->pagu($periode)->jpagu_perubahan;
    @endphp
    <tr>
        <td>{{$no}}</td>
        <td>{{$v->nm_instansi}}</td>
        <td align="right">{{number_format($v->pagu($periode)->jpagu_awal,0)}}</td>
        @if($data_renja=="perubahan") 
        <td align="right">{{number_format($v->pagu($periode)->jpagu_perubahan,0)}}</td>
        @endif
        <td align="center">
            <a href="{{url('./data-rkpd?periode='.$periode.'&data_renja='.$data_renja.'&act=rkpd_prog&opd='.$v->id)}}" class="btn btn-xs btn-info">Lihat Program <i class="fa fa-arrow-right"></i></a>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td align="right"><b>{{number_format($tpagu_awal,0)}}</b></td>
            <td align="right"><b>{{number_format($tpagu_perubahan,0)}}</b></td>
            <td></td>
        </tr>
    </tfoot>
    </table>
        @endif

        </div>
    </div>
    </div>
</div>

<!--Modal-->
<style type="text/css">
    .modal-dialog {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .modal-content {
      height: auto;
      min-height: 100%;
      border-radius: 0;
    }
</style>

<script type="text/javascript">
    $('#wait_periode').hide();
    $("#periode").change(function() {
        $('#wait_periode').show();
    });
    $(document).ajaxStart(function(){
        $('#wait').show();
    });

</script>
@endsection