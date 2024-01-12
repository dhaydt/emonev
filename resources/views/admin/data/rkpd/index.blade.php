@extends('layouts.template')
@section('title', 'CRUD BLOG')
@section('content')
<?php $dist1=""; $dist2=""; $dist3=""; $dist4="";?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Evaluasi RKPD</li>
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
            
        <form class="form-inline" id='form_cari_periode' action="" method="get">
            <div class="form-group m-r-10">
                Pilih Periode RKPD : <select name="periode" id="pilih_periode" class="form-control" onchange="cari_data();cari_triwulan();">
                    <option value="">Pilih Periode</option>
                    @foreach ($periode_renja as $per)
                        <option @if($periode==$per->id) selected @endif>{{ $per->id }}</option>
                    @endforeach
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
									
                                    if(data_renja=="awal"){
                                    if(data.store.tw1==0 || (data_renja!=data.store.tw1_src)){var distw1="disabled=disabled";}
									if(data.store.tw2==0 || (data_renja!=data.store.tw2_src)){var distw2="disabled=disabled";}
									if(data.store.tw3==0 || (data_renja!=data.store.tw3_src)){var distw3="disabled=disabled";}
									if(data.store.tw4==0 || (data_renja!=data.store.tw4_src)){var distw4="disabled=disabled";}
									}else{
									if(data.store.tw1==0){var distw1="disabled=disabled";}
									if(data.store.tw2==0){var distw2="disabled=disabled";}
									if(data.store.tw3==0){var distw3="disabled=disabled";}
									if(data.store.tw4==0){var distw4="disabled=disabled";}
									}
									
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
                <a ref="#" value="4" jenis="e19" class="btn btn-primary btn-sm modal_ekspor" data-toggle="modal" data-target="#modal_ekspor" title="Semua" judul="RKPD Per-Urusan" tipe="Excel"><i class="fa fa-book"></i> Expor Evaluasi RKPD Per-Urusan</a><hr/>
                <p>
                    <i class="label label-default">&nbsp;</i> Triwulan 1
                    <i class="label label-inverse">&nbsp;</i> Triwulan 2
                    <i class="label label-warning">&nbsp;</i> Triwulan 3
                    <i class="label label-danger">&nbsp;</i> Triwulan 4
                </p>
                @endif

                @php $no=0; $tot_pagu=0; $tot_real=0; @endphp
                @foreach($opd as $v)
                @if($v->id!=0)
                @php $no++; $tot_opd_pagu=0; $tot_opd_real=0; @endphp
			
				@if (Auth::guard('web')->check())
                	
                <div class="panel panel-info overflow-hidden">
                    <div class="panel-heading" style="padding:3px;">
                        <h3 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$v->id}}">
                                #{{$no}} - {{$v->opd->nm_instansi??''}}

                                <!-- PROGRESS REALISASI -->
                                @php
                                $total_keg_rpk = $v->opd->pjml_keg($periode,$v->id_instansi,$data_renja)??0+$v->opd->pjml_keg_k($periode,$v->id_instansi,$data_renja);

                                $triwulan_1=@(($v->opd->pjml_realisasi_keg($periode,'rpt1',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt1',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                                
                                $triwulan_2=@(($v->opd->pjml_realisasi_keg($periode,'rpt2',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt2',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                                
                                $triwulan_3=@(($v->opd->pjml_realisasi_keg($periode,'rpt3',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt3',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                                

                                $triwulan_4=@(($v->opd->pjml_realisasi_keg($periode,'rpt4',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt4',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;

                                @endphp
                                <i class="fa fa-plus-circle pull-right"></i> 
                                <i class="label label-danger pull-right">{{number_format($triwulan_4,2)}}%</i> 
                            </a>
                        </h3>
                    </div>
				
                    <div id="collapse{{$v->id}}" class="panel-collapse collapse bg-silver">
                
                @endif

                    @php
                    if (Auth::guard('opd')->check()){
                        $total_keg_rpk = $v->opd->pjml_keg($periode,$v->id_instansi,$data_renja)+$v->opd->pjml_keg_k($periode,$v->id_instansi,$data_renja);
                        if($total_keg_rpk>0){
                            $triwulan_1=(($v->opd->pjml_realisasi_keg($periode,'rpt1',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt1',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                            
                            $triwulan_2=(($v->opd->pjml_realisasi_keg($periode,'rpt2',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt2',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                            
                            $triwulan_3=(($v->opd->pjml_realisasi_keg($periode,'rpt3',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt3',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                            
                            $triwulan_4=(($v->opd->pjml_realisasi_keg($periode,'rpt4',$v->id_instansi,$data_renja)+$v->opd->pjml_realisasi_keg_k($periode,'kt4',$v->id_instansi,$data_renja))/$total_keg_rpk)*100;
                        }else{
                            $triwulan_1=0;
                            $triwulan_2=0;
                            $triwulan_3=0;
                            $triwulan_4=0;
                        }


                        if($triwulan_1>=100){$dist1="";}else{$dist1="disabled";}
                        if($triwulan_2>=100){$dist2="";}else{$dist2="disabled";}
                        if($triwulan_3>=100){$dist3="";}else{$dist3="disabled";}
                        if($triwulan_4>=100){$dist4="";}else{$dist4="disabled";}
                      }else{
                        $triwulan_1=0;
                        $triwulan_2=0;
                        $triwulan_3=0;
                        $triwulan_4=0;

                        if(@Auth::user()->level=='Super Admin'){
                            $dist1="";
                            $dist2="";
                            $dist3="";
                            $dist4="";
                        }else{
                            $dist1="disabled";
                            $dist2="disabled";
                            $dist3="disabled";
                            $dist4="disabled";
                        }
                        
                      }
                    @endphp
                    <h5 class="text text-inverse bg-success" style="margin:0px;">Mohon dipilih <b>Sudah Selesai</b> jika sudah selesai menginputkan Realisasi Triwulan Renja. <span><b>Pilihan sudah selesai akan aktif apabila keterisian data sudah mencapai <span style="color:red;">100%</span></b></span></h5>
                    <form class="update e55">
                    <table width="100%" class="table table-bordered">
                        <tr>
                            @php
                            /*
                            <th>Triwulan I 
                                @if (Auth::guard('opd')->check())
                                ({{number_format($triwulan_1,2)}}%) 
                                @endif
                            </th> 
                            <th>Triwulan II 
                                @if (Auth::guard('opd')->check())
                                ({{number_format($triwulan_2,2)}}%) 
                                @endif
                            </th>
                            <th>Triwulan III 
                                @if (Auth::guard('opd')->check())
                                ({{number_format($triwulan_3,2)}}%) 
                                @endif
                            </th>
                            */
                            @endphp
                            <th>Triwulan IV
                                @if (Auth::guard('opd')->check())
                                Triwulan IV ({{number_format($triwulan_4,2)}}%)
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <td>
                                @php
                                    $cs_t1="checked";
                                    $cs_t12="";
                                    $cs_t2="checked";
                                    $cs_t22="";
                                    $cs_t3="checked";
                                    $cs_t32="";
                                    $cs_t4="checked";
                                    $cs_t42="";
                                $status_e55=$statuse55->where('id_instansi',$v->id_instansi)->where('thn',$periode)->first();
                                if($status_e55!=null){
                                    if($status_e55->st1==1){$cs_t1="";$cs_t12="checked=checked";}
                                    if($status_e55->st2==1){$cs_t2="";$cs_t22="checked=checked";}
                                    if($status_e55->st3==1){$cs_t3="";$cs_t32="checked=checked";}
                                    if($status_e55->st4==1){$cs_t4="";$cs_t42="checked=checked";}
                                }
                                @endphp
                                <input type="radio" hidden name='st1' idi="{{$v->id_instansi}}" value="0" {{$cs_t1}} class="ste55" {{$dist1}}>
                                <!-- Belum -->
                                <input type="radio" hidden name='st1' idi="{{$v->id_instansi}}" value="1" {{$cs_t12}} class="ste55" {{$dist1}}>
                                <!-- Sudah Selesai -->
                            <!-- </td>
                            <td> -->
                                <input type="radio" hidden name='st2' idi="{{$v->id_instansi}}" value="0" {{$cs_t2}} class="ste55" {{$dist2}}>
                                <!-- Belum -->
                                <input type="radio" hidden name='st2' idi="{{$v->id_instansi}}" value="1" {{$cs_t22}} class="ste55" {{$dist2}}>
                                <!-- Sudah Selesai -->
                            <!-- </td>
                            <td> -->
                                <input type="radio" hidden name='st3' idi="{{$v->id_instansi}}" value="0" {{$cs_t3}} class="ste55" {{$dist3}}>
                                <!-- Belum -->
                                <input type="radio" hidden name='st3' idi="{{$v->id_instansi}}" value="1" {{$cs_t32}} class="ste55" {{$dist3}}>
                                <!-- Sudah Selesai -->
                            <!-- </td>
                            <td> -->
                                <input type="radio" name='st4' idi="{{$v->id_instansi}}" value="0" {{$cs_t4}} class="ste55" {{$dist4}}>Belum
                                <input type="radio" name='st4' idi="{{$v->id_instansi}}" value="1" {{$cs_t42}} class="ste55" {{$dist4}}>Sudah Selesai
                            </td>
                        </tr>
                    </table>
				    </form>
                        <div class="panel-body" style="padding:10px;">
                            <label>Ekspor Evaluasi Renja Periode: {{$periode}}</label>
                            <div class="btn-group">
                                 <a ref="#" value="{{$v->id_instansi}}" jenis="e55" class="btn btn-warning btn-xs tcmodal_ekspor" data-toggle="modal" data-target="#tcmodal_ekspor" title="{{$v->opd->nm_instansi??''}}" tipe="Excel" judul="Renja"><i class="fa fa-print"></i> t-c.19</a>
                                 
                             </div> <div class="btn-group">
                                 <a ref="#" value="{{$v->id_instansi}}" jenis="e55" class="btn btn-danger btn-xs modal_ekspor" data-toggle="modal" data-target="#modal_ekspor" title="{{$v->opd->nm_instansi??''}}" tipe="Excel" judul="Renja"><i class="fa fa-print"></i> Print</a>
                                 
                             </div><p></p>

                             <!-- akordion non urusan -->
                             @php 
                             /*

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
                                                <th rowspan=2 class="text-center">Jml Sub Kegiatan</th>
                                                <th colspan=4 class="text-center">Keterisian Data(%)</th>
											</tr>
											<tr>
                                                <!-- <th class="text-center">T1</th>
                                                <th class="text-center">T2</th>
                                                <th class="text-center">T3</th> -->
                                                <th class="text-center">T4</th>
                                            </tr>
                                            @php $nonno=1; $tot_keg=0; $tot_urusan_pagu=0; $tot_urusan_real=0; @endphp
                                            @foreach($rpjmd_prog_non_urusan as $vpn)
											
                                                @php

												
                                                $tot_keg=$tot_keg+$vpn->jml_keg($periode,$data_renja);

                                                $jumlah_isian=$vpn->jml_keg($periode,$data_renja)+$vpn->jml_keg_k($periode,$data_renja);

                                                $persen_t1=@(($vpn->jml_realisasi_keg($periode,'rpt1',$data_renja) + $vpn->jml_realisasi_keg_k($periode,'kt1',$data_renja))/$jumlah_isian)*100;
                                                if($persen_t1<=50){$warna_1="danger";}elseif($persen_t1<=99){$warna_1="warning";}else{$warna_1="success";}

                                                $persen_t2=@(($vpn->jml_realisasi_keg($periode,'rpt2',$data_renja) + $vpn->jml_realisasi_keg_k($periode,'kt2',$data_renja))/$jumlah_isian)*100;
                                                if($persen_t2<=50){$warna_2="danger";}elseif($persen_t2<=99){$warna_2="warning";}else{$warna_2="success";}

                                                $persen_t3=@(($vpn->jml_realisasi_keg($periode,'rpt3',$data_renja) + $vpn->jml_realisasi_keg_k($periode,'kt3',$data_renja))/$jumlah_isian)*100;
                                                if($persen_t3<=50){$warna_3="danger";}elseif($persen_t3<=99){$warna_3="warning";}else{$warna_3="success";}

                                                $persen_t4=@(($vpn->jml_realisasi_keg($periode,'rpt4',$data_renja) + $vpn->jml_realisasi_keg_k($periode,'kt4',$data_renja))/$jumlah_isian)*100;
                                                if($persen_t4<=50){$warna_4="danger";}elseif($persen_t4<=99){$warna_4="warning";}else{$warna_4="success";}

                                                @endphp
                                                <tr>
                                                    <td>{{$nonno++}}</td>
                                                    <td>
                                                        <a ref="#" value="{{ action('RenjaController@show_evaluasi_renja',['periode'=>$periode,'triwulan'=>$triwulan,'idprgrm'=>$vpn->idprgrm, 'id_instansi'=>$v->id_instansi,'data_renja'=>$data_renja]) }}" class="btn btn-xs modalMd" title="Renja - Program : {{$vpn->nmprgrm}}" data-toggle="modal" data-target="#modalMd" style="white-space: pre-wrap;">{{$vpn->nmprgrm}}</a>
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

													@endphp
													<td align="right">{{number_format($pagu,0)}}</td>
                                                    <td align="right">{{number_format($real,0)}}</td>
                                                    <td align="right">{{number_format($p_predikat,2)}}% ({{$predikat}})</td>
                                                    <td align="center">{{$vpn->jml_keg($periode,$data_renja)}}</td>
                                                    
                                                    <td align="center"><span class="label label-{{$warna_1}}" style="font-size:12px;">{{number_format($persen_t1,0)}}%</span></td>
                                                    <td align="center"><span class="label label-{{$warna_2}}" style="font-size:12px;">{{number_format($persen_t2,0)}}%</span></td>
                                                    <td align="center"><span class="label label-{{$warna_3}}" style="font-size:12px;">{{number_format($persen_t3,0)}}%</span></td>
                                                    
                                                    <td align="center"><span class="label label-{{$warna_4}}" style="font-size:12px;">{{number_format($persen_t4,0)}}%</span></td>
													
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
											@endphp
                                            <tr>
                                                <td colspan="2" align='right'><b>Total Kegiatan</b></td>
                                                <td align='right'><b>{{number_format($tot_urusan_pagu,0)}}</b></td>
                                                <td align='right'><b>{{number_format($tot_urusan_real,0)}}</b></td>
                                                <td align="right">{{number_format($p_predikat,2)}}% ({{$predikat}})</td>
                                                <td align='center'><b>{{$tot_keg}}</b></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- end akordion non urusan -->
                            
                            @php 
                            */

                                $pecah=explode(",",$v->arr_urusan); 
                                $no2=0;
                            @endphp
                            @foreach($pecah as $value)
                            @php $no2++ @endphp
                                <div class="panel panel-warning overflow-hidden">
                                    <div class="panel-heading" style="padding:3px;">
                                        <h3 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{$v->id_instansi}}{{str_replace('.','_',$value)}}{{$no}}{{$no2}}">
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
                                                            {{$du->nm_unit}} : {{$sekda->nm_instansi??''}}
                                                        @php
                                                    }
                                                @endphp
                                            </a>
                                        </h3>
                                    </div>
                                    
                                    <div id="collapse{{$v->id_instansi}}{{str_replace('.','_',$value)}}{{$no}}{{$no2}}" class="panel-collapse collapse bg-silver">
                                        <div class="panel-body bg-success">
                                            @php 
                                            
                                            $rpjmd_prog_urusan = $rpjmd_prog->where('idopd','=',$v->opd->id)->where('unitkey','=',$value);

                                            @endphp
                                            <table class="table table-striped table-hover table-bordered" width="100%">
                                                <tr>
                                                <th rowspan=2>#</th>
                                                <th rowspan=2>Program</th>
                                                <th rowspan=2 class="text-center">Pagu Indikatif (Rp)</th>
                                                <th rowspan=2 class="text-center">Realisasi</th>
                                                <th rowspan=2 class="text-center">Predikat Kinerja</th>
                                                <th rowspan=2 class="text-center">Jml Kegiatan</th>
                                                <th rowspan=2 class="text-center">Jml Sub Kegiatan</th>
                                                <th colspan=4 class="text-center">Keterisian Data(%)</th>
											</tr>
											<tr>
                                                <!-- <th class="text-center">T1</th>
                                                <th class="text-center">T2</th>
                                                <th class="text-center">T3</th> -->
                                                <th class="text-center">T4</th>
                                            </tr>
                                                @php 
                                                    $urno=1; $tot_keg=0; $tot_urusan_pagu=0; $tot_urusan_real=0; 
                                                    $totjml_kegiatan90=0;
                                                @endphp
                                                @foreach($rpjmd_prog_urusan as $vp)
                                                    @php
                                                    $tot_keg=$tot_keg+$vp->jml_keg($periode,$data_renja);
                                                    $jml_kegiatan90=count($vp->jml_kegiatan($periode,$data_renja));
                                                    $totjml_kegiatan90=$totjml_kegiatan90+$jml_kegiatan90;

                                                    $jumlah_isian=$vp->jml_keg($periode,$data_renja)+$vp->jml_keg_k($periode,$data_renja);

                                                    $persen_t1=@(($vp->jml_realisasi_keg($periode,'rpt1',$data_renja) + $vp->jml_realisasi_keg_k($periode,'kt1',$data_renja))/$jumlah_isian)*100;
                                                    if($persen_t1<=50){$warna_1="danger";}elseif($persen_t1<=99){$warna_1="warning";}else{$warna_1="success";}

                                                    $persen_t2=@(($vp->jml_realisasi_keg($periode,'rpt2',$data_renja) + $vp->jml_realisasi_keg_k($periode,'kt2',$data_renja))/$jumlah_isian)*100;
                                                    //$persen_t2=$jumlah_isian;
                                                    //$persen_t2=$vp->jml_realisasi_keg($periode,'rpt2');
                                                    //$persen_t2=$vp->jml_realisasi_keg_k($periode,'kt2',$data_renja);
                                                    if($persen_t2<=50){$warna_2="danger";}elseif($persen_t2<=99){$warna_2="warning";}else{$warna_2="success";}

                                                    $persen_t3=@(($vp->jml_realisasi_keg($periode,'rpt3',$data_renja) + $vp->jml_realisasi_keg_k($periode,'kt3',$data_renja))/$jumlah_isian)*100;
                                                    if($persen_t3<=50){$warna_3="danger";}elseif($persen_t3<=99){$warna_3="warning";}else{$warna_3="success";}

                                                    $persen_t4=@(($vp->jml_realisasi_keg($periode,'rpt4',$data_renja) + $vp->jml_realisasi_keg_k($periode,'kt4',$data_renja))/$jumlah_isian)*100;
                                                    if($persen_t4<=50){$warna_4="danger";}elseif($persen_t4<=99){$warna_4="warning";}else{$warna_4="success";}

                                                    @endphp
                                                    
                                                    @if($vp->jml_keg($periode,$data_renja)>0)
                                                    @php
                                                    if($vp->nmprog!=""){
                                                        $nmprgrm=$vp->nmprog;
                                                        //$nmprgrm=$vp->master_program->nmprgrm;
                                                    }else{
                                                        $nmprgrm=$vp->master_program->nmprgrm;
                                                    }
                                                    @endphp
                                                    <tr>
                                                        <td>{{$urno++}}</td>
                                                        <td>
                                                            <a ref="#" value="{{ action('RenjaController@show_evaluasi_renja',['periode'=>$periode,'triwulan'=>$triwulan,'idprgrm'=>$vp->idprog, 'id_instansi'=>$v->id_instansi,'data_renja'=>$data_renja]) }}" class="btn btn-xs modalMd" title="Renja - Program : {{$nmprgrm}}" data-toggle="modal" data-target="#modalMd" style="white-space: pre-wrap;">{{$nmprgrm}}</a>
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

                                                    
														@endphp
														<td align="right">{{number_format($pagu,0)}}</td>
														<td align="right">{{number_format($real,0)}}</td>
                                                        <td align="right">{{number_format($p_predikat,2)}}% ({{$predikat}})</td>
                                                        <td align="center">{{$jml_kegiatan90}}</td>
                                                        <td align="center">{{$vp->jml_keg($periode,$data_renja)}}</td>
                                                        
                                                        <td align="center">
                                                        	<span class="label label-{{$warna_4}}" style="font-size:12px;">
                                                        	@php
	                                                		if($persen_t4=="100"){
	                                                			echo number_format($persen_t4,0)."%";
	                                                    	}else{
	                                                        	echo number_format($persen_t4,2)."%";
	                                                    	}
	                                                    	@endphp
                                                        	</span>
                                                        </td>
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
													@endphp
                                                <tr>
                                                    <td colspan="2" align='right'><b>Total Kegiatan</b></td>
													<td align='right'><b>{{number_format($tot_urusan_pagu,0)}}</b></td>
													<td align='right'><b>{{number_format($tot_urusan_real,0)}}</b></td>
                                                    <td align="right">{{number_format($p_predikat,2)}}% ({{$predikat}})</td>
                                                    <td align='center'><b>{{$totjml_kegiatan90}}</b></td>
                                                    <td align='center'><b>{{$tot_keg}}</b></td>
                                                    <!-- <td></td>
                                                    <td></td>
                                                    <td></td> -->
                                                    <td></td>
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
						@endphp
						<h4 class='alert alert-success'><b>TOTAL PAGU RKPD PERUBAHAN OPD: {{number_format($tot_opd_pagu,0)}} | TOTAL REALISASI OPD: {{number_format($tot_opd_real,0)}} | ({{number_format($p_predikat,2)}}%  - {{$predikat}})</b></h4>
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
                  <button type="button" class="close reload_data" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; <b>Close</b></span></button>
                  
                  <h4 class="modal-title" id="modalMdTitle" style="color: #fff;">Selamat Datang</h4>
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
                            <!--
                            <option @if($triwulan==1 and $dist1=="") selected @endif {{@$dist1}}>I</option>
                            <option @if($triwulan==2 and $dist2=="") selected @endif {{@$dist2}}>II</option>
                            <option @if($triwulan==3 and $dist3=="") selected @endif {{@$dist3}}>III</option>
                            <option @if($triwulan==4 and $dist4=="") selected @endif {{@$dist4}}>IV</option>-->
                            <option @if($triwulan==1) selected @endif >I</option>
                            <option @if($triwulan==2) selected @endif >II</option>
                            <option @if($triwulan==3) selected @endif >III</option>
                            <option @if($triwulan==4) selected @endif >IV</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Jenis File</td>
                    <td> : 
                        <select id="dok">
                            <!--
                            <option @if($triwulan==1 and $dist1=="") selected @endif {{@$dist1}}>I</option>
                            <option @if($triwulan==2 and $dist2=="") selected @endif {{@$dist2}}>II</option>
                            <option @if($triwulan==3 and $dist3=="") selected @endif {{@$dist3}}>III</option>
                            <option @if($triwulan==4 and $dist4=="") selected @endif {{@$dist4}}>IV</option>-->
                            <option selected>PDF</option>
                            <option>Excel</option>
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
            <button type="button" class="btn btn-danger" id="btn_ekspor"><i class="fa fa-print"></i> Print <span style="display: none" id="tipe"></span></button>
          </div>
        </div>

    </div>
</div>

<!-- Modal tc 19 -->
    <div id="tcmodal_ekspor" class="modal fade" style="width: 600px;
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
            <h4 class="tcmodal-title"></h4>
          </div>
          <div class="modal-body">
            <table>
                <tr><td>OPD</td><td> : <span id="tcmodal-title"></span> 
                    <input type='hidden' id="tcid_instansi"/>
                    <input type="hidden" id="tcjenis"/>
                    </td>
                </tr>
                <tr><td>Periode</td><td> : <span id="tcperiode">{{$periode}}</span></td></tr>
                <tr>
                    <td>Triwulan</td>
                    <td> : 
                        <select id="tctriwulan">
                            <!--
                            <option @if($triwulan==1 and $dist1=="") selected @endif {{@$dist1}}>I</option>
                            <option @if($triwulan==2 and $dist2=="") selected @endif {{@$dist2}}>II</option>
                            <option @if($triwulan==3 and $dist3=="") selected @endif {{@$dist3}}>III</option>
                            <option @if($triwulan==4 and $dist4=="") selected @endif {{@$dist4}}>IV</option>-->
                            <option @if($triwulan==1) selected @endif >I</option>
                            <option @if($triwulan==2) selected @endif >II</option>
                            <option @if($triwulan==3) selected @endif >III</option>
                            <option @if($triwulan==4) selected @endif >IV</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Jenis File</td>
                    <td> : 
                        <select id="tcdok">
                            <!--
                            <option @if($triwulan==1 and $dist1=="") selected @endif {{@$dist1}}>I</option>
                            <option @if($triwulan==2 and $dist2=="") selected @endif {{@$dist2}}>II</option>
                            <option @if($triwulan==3 and $dist3=="") selected @endif {{@$dist3}}>III</option>
                            <option @if($triwulan==4 and $dist4=="") selected @endif {{@$dist4}}>IV</option>-->
                            <option selected>PDF</option>
                            <option>Excel</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Rekap</td>
                    <td> : 
                        <select id="tcrekap">
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
            <div id="tcwait_download" class="text-center"><img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}">
                Loading...<!-- Loading -->
            </div>
            <button type="button" class="btn btn-danger" id="tcbtn_ekspor"><i class="fa fa-print"></i> Print <span style="display: none" id="tctipe"></span></button>
          </div>
        </div>

    </div>
</div>


    <script type="text/javascript">
        $('#wait').hide();
        $('#wait_download').hide();
        $('#tcwait_download').hide();
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
                    console.log(response);
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

            $('.tcmodal_ekspor').off('click').on('click', function () {
                $('.tcmodal-title').html("Ekspor Data Evaluasi "+$(this).attr('judul'));
                $('#tcmodal-title').html($(this).attr('title'));
                $('#tctipe').html($(this).attr('tipe'));
                $('#tcjenis').val($(this).attr('judul'));
                $('#tcid_instansi').val($(this).attr('value'));
            });
        });

        $("#btn_ekspor").click(function(e) {
            @if($periode!="")

            $('#wait_download').show();
            var triwulan = $('#triwulan').val();
            var id_instansi = $('#id_instansi').val();
            var jenis = $('#jenis').val();
            var rekap = $('#rekap').val();
            var data_renja = $('#data_renja').val();
            var dok = $('#dok').val();
            
            url = "{{url('evaluasi_renja_excel/'.$periode)}}/"+jenis+"/"+id_instansi+"/"+triwulan+"/"+rekap+"/"+data_renja+"/"+dok;
            window.open(url);
            $('#wait_download').hide();
            
            @endif
        });

        $("#tcbtn_ekspor").click(function(e) {
            @if($periode!="")

            $('#wait_download').show();
            var triwulan = $('#tctriwulan').val();
            var id_instansi = $('#tcid_instansi').val();
            var jenis = $('#tcjenis').val();
            var rekap = $('#tcrekap').val();
            var data_renja = $('#data_renja').val();
            var dok = $('#tcdok').val();
            
            url = "{{url('tcevaluasi_renja_excel/'.$periode)}}/"+jenis+"/"+id_instansi+"/"+triwulan+"/"+rekap+"/"+data_renja+"/"+dok;
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