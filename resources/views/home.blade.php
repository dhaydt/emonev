@extends('layouts.template')

@section('content')
            
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li class="active">Dashboard</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard <small></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fa fa-desktop"></i></div>
            <div class="stats-info">
                <h4>TOTAL OPD</h4>
                <p>{{$jo}}</p>    
            </div>
            <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon"><i class="fa fa-chain-broken"></i></div>
            <div class="stats-info">
                <h4>Program</h4>
                <p>{{number_format($jp,0)}}</p>   
            </div>
            <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-purple">
            <div class="stats-icon"><i class="fa fa-clock-o"></i></div>
            <div class="stats-info">
                <h4>Kegiatan</h4>
                <p>{{number_format($jk,0)}}</p>    
            </div>
            <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-red">
            <div class="stats-icon"><i class="fa fa-users"></i></div>
            <div class="stats-info">
                <h4>VISITORS</h4>
                <p>53</p> 
            </div>
            <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
</div>
<!-- end row -->
<div class="row">
    <div class="col-md-12">
    
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title">Home</h4>
        </div>
        <div class="panel-body">
        
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                   {{ session('status') }}
            </div>
        @endif

        You are logged in!

        <h4>List OPD yang sudah menyelesaikan penginputan Evaluasi Renja 
            <form class="form-inline">
                <select name='periode' onchange="submit()">
                    <option value="">Pilih Periode</option>
                    @php
                    for($th=2019;$th<=date('Y');$th++){
                        if($periode==$th){
                            echo"<option selected>".$th."</option>";
                        }else{
                            echo"<option>".$th."</option>";
                        }
                    }
                    @endphp
                </select>
            </form>
        </h4>
        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>OPD</th>
                <th class='text-center'>Triwulan I</th>
                <th class='text-center'>Triwulan II</th>
                <th class='text-center'>Triwulan III</th>
                <th class='text-center'>Triwulan IV</th>
            </tr>
            @php 
                $no=0;
                $tt1=0;
                $tt2=0;
                $tt3=0;
                $tt4=0;
            @endphp
            @foreach($st as $v)
	        @php $no++ @endphp
            <tr>
                <td>{{$no}}</td>
                <td>{{$v->data_opd->nm_instansi}}</td>
                <td align='center'>@if($v->st1=="1") <i class="fa fa-check"></i>@php $tt1++; @endphp @endif</td>
                <td align='center'>@if($v->st2=="1") <i class="fa fa-check"></i>@php $tt2++; @endphp @endif</td>
                <td align='center'>@if($v->st3=="1") <i class="fa fa-check"></i>@php $tt3++; @endphp @endif</td>
                <td align='center'>@if($v->st4=="1") <i class="fa fa-check"></i>@php $tt4++; @endphp @endif</td>
            </tr>
            @endforeach
            <tr>
            	<td colspan=2 class="text-right"><b>TOTAL</b></td>
            	<th class="text-center">{{$tt1}}</th>
            	<th class="text-center">{{$tt2}}</th>
            	<th class="text-center">{{$tt3}}</th>
            	<th class="text-center">{{$tt4}}</th>
            </tr>
        </table>
        </div>
        
        </div>
    </div>
    </div>
</div>

</div>
<!-- end row -->
@endsection
