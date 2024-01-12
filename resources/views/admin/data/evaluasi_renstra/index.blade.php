@extends('layouts.template')
@section('title', 'CRUD BLOG')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Evaluasi Renstra</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Evaluasi Renstra<small></small></h3>
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
            <h4 class="panel-title">Pilih Urusan dan Program OPD</h4>
        </div>
        <div class="panel-body">
            <form class="form-inline" id='form_cari_periode' action="" method="get">
                <div class="form-group m-r-10">
                    Pilih Periode Renstra : <select name="periode" id="pilih_periode" class="form-control" onchange="cari_data()">
                        <option value="">Pilih Periode</option>
                        @php 
                          if($periode==2019){$sel="selected";}else{$sel="";}
                          echo"<option $sel>2019</option>";
                        // $thn=date('Y');
                        //for($t=2019;$t<=$thn;$t++){
                          //  if($periode==$t){$sel="selected";}else{$sel="";}
                           // echo"<option $sel>$t</option>";
                        //} 
                        $noopd=0;
                        @endphp
                    </select>
                    <script type="text/javascript">
                        function cari_data(){
                            var periode=$('#pilih_periode').val();
                            if(periode!=""){
                                // alert('submit');
                                $('#wait_periode').show();
                                $('#form_cari_periode').submit();
                            }
                        }
                    </script>
                    <div id="wait_periode" style='display:none;'><img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}">
                        Loading...<!-- Loading -->
                    </div>
                </div>
            </form>
            <br/>
            
            @if($periode!="")
            @if ($message = Session::get('sukses'))
                <div id="notif" class="alert alert-success" style="padding:0px;">
                    <p>{{$message}}</p>
                </div>
            @endif


            <div class="panel-group" id="accordion">
                @php 
                    $no=0;
                    $noopd=0; 
                    $ar_toturusan=array();
                    $ar_totkeg=array();
                    $ar_totketerisian=array();
                    $ar_totrasio1=array();
                    $ar_totrasio2=array();
                    $ar_totrasio3=array();
                    $ar_totrasio4=array();
                @endphp
                @foreach($opd as $v)
                @if($v->id!=1)
                @php 
                    $no++; 
                    $noopd++; 
                    $ar_urusanopd=array();
                    $ar_kegopd=array();
                    $ar_keterisianopd=array();
                    $ar_rasioopd1=array();
                    $ar_rasioopd2=array();
                    $ar_rasioopd3=array();
                    $ar_rasioopd4=array();
                @endphp

                @if (Auth::guard('web')->check())
                <div class="panel panel-info overflow-hidden">
                    <div class="panel-heading" style="padding:3px;">
                        <h3 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$v->id}}">
                                #{{$noopd}} - {{$v->opd->nm_instansi}}
                                <i class="fa fa-plus-circle pull-right"></i> 
                                <i class="label label-default text-inverse pull-right"><span class="tot_rasio-{{$noopd}}">%</span></i>
                            </a>
                            
                        </h3>
                    </div>
                    <div id="collapse{{$v->id}}" class="panel-collapse collapse bg-silver">
                @endif
                        @php 
                        $rpjmd_prog_non_urusan = $rpjmd_prog_non->where('id_instansi','=',$v->opd->id)->where('id_status','=',1);
                        $no=0;
                        @endphp


                        <div class="panel-body" style="padding:10px;">
                            <label>Ekspor Evaluasi Renstra Periode: {{$periode}}</label>
                            <div class="btn-group">
                                 <a ref="#" value="{{$v->id_instansi}}" jenis="e54" class="btn btn-success btn-xs modal_ekspor" data-toggle="modal" data-target="#modal_ekspor" title="{{$v->opd->nm_instansi}}" tipe="Excel" judul="Renstra"><i class="fa fa-file-excel-o"></i> Excel</a>
                             </div><p></p>

                            @if($v->opd->non_urusan)
                            <div class="panel panel-warning overflow-hidden">
                                <div class="panel-heading" style="padding:3px;">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapsenon{{$v->id}}">
                                            <i class="fa fa-plus-circle pull-right"></i> 
                                            NON URUSAN
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapsenon{{$v->id}}" class="panel-collapse collapse bg-silver">
                                    <div class="panel-body bg-success">
                                        
                                        <table class="table table-striped table-hover table-bordered">
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Program</th>
                                            <th rowspan="2" class="text-center">Jml Kegiatan</th>
                                            <th rowspan="2" class="text-center">Keterisian Data (%)</th>
                                            <th colspan=4 class="text-center">Rasio Capaian Renstra</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">2016</th>
                                            <th class="text-center">2017</th>
                                            <th class="text-center">2018</th>
                                            <th class="text-center">2019</th>
                                        </tr>
                                        @php $tot_keg=0;$tot_keterisian=0;$tot_rasio1=0;$tot_rasio2=0;$tot_rasio3=0;$tot_rasio4=0;$tot_rasio5=0;$tot_rasio6=0; @endphp
                                        @foreach($rpjmd_prog_non_urusan as $vpn)
                                        @php 
                                            $no++;
                                            if(($vpn->jml_keg_renstra($periode))<=0){$tr="danger";}else{$tr="";}
                                            $tot_keg=$tot_keg+$vpn->jml_keg_renstra($periode);
                                        @endphp
                                            @if(($vpn->jml_keg_renstra($periode))>0)
                                            <tr class="{{$tr}}">
                                                <td>{{$no}}</td>
                                                <td>
                                                    <a ref="#" value="{{ action('EvaluasiRenstraController@show_evaluasi_renstra',['periode'=>$periode,'idprgrm'=>$vpn->idprgrm, 'id_instansi'=>$v->id_instansi, 'unit_key'=>'0_']) }}" class="btn btn-xs modalMd" title="Renstra - Program : {{$vpn->nmprgrm}}" data-toggle="modal" data-target="#modalMd">{{$vpn->nmprgrm}}</a>
                                                </td>
                                                <td align='center'>
                                                    {{$vpn->jml_keg_renstra($periode)}}
                                                </td>
                                                <td align='center'>
                                                    @php
                                                        $isian_keg=$vpn->jml_keg_renstra($periode)*4;
                                                        $isian_k=$vpn->jml_keg_k_renstra($periode)*4;

                                                        $isian=$isian_keg+$isian_k;

                                                        $risian_keg=$vpn->jml_realisasi_keg_renstra($periode,'rpt1')+$vpn->jml_realisasi_keg_renstra($periode,'rpt2')+$vpn->jml_realisasi_keg_renstra($periode,'rpt3')+$vpn->jml_realisasi_keg_renstra($periode,'rpt4');
                                                        $risian_k=$vpn->jml_realisasi_keg_k_renstra($periode,'kt1')+$vpn->jml_realisasi_keg_k_renstra($periode,'kt2')+$vpn->jml_realisasi_keg_k_renstra($periode,'kt3')+$vpn->jml_realisasi_keg_k_renstra($periode,'kt4');

                                                        $risian=$risian_keg+$risian_k;

                                                        $keterisian=($risian/$isian)*100;
                                                        if($keterisian>=100){
                                                            echo"<span class='badge badge-success'>";
                                                        }else{
                                                            echo"<span class='badge badge-danger'>";
                                                        }
                                                        $tot_keterisian=$tot_keterisian+$keterisian;              

                                                        echo number_format($keterisian,2).'%</span>';
                                                    @endphp

                                                </td>
                                                @php
                                                    $re_prog=$vpn->realisasi_renstra($periode);
                                                    $tr_prog=$vpn->target_renstra($periode);
                                                    if($tr_prog->t_trp_1>0){
                                                        $rasio1=($re_prog->t_rpt1/$tr_prog->t_trp_1)*100;
                                                    }else{
                                                        $rasio1=0;
                                                    }                                                    if($tr_prog->t_trp_2>0){
                                                        $rasio2=($re_prog->t_rpt2/$tr_prog->t_trp_2)*100;
                                                    }else{
                                                        $rasio2=0;
                                                    }

                                                    if($tr_prog->t_trp_3>0){
                                                        $rasio3=($re_prog->t_rpt3/$tr_prog->t_trp_3)*100;
                                                    }else{
                                                        $rasio3=0;
                                                    }

                                                    if($tr_prog->t_trp_4>0){
                                                        $rasio4=($re_prog->t_rpt4/$tr_prog->t_trp_4)*100;
                                                    }else{
                                                        $rasio4=0;
                                                    }

                                                    $tot_rasio1=$tot_rasio1+$rasio1;
                                                    $tot_rasio2=$tot_rasio2+$rasio2;
                                                    $tot_rasio3=$tot_rasio3+$rasio3;
                                                    $tot_rasio4=$tot_rasio4+$rasio4;
                                                @endphp
                                                <td align='center'>
                                                {{number_format(($rasio1),2)}} % </td>
                                                <td align='center'>
                                                {{number_format(($rasio2),2)}} % </td>
                                                <td align='center'>
                                                {{number_format(($rasio3),2)}} % </td>
                                                <td align='center'>
                                                {{number_format(($rasio4),2)}} % </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="2" align='right'><b>Total</b></td>
                                            <td align='center'><b>{{$tot_keg}}</b></td>
                                            <td align='center'><b>{{number_format($tot_keterisian/$no,2)}}%</b></td>
                                            <td align='center'><b>{{number_format(($tot_rasio1/$no),2)}}%</b></td>
                                            <td align='center'><b>{{number_format(($tot_rasio2/$no),2)}}%</b></td>
                                            <td align='center'><b>{{number_format(($tot_rasio3/$no),2)}}%</b></td>
                                            <td align='center'><b>{{number_format(($tot_rasio4/$no),2)}}%</b></td>
                                            @php
                                                $ar_urusanopd[]=1;
                                                $ar_kegopd[]=$tot_keg;
                                                $ar_keterisianopd[]=$tot_keterisian/$no;
                                                $ar_rasioopd1[]=$tot_rasio1/$no;
                                                $ar_rasioopd2[]=$tot_rasio2/$no;
                                                $ar_rasioopd3[]=$tot_rasio3/$no;
                                                $ar_rasioopd4[]=$tot_rasio4/$no;
                                            @endphp
                                        </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
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
                                                        $sekda = $data_opd->where('unit_key','=',$value)->first();
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
                                            $no=0;
                                            @endphp
                                            <table class="table table-striped table-hover table-bordered">
                                            <tr>
                                                <th rowspan="2">#</th>
                                                <th rowspan="2">Program</th>
                                                <th rowspan="2" class="text-center">Jml Kegiatan</th>
                                                <th rowspan="2" class="text-center">Keterisian Data (%)</th>
                                                <th colspan=4 class="text-center">Rasio Capaian Renstra</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">2016</th>
                                                <th class="text-center">2017</th>
                                                <th class="text-center">2018</th>
                                                <th class="text-center">2019</th>
                                            </tr>
                                            @php $tot_keg=0;$tot_keterisian=0;$tot_rasio1=0;$tot_rasio2=0;$tot_rasio3=0;$tot_rasio4=0;$tot_rasio5=0;$tot_rasio6=0; @endphp
                                            @foreach($rpjmd_prog_urusan as $vp)
                                            @php 
                                                $no++; 
                                                if(($vp->jml_keg_renstra($periode))<=0){$tr="danger";}else{$tr="";}
                                                $tot_keg=$tot_keg+$vp->jml_keg_renstra($periode);    
                                            @endphp
                                                @if(($vp->jml_keg_renstra($periode))>0)
                                                <tr class="{{$tr}}">
                                                    <td>{{$no}}</td>
                                                    <td>
                                                    <a ref="#" value="{{ action('EvaluasiRenstraController@show_evaluasi_renstra',['periode'=>$periode,'idprgrm'=>$vp->idprgrm, 'id_instansi'=>$v->id_instansi, 'unit_key'=>$value]) }}" class="btn btn-xs modalMd" title="Renstra - Program : {{$vp->nmprgrm}}" data-toggle="modal" data-target="#modalMd">{{$vp->nmprgrm}}</a>
                                                    </td>
                                                    <td align='center'>{{$vp->jml_keg_renstra($periode)}}</td>
                                                    <td align='center'>
                                                        @php
                                                            $isian_keg=$vp->jml_keg_renstra($periode)*4;
                                                            $isian_k=$vp->jml_keg_k_renstra($periode)*4;

                                                            $isian=$isian_keg+$isian_k;

                                                            $risian_keg=$vp->jml_realisasi_keg_renstra($periode,'rpt1')+$vp->jml_realisasi_keg_renstra($periode,'rpt2')+$vp->jml_realisasi_keg_renstra($periode,'rpt3')+$vp->jml_realisasi_keg_renstra($periode,'rpt4');
                                                            $risian_k=$vp->jml_realisasi_keg_k_renstra($periode,'kt1')+$vp->jml_realisasi_keg_k_renstra($periode,'kt2')+$vp->jml_realisasi_keg_k_renstra($periode,'kt3')+$vp->jml_realisasi_keg_k_renstra($periode,'kt4');

                                                            $risian=$risian_keg+$risian_k;

                                                            $keterisian=($risian/$isian)*100;
                                                            if($keterisian>=100){
                                                                echo"<span class='badge badge-success'>";
                                                            }else{
                                                                echo"<span class='badge badge-danger'>";
                                                            }
                                                            
                                                            $tot_keterisian=$tot_keterisian+$keterisian;                                                           
                                                            echo number_format($keterisian,2).'%</span>';
                                                            
                                                        @endphp
                                                    </td>
                                                    @php
                                                        $re_prog=$vp->realisasi_renstra($periode);
                                                        $tr_prog=$vp->target_renstra($periode);
                                                        if($tr_prog->t_trp_1>0){
                                                            $rasio1=($re_prog->t_rpt1/$tr_prog->t_trp_1)*100;
                                                        }else{
                                                            $rasio1=0;
                                                        }                                                    if($tr_prog->t_trp_2>0){
                                                            $rasio2=($re_prog->t_rpt2/$tr_prog->t_trp_2)*100;
                                                        }else{
                                                            $rasio2=0;
                                                        }

                                                        if($tr_prog->t_trp_3>0){
                                                            $rasio3=($re_prog->t_rpt3/$tr_prog->t_trp_3)*100;
                                                        }else{
                                                            $rasio3=0;
                                                        }

                                                        if($tr_prog->t_trp_4>0){
                                                            $rasio4=($re_prog->t_rpt4/$tr_prog->t_trp_4)*100;
                                                        }else{
                                                            $rasio4=0;
                                                        }

                                                        $tot_rasio1=$tot_rasio1+$rasio1;
                                                        $tot_rasio2=$tot_rasio2+$rasio2;
                                                        $tot_rasio3=$tot_rasio3+$rasio3;
                                                        $tot_rasio4=$tot_rasio4+$rasio4;
                                                    @endphp
                                                    <td align='center'>
                                                    {{number_format(($rasio1),2)}} % </td>
                                                    <td align='center'>
                                                    {{number_format(($rasio2),2)}} % </td>
                                                    <td align='center'>
                                                    {{number_format(($rasio3),2)}} % </td>
                                                    <td align='center'>
                                                    {{number_format(($rasio4),2)}} % </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                            <tr>
                                                <td colspan="2" align='right'><b>Total</b></td>
                                                <td align='center'><b>{{$tot_keg}}</b></td>
                                                <td align='center'><b>{{number_format($tot_keterisian/$no,2)}}%</b></td>

                                                <td align='center'><b>{{number_format(($tot_rasio1/$no),2)}}%</b></td>
                                                <td align='center'><b>{{number_format(($tot_rasio2/$no),2)}}%</b></td>
                                                <td align='center'><b>{{number_format(($tot_rasio3/$no),2)}}%</b></td>
                                                <td align='center'><b>{{number_format(($tot_rasio4/$no),2)}}%</b></td>
                                            </tr>
                                            @php
                                                $ar_urusanopd[]=1;
                                                $ar_kegopd[]=$tot_keg;
                                                $ar_keterisianopd[]=$tot_keterisian/$no;
                                                $ar_rasioopd1[]=$tot_rasio1/$no;
                                                $ar_rasioopd2[]=$tot_rasio2/$no;
                                                $ar_rasioopd3[]=$tot_rasio3/$no;
                                                $ar_rasioopd4[]=$tot_rasio4/$no;
                                            @endphp
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                <table class="table table-bordered table-striped">
                                    @php
                                    $ar_toturusan[]=array_sum($ar_urusanopd);
                                    $ar_totkeg[]=array_sum($ar_kegopd);
                                    $ar_totketerisian[]=array_sum($ar_keterisianopd)/array_sum($ar_urusanopd);
                                    $ar_totrasio1[]=array_sum($ar_rasioopd1)/array_sum($ar_urusanopd);
                                    $ar_totrasio2[]=array_sum($ar_rasioopd2)/array_sum($ar_urusanopd);
                                    $ar_totrasio3[]=array_sum($ar_rasioopd3)/array_sum($ar_urusanopd);
                                    $ar_totrasio4[]=array_sum($ar_rasioopd4)/array_sum($ar_urusanopd);
                                    @endphp
                                    <tr><th>Total Kegiatan OPD</th><th align="center">{{array_sum($ar_kegopd)}}</th></tr>
                                    <tr><th>Keterisian Data</th><th align="center">
                                    <p id="tot_rasio-{{$noopd}}">
                                    {{number_format(array_sum($ar_keterisianopd)/array_sum($ar_urusanopd),2)}}%
                                    </p>
                                    </th></tr>
                                    <tr><th>Rasio Capaian 2016</th><th align="center">{{number_format(array_sum($ar_rasioopd1)/array_sum($ar_urusanopd),2)}}%</th></tr>
                                    <tr><th>Rasio Capaian 2017</th><th align="center">{{number_format(array_sum($ar_rasioopd2)/array_sum($ar_urusanopd),2)}}%</th></tr>
                                    <tr><th>Rasio Capaian 2018</th><th align="center">{{number_format(array_sum($ar_rasioopd3)/array_sum($ar_urusanopd),2)}}%</th></tr>
                                    <tr><th>Rasio Capaian 2019</th><th align="center">{{number_format(array_sum($ar_rasioopd4)/array_sum($ar_urusanopd),2)}}%</th></tr>
                                </table>
                                </div>
                            </div>
                        </div>
                        @if (Auth::guard('web')->check())
                    </div>
                </div>
                    @endif
                @endif
                @endforeach
                

                <br>
                <div class="row">
                    <div class="col-md-3">
                    <table class="table table-bordered table-striped">
                        <tr><th>Total Kegiatan</th><th align="center">{{number_format(array_sum($ar_totkeg),0)}}</th></tr>
                        <tr><th>Keterisian Data</th><th align="center">
                        {{number_format(array_sum($ar_totketerisian)/array_sum($ar_toturusan),2)}}%
                        </th></tr>
                        <tr><th>Rasio Capaian 2016</th><th align="center">{{number_format(array_sum($ar_totrasio1)/array_sum($ar_toturusan),2)}}%</th></tr>
                        <tr><th>Rasio Capaian 2017</th><th align="center">{{number_format(array_sum($ar_totrasio2)/array_sum($ar_toturusan),2)}}%</th></tr>
                        <tr><th>Rasio Capaian 2018</th><th align="center">{{number_format(array_sum($ar_totrasio3)/array_sum($ar_toturusan),2)}}%</th></tr>
                        <tr><th>Rasio Capaian 2019</th><th align="center">{{number_format(array_sum($ar_totrasio4)/array_sum($ar_toturusan),2)}}%</th></tr>
                    </table>
                    </div>
                </div>
            </div>
            </div>
            @endif
            </div>
        </div>
        </div>
    </div>

    <input type="text" hidden="hidden" id="noopd" value="{{$noopd}}">
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
    <div class="modal fade" id="modalMd" role="dialog" aria-labelledby="myModalLabel">
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

        <!-- Modal -->
        <div id="modal_ekspor" class="modal fade" style="width: 600px;
      height: 240px;
      position: center;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <table>
                    <tr><td>OPD</td><td> : <span id="modal-title"></span> 
                        <input type='hidden' id="id_instansi"/>
                        <input type="hidden" id="jenis"/>
                        </td>
                    </tr>
                    <tr><td>Periode</td><td> : <span id="periode">{{$periode}}</span></td></tr>
                    <tr>
                        <td>Rekap</td>
                        <td> : 
                            <select id="rekap">
                                <option value="Detail">Detail</option>
                                <option value="Program-OPD">Program OPD</option>
                            </select>

                        </td>
                    </tr>
                </table>

              </div>
              <div class="modal-footer">
                <style>
                  #wait_download {
                        /*cursor: pointer;*/
                        position: fixed;
                        margin: 0;
                        top: 50%;
                        left: 50%;
                        -ms-transform: translate(-50%, -50%);
                        transform: translate(-50%, -50%);
                        z-index: 9999;
                        background-color: #ffffff;
                        /*border: 1px solid black;*/
                        opacity: 0.6;
                        filter: alpha(opacity=60);
                        border-radius:10px;
                    }
                </style>
                <div id="wait_download" class="text-center"><img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}">
                    Loading...<!-- Loading -->
                </div>
                <button type="button" class="btn btn-success" id="btn_ekspor"><i class="fa fa-file-excel-o"></i> Ekspor Ke <span id="tipe"></span></button>
              </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
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
            $('.modal_ekspor').off('click').on('click', function () {
                $('.modal-title').html("Ekspor Data Evaluasi "+$(this).attr('judul'));
                $('#modal-title').html($(this).attr('title'));
                $('#tipe').html($(this).attr('tipe'));
                $('#jenis').val($(this).attr('judul'));
                $('#id_instansi').val($(this).attr('value'));
            });
        });

        var noopd=$('#noopd').val();
        var i;
        for (i = 1; i <= noopd; i++) {
          // alert('tes'+i);
          $('.tot_rasio-'+i).text($('#tot_rasio-'+i).text());
        }
    </script>

@endsection