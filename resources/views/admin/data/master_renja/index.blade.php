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
                    @php 
                    $thn=date('Y');
                    foreach($periode_renja as $t){
                        if($periode==$t->id){$sel="selected";}else{$sel="";}
                        echo"<option $sel>$t->id</option>";
                    }
                    @endphp
                </select> 
                <input type="hidden" name="data_renja" id="data_renja" value='{{$data_renja}}'><span style="color:red;font-size: 20px"><b>{{$data_renja}}</b></span>
                <div id="wait_periode"><img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}">
                    Loading...<!-- Loading -->
                </div>
            </div>
        </form>
        
        @if($periode!="")
        <br>
        <div class="panel-group" id="accordion">
                @php $no=0; $tot_pagu=0; @endphp
                @foreach($opd as $v)
                @if($v->id!=1)
                @php $no++; $tot_opd_pagu=0; @endphp

                @if (Auth::guard('web')->check())
                <div class="panel panel-info overflow-hidden">
                    <div class="panel-heading" style="padding:3px;">
                        <h3 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$v->id}}">
                                <i class="fa fa-plus-circle pull-right"></i> 
                                #{{$no}} - {{$v->opd->nm_instansi}}
                            </a>
                        </h3>
                    </div>
                    <div id="collapse{{$v->id}}" class="panel-collapse collapse bg-silver">
                @endif
                        <div class="panel-body" style="padding:10px;">
                            <div class="panel panel-warning overflow-hidden">
                                <div class="panel-heading" style="padding:3px;">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapsenon{{$no}}">
                                            <i class="fa fa-plus-circle pull-right"></i> 
                                            NON URUSAN
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapsenon{{$no}}" class="panel-collapse collapse bg-silver">
                                    <div class="panel-body bg-success">
                                        <table class="table table-striped table-hover table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th>Program</th>
                                                <th class="text-center">Pagu Indikatif (Rp)</th>
                                                <th class="text-center">Jml Kegiatan</th>
                                            </tr>
                                            @php $nonno=1; $tot_keg=0; $tot_urusan_pagu=0; @endphp
                                            
                                        @php 
                                        $rpjmd_prog_non_urusan = $rpjmd_prog_non->where('id_instansi','=',$v->opd->id)->where('id_status','=',1);
                                        @endphp

                                        @foreach($rpjmd_prog_non_urusan as $vpn)
                                        @php 
                                            $tot_keg=$tot_keg+$vpn->jml_keg($periode,$data_renja); 
                                            if(($vpn->jml_keg($periode,$data_renja))<=0){$tr="danger";}else{$tr="";}
                                        @endphp
                                        
                                        <tr class="{{$tr}}">
                                            <td>{{$nonno++}}</td>
                                            <td>
                                                <a ref="#" value="{{ action('MasterRenjaController@show_kegiatan',['periode'=>$periode,'data_renja'=>$data_renja,'idprgrm'=>$vpn->idprgrm, 'id_instansi'=>$v->id_instansi, 'unit_key'=>'0_']) }}" class="btn btn-xs modalMd" title="Renja - Program : {{$vpn->nmprgrm}}" data-toggle="modal" data-target="#modalMd">{{$vpn->nmprgrm}}</a>
                                            </td>
                                                    @php
                                                    if($vpn->rp_keg($periode,$data_renja)!=null){
                                                        $pagu=$vpn->rp_keg($periode,$data_renja)->pagu;                                                    
                                                    }else{
                                                        $pagu=0;
                                                    }

                                                    $tot_urusan_pagu=$tot_urusan_pagu+$pagu;
                                                    @endphp
                                            <td align="right">{{number_format($pagu,0)}}</td>
                                            <td align="center">{{$vpn->jml_keg($periode,$data_renja)}}</td>
                                        </tr>
                                        @endforeach
                                        @php
                                        $tot_opd_pagu=$tot_opd_pagu+$tot_urusan_pagu;
                                        @endphp
                                        <tr>
                                            <td colspan="2" align='right'><b>Total</b></td>
                                            <td align='right'><b>{{number_format($tot_urusan_pagu,0)}}</b></td>
                                            <td align='center'><b>{{$tot_keg}}</b></td>
                                        </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @php 
                                $pecah=explode(",",$v->arr_urusan); 
                                $no2=0;
                            @endphp
                            @foreach($pecah as $value)
                            @php $no2++ @endphp
                                <div class="panel panel-warning overflow-hidden">
                                    <div class="panel-heading" style="padding:3px;">
                                        <h3 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{$v->id_instansi}}{{$value}}{{$no}}{{$no2}}">
                                                <i class="fa fa-plus-circle pull-right"></i> 
                                                @php 
                                                    if($value!="80_"){
                                                        $du = $dafunit->where('unitkey','=',$value);
                                                        @endphp
                                                            @foreach($du as $vd)
                                                                {{$vd->nm_unit}}
                                                            @endforeach
                                                        @php
                                                    }else{
                                                        $du = $dafunit->where('unitkey','=','212_')->first();
                                                        $sekda = $data_opd_all->where('unit_key','=',$value)->first();
                                                        @endphp
                                                            {{$du->nm_unit}} : {{$sekda->nm_instansi}}
                                                        @php
                                                    }
                                                @endphp

                                            </a>
                                        </h3>
                                    </div>
                                    
                                    <div id="collapse{{$v->id_instansi}}{{$value}}{{$no}}{{$no2}}" class="panel-collapse collapse bg-silver">
                                        <div class="panel-body bg-success">
                                            @php 
                                            $rpjmd_prog_urusan = $rpjmd_prog->where('id_instansi','=',$v->opd->id)->where('id_status','=',1)->where('unitkey','=',$value);
                                            
                                            @endphp
                                            <table class="table table-striped table-hover table-bordered" width="100%">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Program</th>
                                                    <th class="text-center">Pagu Indikatif (Rp)</th>
                                                    <th class="text-center">Jml Kegiatan</th>
                                                </tr>
                                                @php $urno=1; $tot_keg=0; $tot_urusan_pagu=0; @endphp
                                                @foreach($rpjmd_prog_urusan as $vp)
                                                @php 
                                                    $tot_keg=$tot_keg+$vp->jml_keg($periode,$data_renja); 
                                                    if(($vp->jml_keg($periode,$data_renja))<=0){$tr="danger";}else{$tr="";}
                                                @endphp
                                                <tr class="{{$tr}}">
                                                    <td>{{$urno++}}</td>
                                                    <td>
                                                    <a ref="#" value="{{ action('MasterRenjaController@show_kegiatan',['periode'=>$periode,'data_renja'=>$data_renja,'idprgrm'=>$vp->idprgrm, 'id_instansi'=>$v->id_instansi, 'unit_key'=>$value]) }}" class="btn btn-xs modalMd" title="Renja {{$periode}} - Program : {{$vp->nmprgrm}}" data-toggle="modal" data-target="#modalMd">{{$vp->nmprgrm}}</a>
                                                    </td>
                                                    @php
                                                    if($vp->rp_keg($periode,$data_renja)!=null){
                                                        $pagu=$vp->rp_keg($periode,$data_renja)->pagu;
                                                    }else{
                                                        $pagu=0;
                                                    }
                                                    $tot_urusan_pagu=$tot_urusan_pagu+$pagu;
                                                    @endphp
                                                    <td align="right">{{number_format($pagu,0)}}</td>
                                                    <td align="center">{{$vp->jml_keg($periode,$data_renja)}}</td>
                                                </tr>
                                                @endforeach

                                                @php
                                                $tot_opd_pagu=$tot_opd_pagu+$tot_urusan_pagu;
                                                @endphp
                                                <tr>
                                                    <td colspan="2" align='right'><b>Total</b></td>
                                                    <td align='right'><b>{{number_format($tot_urusan_pagu,0)}}</b></td>
                                                    <td align='center'><b>{{$tot_keg}}</b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                            @php
                            $tot_pagu=$tot_pagu+$tot_opd_pagu;
                            @endphp
                            <h4 class='alert alert-success'><b>TOTAL PAGU RENJA OPD: {{number_format($tot_opd_pagu,0)}}</b></h4>
                        </div>
                @if (Auth::guard('web')->check())
                    </div>
                </div>
                @endif

                @endif
                @endforeach
                
                <h4 class='alert alert-default'><b>TOTAL PAGU RENJA: {{number_format($tot_pagu,0)}}</b></h4>
            </div>

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
    <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <!--<div id="page-loader" class="fade"><span class="spinner"></span></div>-->
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header" style="padding:2px;background-color: #FF1B05;position: -webkit-sticky;position: sticky;top: 0;padding: 5px;z-index: 9999;">
                  <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; <b>Close</b></span></button>
                  
                  <h4 class="modal-title" id="modalMdTitle" style="color: #fff;"></h4>
              </div>
              <div class="modal-body" style="padding:5px;padding-top: 0px;padding-bottom: 0px;">
                    <style>
                      #wait {
                            /*cursor: pointer;*/
                            position: fixed;
                            top: 50%;
                              left: 50%;
                              /* bring your own prefixes */
                              transform: translate(-50%, -50%);
                            z-index: 9999;
                            background-color: #ffffff;
                            border: 1px solid black;
                            opacity: 0.6;
                            filter: alpha(opacity=60);
                            border-radius:10px;
                        }
                    </style>
                    <div id="wait" class="text-center"><img src="{{ asset('public/template/color_admin/img/loading/l2.gif') }}">
                        <!-- Loading -->
                    </div>
                  <div class="modalError"></div>
                  <div id="modalMdContent"></div>
              </div>
          </div>
      </div>
    </div>

<script type="text/javascript">
    $('#wait_periode').hide();
    $("#periode").change(function() {
        $('#wait_periode').show();
    });
    $(document).ajaxStart(function(){
        $('#wait').show();
    });

    $(document).on('ajaxComplete ready', function () {
        $('.modalMd').off('click').on('click', function () {
            $('#modalMdContent').load($(this).attr('value'), function( response, status, xhr ) {
              if ( status == "error" ) {
                var msg = "Sorry but there was an error: ";
                $( "#modalError" ).html( msg + xhr.status + " " + xhr.statusText );
              }
            });

            $('#modalMdTitle').html($(this).attr('title'));
        });
    });
</script>
@endsection