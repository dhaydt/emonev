@extends('layouts.template')
@section('title', 'CRUD BLOG')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Renstra</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Data Renstra<small></small></h3>
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
                @php $no=0;$noopd=0; @endphp
                @foreach($opd as $v)
                @if($v->id!=1)
                @php $no++;$noopd++; @endphp

                @if (Auth::guard('web')->check())
                <div class="panel panel-info overflow-hidden">
                    <div class="panel-heading" style="padding:3px;">
                        <h3 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$v->id}}">
                                <i class="fa fa-plus-circle pull-right"></i> 
                                #{{$noopd}} - {{$v->opd->nm_instansi}}
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
                                        @php 
                                        $rpjmd_prog_non_urusan = $rpjmd_prog_non->where('id_instansi','=',$v->opd->id)->where('id_status','=',1);
                                        $no=0;
                                        @endphp
                                        <table class="table table-striped table-hover table-bordered">
                                        <tr>
                                            <th rowspan=2>#</th>
                                            <th rowspan=2>Program</th>
                                            <th rowspan=2 class="text-center">Jml Kegiatan</th>
                                            <th colspan=6 class="text-center">Target Capaian Renstra (Rp)</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">2016</th>
                                            <th class="text-center">2017</th>
                                            <th class="text-center">2018</th>
                                            <th class="text-center">2019</th>
                                            <th class="text-center">2020</th>
                                            <th class="text-center">2021</th>
                                        </tr>
                                        @php $tot_keg=0;$tot_t1=0;$tot_t2=0;$tot_t3=0;$tot_t4=0;$tot_t5=0;$tot_t6=0; @endphp
                                        @foreach($rpjmd_prog_non_urusan as $vpn)
                                        @php 
                                            $no++;
                                            if(($vpn->jml_keg_renstra($periode))<=0){$tr="danger";}else{$tr="";}
                                            $tot_keg=$tot_keg+$vpn->jml_keg_renstra($periode);
                                        @endphp
                                        <tr class="{{$tr}}">
                                            <td>{{$no}}</td>
                                            <td>
                                                <a ref="#" value="{{ action('MasterRenstraController@show_kegiatan_renstra',['periode'=>$periode,'idprgrm'=>$vpn->idprgrm, 'id_instansi'=>$v->id_instansi, 'unit_key'=>'0_']) }}" class="btn btn-xs modalMd" title="Renstra - Program : {{$vpn->nmprgrm}}" data-toggle="modal" data-target="#modalMd">{{$vpn->nmprgrm}}</a>
                                            </td>
                                            <td align='center'>
                                                {{$vpn->jml_keg_renstra($periode)}}
                                            </td>
                                            @php
                                            $t_renstra=$vpn->target_renstra($periode);
                                            $tot_t1=$tot_t1+$t_renstra->t_trp_1;
                                            $tot_t2=$tot_t2+$t_renstra->t_trp_2;
                                            $tot_t3=$tot_t3+$t_renstra->t_trp_3;
                                            $tot_t4=$tot_t4+$t_renstra->t_trp_4;
                                            $tot_t5=$tot_t5+$t_renstra->t_trp_5;
                                            $tot_t6=$tot_t6+$t_renstra->t_trp_6;
                                            @endphp
                                            <td align='center'>
                                                {{number_format($t_renstra->t_trp_1,0)}}
                                            </td>
                                            <td align='center'>
                                                {{number_format($t_renstra->t_trp_2,0)}}
                                            </td>
                                            <td align='center'>
                                                {{number_format($t_renstra->t_trp_3,0)}}
                                            </td>
                                            <td align='center'>
                                                {{number_format($t_renstra->t_trp_4,0)}}
                                            </td>
                                            <td align='center'>
                                                {{number_format($t_renstra->t_trp_5,0)}}
                                            </td>
                                            <td align='center'>
                                                {{number_format($t_renstra->t_trp_6,0)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2" align='right'><b>Total</b></td>
                                            <td align='center'><b>{{number_format($tot_keg,0)}}</b></td>
                                            <td align='center'><b>{{number_format($tot_t1,0)}}</b></td>
                                            <td align='center'><b>{{number_format($tot_t2,0)}}</b></td>
                                            <td align='center'><b>{{number_format($tot_t3,0)}}</b></td>
                                            <td align='center'><b>{{number_format($tot_t4,0)}}</b></td>
                                            <td align='center'><b>{{number_format($tot_t5,0)}}</b></td>
                                            <td align='center'><b>{{number_format($tot_t6,0)}}</b></td>
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
                                                <th rowspan=2>#</th>
                                                <th rowspan=2>Program</th>
                                                <th rowspan=2 class="text-center">Jml Kegiatan</th>
                                                <th colspan=6 class="text-center">Target Capaian Renstra (Rp)</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">2016</th>
                                                <th class="text-center">2017</th>
                                                <th class="text-center">2018</th>
                                                <th class="text-center">2019</th>
                                                <th class="text-center">2020</th>
                                                <th class="text-center">2021</th>
                                            </tr>
                                            @php 
                                            $tot_keg=0;$tot_t1=0;$tot_t2=0;$tot_t3=0;$tot_t4=0;$tot_t5=0;$tot_t6=0;
                                            @endphp
                                            @foreach($rpjmd_prog_urusan as $vp)
                                            @php 
                                                $no++; 
                                                if(($vp->jml_keg_renstra($periode))<=0){$tr="danger";}else{$tr="";}
                                                $tot_keg=$tot_keg+$vp->jml_keg_renstra($periode);    
                                            @endphp
                                            <tr class="{{$tr}}">
                                                <td>{{$no}}</td>
                                                <td>
                                                <a ref="#" value="{{ action('MasterRenstraController@show_kegiatan_renstra',['periode'=>$periode,'idprgrm'=>$vp->idprgrm, 'id_instansi'=>$v->id_instansi, 'unit_key'=>$value]) }}" class="btn btn-xs modalMd" title="Renstra - Program : {{$vp->nmprgrm}}" data-toggle="modal" data-target="#modalMd">{{$vp->nmprgrm}}</a>
                                                </td>
                                                <td align='center'>{{$vp->jml_keg_renstra($periode)}}</td>

                                                @php
                                                $t_renstra=$vp->target_renstra($periode);
                                                $tot_t1=$tot_t1+$t_renstra->t_trp_1;
                                                $tot_t2=$tot_t2+$t_renstra->t_trp_2;
                                                $tot_t3=$tot_t3+$t_renstra->t_trp_3;
                                                $tot_t4=$tot_t4+$t_renstra->t_trp_4;
                                                $tot_t5=$tot_t5+$t_renstra->t_trp_5;
                                                $tot_t6=$tot_t6+$t_renstra->t_trp_6;
                                                @endphp
                                                <td align='center'>
                                                    {{number_format($t_renstra->t_trp_1,0)}}
                                                </td>
                                                <td align='center'>
                                                    {{number_format($t_renstra->t_trp_2,0)}}
                                                </td>
                                                <td align='center'>
                                                    {{number_format($t_renstra->t_trp_3,0)}}
                                                </td>
                                                <td align='center'>
                                                    {{number_format($t_renstra->t_trp_4,0)}}
                                                </td>
                                                <td align='center'>
                                                    {{number_format($t_renstra->t_trp_5,0)}}
                                                </td>
                                                <td align='center'>
                                                    {{number_format($t_renstra->t_trp_6,0)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2" align='right'><b>Total</b></td>
                                                <td align='center'><b>{{$tot_keg}}</b></td>

                                                <td align='center'><b>{{number_format($tot_t1,0)}}</b></td>
                                                <td align='center'><b>{{number_format($tot_t2,0)}}</b></td>
                                                <td align='center'><b>{{number_format($tot_t3,0)}}</b></td>
                                                <td align='center'><b>{{number_format($tot_t4,0)}}</b></td>
                                                <td align='center'><b>{{number_format($tot_t5,0)}}</b></td>
                                                <td align='center'><b>{{number_format($tot_t6,0)}}</b></td>
                                            </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        @if (Auth::guard('web')->check())
                    </div>
                </div>
                    @endif
                @endif
                @endforeach
                
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
        });
    </script>

@endsection