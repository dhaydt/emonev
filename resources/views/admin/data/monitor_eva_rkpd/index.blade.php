@extends('layouts.template')
@section('title', 'CRUD BLOG')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Monitoring Evaluasi RKPD</li>
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
            <h4 class="panel-title">Monitoring Evaluasi RKPD {{$data_renja}}</h4>
        </div>
        <div class="panel-body">
            
        <form class="form-inline" id='form_cari_periode' action="" method="get">
            <div class="form-group m-r-10">
                Pilih Periode RKPD : <select name="periode" id="pilih_periode" class="form-control" onchange="cari_data();cari_triwulan();">
                    <option value="">Pilih Periode</option>
                    @php 
                    $thn=2020;
                    for($t=2020;$t<=$thn;$t++){
                        if($periode==$t){$sel="selected";}else{$sel="";}
                        echo"<option $sel>$t</option>";
                    }
                    @endphp
                </select>
                <select name='pilih_triwulan' id="pilih_triwulan" class="form-control" onchange="cari_data()">
                    <option value="">Pilih Triwulan</option>
                </select>
                <input type="hidden" name="data_renja" id="data_renja" value="{{$data_renja}}">
                <span style="color:red;font-size: 20px"><b>{{$data_renja}}</b></span>
                <script type="text/javascript">
                    $(document).ready(function(){
                        cari_triwulan();
                    });
                    
                    function cari_triwulan(){
                        var periode=$('#pilih_periode').val();
                        var triwulan=$('#pilih_triwulan').val();
                        var data_renja=$('#data_renja').val();
                    
                    if(periode!=""){
                            $.ajaxSetup({
                                headers: {
                                    // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            
                            var url="{{ url('settings_triwulan') }}/"+periode;
                            $.ajax({
                                type    : "GET",
                                url     : url,
                                dataType: 'json',
                                success : function (data) {
                                    $('#pilih_triwulan').empty();
                                    $('#pilih_triwulan').append('<option value="">Pilih Triwulan</option>');
                                    
                                    if(data.store.tw1==0 || (data_renja!=data.store.tw1_src && data_renja=='awal')){var distw1="disabled=disabled";}
                                    if(data.store.tw2==0 || (data_renja!=data.store.tw2_src && data_renja=='awal')){var distw2="disabled=disabled";}
                                    if(data.store.tw3==0 || (data_renja!=data.store.tw3_src && data_renja=='awal')){var distw3="disabled=disabled";}
                                    if(data.store.tw4==0 || (data_renja!=data.store.tw4_src && data_renja=='awal')){var distw4="disabled=disabled";}
                                    
                                    var tw={{$triwulan}}+null;
                                    if(tw==1){var ctw1="selected=selected"}
                                    if(tw==2){var ctw2="selected=selected"}
                                    if(tw==3){var ctw3="selected=selected"}
                                    if(tw==4){var ctw4="selected=selected"}
                                    
                                    $('#pilih_triwulan').append('<option value=1 '+distw1+' '+ctw1+'>Triwulan 1</option>');
                                    $('#pilih_triwulan').append('<option value=2 '+distw2+' '+ctw2+'>Triwulan 2</option>');
                                    $('#pilih_triwulan').append('<option value=3 '+distw3+' '+ctw3+'>Triwulan 3</option>');
                                    $('#pilih_triwulan').append('<option value=4 '+distw4+' '+ctw4+'>Triwulan 4</option>');
                                    //console.log(data.store);
                                },
                                error: function (jqXHR, status, thrownError) {
                                    alert('error');
                                    console.log(thrownError);
                                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                                            console.log(responseText);
                                            //$('#wait').hide();
                                }
                            });

                        }
                    }
                    
                    function cari_data(){
                        // alert('tes'+periode+'/'+triwulan);
                        var periode=$('#pilih_periode').val();
                        var triwulan=$('#pilih_triwulan').val();
                        
                        if((periode!="" && triwulan!="") || periode=="" && triwulan==""){
                            // alert('submit');
                            $('#wait_periode').show();
                            $('#form_cari_periode').submit();
                        }
                    }
                </script>
                <div id="wait_periode"><img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}">
                    Loading...<!-- Loading -->
                </div>
            </div>
        </form>
        
        @if($periode!="")
        <br>

            @if ($message = Session::get('sukses'))
                <div id="notif" class="alert alert-success" style="padding:0px;">
                    <p>{{$message}}</p>
                </div>
            @endif


            <div class="panel-group" id="accordion">
                @if (Auth::guard('web')->check())
                <p>
                    <i class="label label-default">&nbsp;</i> Triwulan 1
                    <i class="label label-inverse">&nbsp;</i> Triwulan 2
                    <i class="label label-warning">&nbsp;</i> Triwulan 3
                    <i class="label label-danger">&nbsp;</i> Triwulan 4
                </p>
                @endif

                @php $no=0; $tot_pagu=0; $tot_real=0; 
                $tot_sr=0;
                $tot_r=0;
                $tot_s=0;
                $tot_t=0;
                $tot_st=0;
                @endphp
                @foreach($opd as $v)
                @if($v->id!=1)
                @php $no++; $tot_opd_pagu=0; $tot_opd_real=0; 

                $jml_sr_opd=0;
                $jml_r_opd=0;
                $jml_s_opd=0;
                $jml_t_opd=0;
                $jml_st_opd=0;
                @endphp
			
				@if (Auth::guard('web')->check())
                	
                <div class="panel panel-info overflow-hidden">
                    <div class="panel-heading" style="padding:3px;">
                        <h3 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$v->id}}">
                                #{{$no}} - {{$v->opd->nm_instansi}}

                                <!-- PROGRESS REALISASI -->
                                @php
                                $total_keg_rpk = $v->opd->pjml_keg($periode,$v->id_instansi,$data_renja)+$v->opd->pjml_keg_k($periode,$v->id_instansi,$data_renja);

                                $triwulan_1=@(($v->opd->pjml_realisasi_keg($periode,'rpt1',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt1',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                                
                                $triwulan_2=@(($v->opd->pjml_realisasi_keg($periode,'rpt2',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt2',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                                
                                $triwulan_3=@(($v->opd->pjml_realisasi_keg($periode,'rpt3',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt3',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                                

                                $triwulan_4=@(($v->opd->pjml_realisasi_keg($periode,'rpt4',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt4',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;

                                @endphp
                                <i class="fa fa-plus-circle pull-right"></i> 
                                <i class="label label-danger pull-right">{{number_format($triwulan_4,2)}}%</i> 
                                <i class="label label-warning pull-right">{{number_format($triwulan_3,2)}}%</i> 
                                <i class="label label-inverse pull-right">{{number_format($triwulan_2,2)}}%</i> 
                                <i class="label label-default text-inverse pull-right">{{number_format($triwulan_1,2)}}%</i> 
                            </a>
                        </h3>
                    </div>
				
                    <div id="collapse{{$v->id}}" class="panel-collapse collapse bg-silver">
                
                @endif

                    @php
                    
                        $triwulan_1=0;
                        $triwulan_2=0;
                        $triwulan_3=0;
                        $triwulan_4=0;

                        $dist1="";
                        $dist2="";
                        $dist3="";
                        $dist4="";
                      
                    @endphp
                    
                        <div class="panel-body" style="padding:10px;">
                            
                             <!-- akordion non urusan -->
                             @php 
                             $rpjmd_prog_non_urusan = $rpjmd_prog_non->where('id_instansi','=',$v->opd->id)->where('id_status','=',1);
                             @endphp

                             @if($rpjmd_prog_non_urusan->count()>0)
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
                                                <th rowspan=2>#</th>
                                                <th rowspan=2>Program</th>
                                                <th rowspan=2 class="text-center">Pagu Indikatif (Rp)</th>
                                                <th rowspan=2 class="text-center">Realisasi</th>
                                                <th rowspan=2 class="text-center">Predikat Kinerja</th>
                                                <th rowspan=2 class="text-center">Jml Kegiatan</th>
                                                <th colspan=5 class="text-center">Persentase Realisasi Kegiatan</th>
											</tr>
											<tr>
                                                <th class="text-center">SR (0-50 %)</th>
                                                <th class="text-center">R (51-65 %)</th>
                                                <th class="text-center">S (66-75 %)</th>
                                                <th class="text-center">T (76-90 %)</th>
                                                <th class="text-center">ST (>90%)</th>
                                            </tr>
                                            @php $nonno=1; $tot_keg=0; $tot_urusan_pagu=0; $tot_urusan_real=0; 

                                            $jml_sr_urusan=0;
                                            $jml_r_urusan=0;
                                            $jml_s_urusan=0;
                                            $jml_t_urusan=0;
                                            $jml_st_urusan=0;
                                            @endphp
                                            
                                            
                                            @foreach($rpjmd_prog_non_urusan as $vpn)
											
                                                @php

												
                                                $tot_keg=$tot_keg+$vpn->jml_keg($periode,$data_renja);

                                                
                                                @endphp
                                                <tr>
                                                    <td>{{$nonno++}}</td>
                                                    <td>
                                                        <a ref="#" value="{{ action('MonitoringEvaRkpdController@show_evaluasi_renja',['periode'=>$periode,'triwulan'=>$triwulan,'idprgrm'=>$vpn->idprgrm, 'id_instansi'=>$v->id_instansi,'data_renja'=>$data_renja]) }}" class="btn btn-xs modalMd" title="Renja - Program : {{$vpn->nmprgrm}}" data-toggle="modal" data-target="#modalMd" style="white-space: pre-wrap;">{{$vpn->nmprgrm}}</a>
                                                    </td>
                                                    @php
													$pagu=$vpn->rp_keg($periode,$data_renja)->pagu;
													$real=$vpn->rp_real_keg($periode,$triwulan,$data_renja)->real;
													$tot_urusan_pagu=$tot_urusan_pagu+$pagu;
													$tot_urusan_real=$tot_urusan_real+$real;

                                                    $p_predikat=@($real/$pagu*100);
                                                    if($p_predikat>90){$predikat="ST";}
                                                    elseif($p_predikat>=76){$predikat="T";}
                                                    elseif($p_predikat>=66){$predikat="S";}
                                                    elseif($p_predikat>=51){$predikat="R";}
                                                    else{$predikat="SR";}

                                        $jml_sr=$vpn->jml_keg_predikat($periode,$triwulan,'SR',$pagu,$data_renja);
                                        $jml_r=$vpn->jml_keg_predikat($periode,$triwulan,'R',$pagu,$data_renja);
                                        $jml_s=$vpn->jml_keg_predikat($periode,$triwulan,'S',$pagu,$data_renja);
                                        $jml_t=$vpn->jml_keg_predikat($periode,$triwulan,'T',$pagu,$data_renja);
                                        $jml_st=$vpn->jml_keg_predikat($periode,$triwulan,'ST',$pagu,$data_renja);

                                                    $jml_sr_urusan=$jml_sr_urusan+$jml_sr;
                                                    $jml_r_urusan=$jml_r_urusan+$jml_r;
                                                    $jml_s_urusan=$jml_s_urusan+$jml_s;
                                                    $jml_t_urusan=$jml_t_urusan+$jml_t;
                                                    $jml_st_urusan=$jml_st_urusan+$jml_st;
													@endphp
													<td align="right">{{number_format($pagu,0)}}</td>
                                                    <td align="right">{{number_format($real,0)}}</td>
                                                    <td align="right">{{number_format($p_predikat,2)}}% ({{$predikat}})</td>
                                                    <td align="center">{{$vpn->jml_keg($periode,$data_renja)}}</td>
                                                    <td align="center"><span class="" style="font-size:12px;">{{$jml_sr}}</span></td>
                                                    <td align="center"><span class="" style="font-size:12px;">{{$jml_r}}</span></td>
                                                    <td align="center"><span class="" style="font-size:12px;">{{$jml_s}}</span></td>
                                                    <td align="center"><span class="" style="font-size:12px;">{{$jml_t}}</span></td>
                                                    <td align="center"><span class="" style="font-size:12px;">{{$jml_st}}</span></td>
													
                                            @endforeach

											@php
											$tot_opd_pagu=$tot_opd_pagu+$tot_urusan_pagu;
											$tot_opd_real=$tot_opd_real+$tot_urusan_real;

                                            $p_predikat=@($tot_urusan_real/$tot_urusan_pagu*100);
                                            if($p_predikat>90){$predikat="ST";}
                                            elseif($p_predikat>=76){$predikat="T";}
                                            elseif($p_predikat>=66){$predikat="S";}
                                            elseif($p_predikat>=51){$predikat="R";}
                                            else{$predikat="SR";}

                                            $jml_sr_opd=$jml_sr_opd+$jml_sr_urusan;
                                            $jml_r_opd=$jml_r_opd+$jml_r_urusan;
                                            $jml_s_opd=$jml_s_opd+$jml_s_urusan;
                                            $jml_t_opd=$jml_t_opd+$jml_t_urusan;
                                            $jml_st_opd=$jml_st_opd+$jml_st_urusan;
											@endphp
                                            <tr>
                                                <td colspan="2" align='right'><b>Total Kegiatan</b></td>
                                                <td align='right'><b>{{number_format($tot_urusan_pagu,0)}}</b></td>
                                                <td align='right'><b>{{number_format($tot_urusan_real,0)}}</b></td>
                                                <td align="right">{{number_format($p_predikat,2)}}% ({{$predikat}})</td>
                                                <td align='center'><b>{{$tot_keg}}</b></td>
                                                <td align='center'><b>{{$jml_sr_urusan}}</b></td>
                                                <td align='center'><b>{{$jml_r_urusan}}</b></td>
                                                <td align='center'><b>{{$jml_s_urusan}}</b></td>
                                                <td align='center'><b>{{$jml_t_urusan}}</b></td>
                                                <td align='center'><b>{{$jml_st_urusan}}</b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- end akordion non urusan -->
                            
                            @php 
                                $pecah=explode(",",$v->arr_urusan); 
                                $no2=0;
                                
                            @endphp
                            @foreach($pecah as $value)
                            @php 
                                $no2++;

                            @endphp
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
                                                <th rowspan=2>#</th>
                                                <th rowspan=2>Program</th>
                                                <th rowspan=2 class="text-center">Pagu Indikatif (Rp)</th>
                                                <th rowspan=2 class="text-center">Realisasi</th>
                                                <th rowspan=2 class="text-center">Predikat Kinerja</th>
                                                <th rowspan=2 class="text-center">Jml Kegiatan</th>
                                                <th colspan=5 class="text-center">Persentase Realisasi Kegiatan</th>
											</tr>
											<tr>
                                                <th class="text-center">SR (0-50 %)</th>
                                                <th class="text-center">R (51-65 %)</th>
                                                <th class="text-center">S (66-75 %)</th>
                                                <th class="text-center">T (76-90 %)</th>
                                                <th class="text-center">ST (>90%)</th>
                                            </tr>
                                            
                                                @php $urno=1; $tot_keg=0; $tot_urusan_pagu=0; $tot_urusan_real=0;
                                                $jml_sr_urusan=0;
                                                $jml_r_urusan=0;
                                                $jml_s_urusan=0;
                                                $jml_t_urusan=0;
                                                $jml_st_urusan=0;
                                                 @endphp
                                                @foreach($rpjmd_prog_urusan as $vp)
                                                    @php
                                                    $tot_keg=$tot_keg+$vp->jml_keg($periode,$data_renja);

                                                    @endphp
                                                    
                                                    @if($vp->jml_keg($periode,$data_renja)>0)
                                                    <tr>
                                                        <td>{{$urno++}}</td>
                                                        <td>
                                                            <a ref="#" value="{{ action('MonitoringEvaRkpdController@show_evaluasi_renja',['periode'=>$periode,'triwulan'=>$triwulan,'idprgrm'=>$vp->idprgrm, 'id_instansi'=>$v->id_instansi,'data_renja'=>$data_renja]) }}" class="btn btn-xs modalMd" title="Renja - Program : {{$vp->nmprgrm}}" data-toggle="modal" data-target="#modalMd" style="white-space: pre-wrap;">{{$vp->nmprgrm}}</a>
                                                        </td>
														@php
														$pagu=$vp->rp_keg($periode,$data_renja)->pagu;
														$real=$vp->rp_real_keg($periode,$triwulan,$data_renja)->real;
														
														$tot_urusan_pagu=$tot_urusan_pagu+$pagu;
														$tot_urusan_real=$tot_urusan_real+$real;
														
														//$tot_opd_pagu=$tot_opd_pagu+$tot_urusan_pagu;
														//$tot_opd_real=$tot_opd_real+$tot_urusan_real;
													   
                                                       $p_predikat=@($real/$pagu*100);
                                                        if($p_predikat>90){$predikat="ST";}
                                                    elseif($p_predikat>=76){$predikat="T";}
                                                    elseif($p_predikat>=66){$predikat="S";}
                                                    elseif($p_predikat>=51){$predikat="R";}
                                                    else{$predikat="SR";}

                                                        $jml_sr=$vp->jml_keg_predikat($periode,$triwulan,'SR',$pagu,$data_renja);
                                                        $jml_r=$vp->jml_keg_predikat($periode,$triwulan,'R',$pagu,$data_renja);
                                                        $jml_s=$vp->jml_keg_predikat($periode,$triwulan,'S',$pagu,$data_renja);
                                                        $jml_t=$vp->jml_keg_predikat($periode,$triwulan,'T',$pagu,$data_renja);
                                                        $jml_st=$vp->jml_keg_predikat($periode,$triwulan,'ST',$pagu,$data_renja);

                                                                    $jml_sr_urusan=$jml_sr_urusan+$jml_sr;
                                                                    $jml_r_urusan=$jml_r_urusan+$jml_r;
                                                                    $jml_s_urusan=$jml_s_urusan+$jml_s;
                                                                    $jml_t_urusan=$jml_t_urusan+$jml_t;
                                                                    $jml_st_urusan=$jml_st_urusan+$jml_st;
														@endphp
														<td align="right">{{number_format($pagu,0)}}</td>
														<td align="right">{{number_format($real,0)}}</td>
                                                        <td align="right">{{number_format($p_predikat,2)}}% ({{$predikat}})</td>
                                                        <td align="center">{{$vp->jml_keg($periode,$data_renja)}}</td>
                                                        <td align="center"><span class="" style="font-size:12px;">{{$jml_sr}}</span></td>
                                                        <td align="center"><span class="" style="font-size:12px;">{{$jml_r}}</span></td>
                                                        <td align="center"><span class="" style="font-size:12px;">{{$jml_s}}</span></td>
                                                        <td align="center"><span class="" style="font-size:12px;">{{$jml_t}}</span></td>
                                                        <td align="center"><span class="" style="font-size:12px;">{{$jml_st}}</span></td>
                                                    </tr>
                                                    @endif
                                                @endforeach

													@php
													$tot_opd_pagu=$tot_opd_pagu+$tot_urusan_pagu;
													$tot_opd_real=$tot_opd_real+$tot_urusan_real;

                                                    $p_predikat=@($tot_urusan_real/$tot_urusan_pagu*100);
                                                    if($p_predikat>90){$predikat="ST";}
                                                    elseif($p_predikat>=76){$predikat="T";}
                                                    elseif($p_predikat>=66){$predikat="S";}
                                                    elseif($p_predikat>=51){$predikat="R";}
                                                    else{$predikat="SR";}


                                                    $jml_sr_opd=$jml_sr_opd+$jml_sr_urusan;
                                                    $jml_r_opd=$jml_r_opd+$jml_r_urusan;
                                                    $jml_s_opd=$jml_s_opd+$jml_s_urusan;
                                                    $jml_t_opd=$jml_t_opd+$jml_t_urusan;
                                                    $jml_st_opd=$jml_st_opd+$jml_st_urusan;

													@endphp
                                                <tr>
                                                    <td colspan="2" align='right'><b>Total Kegiatan</b></td>
													<td align='right'><b>{{number_format($tot_urusan_pagu,0)}}</b></td>
													<td align='right'><b>{{number_format($tot_urusan_real,0)}}</b></td>
                                                    <td align="right">{{number_format($p_predikat,2)}}% ({{$predikat}})</td>
                                                    <td align='center'><b>{{$tot_keg}}</b></td>
                                                    <td align='center'><b>{{$jml_sr_urusan}}</b></td>
                                                    <td align='center'><b>{{$jml_r_urusan}}</b></td>
                                                    <td align='center'><b>{{$jml_s_urusan}}</b></td>
                                                    <td align='center'><b>{{$jml_t_urusan}}</b></td>
                                                    <td align='center'><b>{{$jml_st_urusan}}</b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
						@php
						$tot_pagu=$tot_pagu+$tot_opd_pagu;
						$tot_real=$tot_real+$tot_opd_real;

                        $p_predikat=@($tot_opd_real/$tot_opd_pagu*100);
                        if($p_predikat>90){$predikat="ST";}
                        elseif($p_predikat>=76){$predikat="T";}
                        elseif($p_predikat>=66){$predikat="S";}
                        elseif($p_predikat>=51){$predikat="R";}
                        else{$predikat="SR";}

                        $tot_sr=$tot_sr+$jml_sr_opd;
                        $tot_r =$tot_r +$jml_r_opd;
                        $tot_s =$tot_s +$jml_s_opd;
                        $tot_t =$tot_t +$jml_t_opd;
                        $tot_st=$tot_st+$jml_st_opd;
						@endphp
						<h4 class='alert alert-success'><b>TOTAL PAGU RENJA OPD: {{number_format($tot_opd_pagu,0)}} | TOTAL REALISASI OPD: {{number_format($tot_opd_real,0)}} | ({{number_format($p_predikat,2)}}%  - {{$predikat}})</b></h4>
                        <div class="col-md-3">
                        <table class="table table-bordered table-striped">
                            <tr><th class="text-center">Capaian Kinerja</th><th>Jumlah Kegiatan</th></tr>
                            <tr><th class="text-center">SR (0-50 %)</th><th>{{$jml_sr_opd}}</th></tr>
                            <tr><th class="text-center">R (51-65 %)</th><th>{{$jml_r_opd}}</th></tr>
                            <tr><th class="text-center">S (66-75 %)</th><th>{{$jml_s_opd}}</th></tr>
                            <tr><th class="text-center">T (76-90 %)</th><th>{{$jml_t_opd}}</th></tr>
                            <tr><th class="text-center">ST (>90%)</th><th>{{$jml_st_opd}}</th></tr>
                        </table>
                        </div>
				@if (Auth::guard('web')->check())		
					</div>
				
	
                </div>
				@endif
				
				
				
                @endif
                @endforeach
                
            </div>
			@if (Auth::guard('web')->check())
                @php
                    $p_predikat=@($tot_real/$tot_pagu*100);
                    if($p_predikat>90){$predikat="ST";}
                    elseif($p_predikat>=76){$predikat="T";}
                    elseif($p_predikat>=66){$predikat="S";}
                    elseif($p_predikat>=51){$predikat="R";}
                    else{$predikat="SR";}
                @endphp
				<h4 class='alert alert-default'><b>TOTAL PAGU: {{number_format($tot_pagu,0)}} | TOTAL REALISASI : {{number_format($tot_real,0)}} | ({{number_format($p_predikat,2)}}%  - {{$predikat}})</b></h4>
                <div class="col-md-3">
                <table class="table table-bordered table-striped">
                    <tr><th class="text-center">Capaian Kinerja Keseluruhan</th><th>Jumlah Kegiatan</th></tr>
                    <tr><th class="text-center">SR (0-50 %)</th><th>{{$tot_sr}}</th></tr>
                    <tr><th class="text-center">R (51-65 %)</th><th>{{$tot_r}}</th></tr>
                    <tr><th class="text-center">S (66-75 %)</th><th>{{$tot_s}}</th></tr>
                    <tr><th class="text-center">T (76-90 %)</th><th>{{$tot_t}}</th></tr>
                    <tr><th class="text-center">ST (>90%)</th><th>{{$tot_st}}</th></tr>
                </table>
                </div>
			@endif
				
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
              <div class="modal-header" style="padding:2px;background-color: #FF1B05;">
                  <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; <b>Close</b></span></button>
                  
                  <h4 class="modal-title" id="modalMdTitle" style="color: #fff;"></h4>
              </div>
              <div class="modal-body" style="padding:5px;padding-top: 0px;padding-bottom: 0px;background-color: #fff7c5">
                    <style>
                      #wait {
                            /*cursor: pointer;*/
                            position: fixed;
                            margin: 0;
                            top: 50%;
                            left: 50%;
                            -ms-transform: translate(-50%, -50%);
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
                    <td>Triwulan</td>
                    <td> : 
                        <select id="triwulan">
                            <option @if($triwulan==1) selected @endif>I</option>
                            <option @if($triwulan==2) selected @endif>II</option>
                            <option @if($triwulan==3) selected @endif>III</option>
                            <option @if($triwulan==4) selected @endif>IV</option>
                        </select>

                    </td>
                </tr>
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
        $('#wait').hide();
        $('#wait_download').hide();
        $('#wait_periode').hide();
        // $("#periode").change(function() {
            // $('#wait_periode').show();
        // });
        $(document).ajaxStart(function(){
            $('#wait').show();
        });

        $(document).on('ajaxComplete ready', function () {
            $('.modalMd').off('click').on('click', function () {
                $('#modalMdContent').load($(this).attr('value'), function( response, status, xhr ) {
                  if ( status == "error" ) {
                    var msg = "Sorry but there was an error: ";
                    alert( msg + xhr.status + " " + xhr.statusText );
                  }
                });
                // $('#modalMdContent').load($(this).attr('http://web.com/input/1/2010'));
                $('#modalMdTitle').html($(this).attr('title'));

                //$('#wait').hide();
            });

            $('.modal_ekspor').off('click').on('click', function () {
                $('.modal-title').html("Ekspor Data Evaluasi "+$(this).attr('judul'));
                $('#modal-title').html($(this).attr('title'));
                $('#tipe').html($(this).attr('tipe'));
                $('#jenis').val($(this).attr('judul'));
                $('#id_instansi').val($(this).attr('value'));
            });
        });

        $("#btn_ekspor").click(function(e) {
            @if($periode!="")

            $('#wait_download').show();
            var triwulan = $('#triwulan').val();
            var id_instansi = $('#id_instansi').val();
            var jenis = $('#jenis').val();
            var rekap = $('#rekap').val();
            
            url = "{{url('evaluasi_renja_excel/'.$periode)}}/"+jenis+"/"+id_instansi+"/"+triwulan+"/"+rekap;
            window.open(url);
            $('#wait_download').hide();
            
            @endif
        });

        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".ste55").click(function() {
            $('#wait').show();
            var nmfield=$(this).attr('name');
            var vfield=$(this).val();
            var id_instansi=$(this).attr('idi');
            var periode=2018;
            // alert(nmfield);
            // alert(vfield);
            @php
            if($periode!=null){
            @endphp
                var periode= {{$periode}};
            @php
            }
            @endphp
            var url="{{ route('status-evaluasi-renja.store') }}";
            var formData = {
                nmfield: nmfield,
                vfield: vfield,
                id_instansi: id_instansi,
                periode: periode,
            }
            console.log(formData);
            $.ajax({
                type    : "POST",
                url     : url,
                data    : formData,
                dataType: 'json',
                success : function (data) {
                    alert(data.msg);
                    console.log(data.store);
                    $('#wait').hide();
                },
                error: function (jqXHR, status, thrownError) {
                    alert('error');
                    console.log(thrownError);
                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(responseText);
                            $('#wait').hide();
                }
            });
            
        });

        
    </script>
@endsection