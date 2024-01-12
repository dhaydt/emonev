@extends('layouts.template')
 
@section('title', 'CRUD BLOG')
@section('content')
<style type="text/css">

/*Atur persentasi kolom*/

/*html>body tbody.scrollContent {
    display: block;
    height: 470px;
    overflow: auto;
    direction:rtr;
    width: 100%;
}

html>body thead.fixedHeader {
    display: table;
    overflow: auto;
    width: 100%;
}

.list_container {
  direction: rtl;
  overflow:auto;
  height: 50px;
  width: 50px;
}
https://datatables.net/extensions/fixedcolumns/examples/initialisation/two_columns.html
*/
th,td { word-wrap: break-word; }
div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
}
.dataTables_filter{
    float: left;
}
</style>



<div class="row">
 <div class="col-lg-12">
    
    @php 
    $novr=1; 

    $renstra1_dis="disabled=disabled";
    $renstra2_dis="disabled=disabled";
    //$renstra1_dis="";
    //$renstra2_dis="";
    $t1_dis="disabled=disabled";
    $t2_dis="disabled=disabled";
    $t3_dis="disabled=disabled";
    $t4_dis="disabled=disabled";  

    if($triwulan==1){
      $renstra1_dis="";
      $renstra2_dis="";
      $t1_dis="";
    }elseif($triwulan==2){
      $t2_dis="";
    }elseif($triwulan==3){
      $t3_dis="";
    }elseif($triwulan==4){
      $t4_dis="";
    }

    if($data_renja=="perubahan"){
      //$renstra1_dis="";
      //$renstra2_dis="";
    }
    @endphp
    
    <!-- <style type="text/css">
    .wrapper1, .wrapper2{width: 100%; border: none 0px RED;
        overflow-x: scroll; overflow-y:hidden;}
        .div1 {width:120%; height: 1px; }
        .div2 {width:120%;
        overflow: auto;}
    </style>
    
    <div class="wrapper1">
        <div class="div1">
        </div>
    </div> -->
    <input type="hidden" id="datarenja" value="{{$data_renja}}">
    <table class="table table-bordered table-striped display pageResize" id="data-table" width="100%">
        <thead class="fixedHeader" style="font-size: 9px">
        <tr height='10px'>
            <th rowspan=2 class="text-center" style="vertical-align: top;">No</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Urusan/Bidang Urusan Pemerintahan Kab/Kota dan Program/Kegiatan</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Indikator Kinerja Program (<i>outcome</i>)/Kegiatan(<i>output</i>)</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Target Renstra Perangkat Kab/Kota pada Tahun {{$periode_rpjmd->thn_akhir}} (akhir periode Renstra)</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Realisasi Capaian Kinerja Renstra Perangkat Daerah Provinsi s/d Renja Perangkat Daerah Tahun Lalu ({{$periode-1}})<p style='color:blue;font-size:12px;'>Dikosongkan saja</p></th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Target Kinerja dan Anggaran Renja Perangkat Daerah Provinsi Tahun Berjalan ({{$periode}}) yang dievaluasi</th>
            <th colspan=8 class="text-center" style="vertical-align: top;">Realisasi Kinerja Pada Triwulan</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Realisasi Capaian Kinerja dan Anggaran Renja Perangkat Daerah Provinsi yang dievaluasi Tahun {{$periode}}</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Tingkat Capaian Kinerja dan Realisasi Anggaran Renja PD Tahun {{$periode}}(%)</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Realisasi Kinerja Anggaran Renstra Perangkat Daerah Provinsi s/d Tahun {{$periode}}</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Tingkat Capaian Kinerja dan Realisasi Anggaran Renstra Perangkat Daerah Provinsi s/d Tahun {{$periode}}(%)</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Unit Perangkat Daerah Penanggung Jawab</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Keterangan</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Faktor Penghambat</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Faktor Pendorong</th>
        </tr>
        <tr>
            <th colspan=2 class="text-center" style="vertical-align: top;">I</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">II</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">III</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">IV</th>
        </tr>
        <tr>
            <th rowspan=2 class="text-center">(1)</th>
            <th rowspan=2 class="text-center">(3)</th>
            <th rowspan=2 class="text-center">(4)</th>
            <th rowspan=2></th>
            <th colspan=2 class="text-center">(5)</th>
            <th colspan=2 class="text-center">(6)</th>
            <th colspan=2 class="text-center">(7)</th>
            <th colspan=2 class="text-center">(8)</th>
            <th colspan=2 class="text-center">(9)</th>
            <th colspan=2 class="text-center">(10)</th>
            <th colspan=2 class="text-center">(11)</th>
            <th colspan=2 class="text-center">(12) = 8+9+10+11</th>
            <th colspan=2 class="text-center">(13) = 12/7 * 100%</th>
            <th colspan=2 class="text-center">(14) = 6+12</th>
            <th colspan=2 class="text-center">(15) = 14/5 * 100%</th>
            <th rowspan=2 class="text-center">(16)</th>
            <th rowspan=2 class="text-center">(17)</th>
            <th rowspan=2 class="text-center">(18)</th>
            <th rowspan=2 class="text-center">(19)</th>
        </tr>
        <tr>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
            <th class="text-center">K</th>
            <th class="text-center">Rp</th>
        </tr>
        </thead>
        <tbody class="scrollContent" id="modaltbody">
        <!-- <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="width:100%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr> -->
        <tr>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"><b>@if($prog->idunit != null) {{$prog->get_unit()->nm_unit??''}} @else {{$prog->master_program->urusan()->nm_unit??''}}@endif</b></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;" style="width:100%;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>


            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
            <td style="background-color: #57FF00;"></td>
        </tr>
        <tr>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"><b>{{$prog->opd_program()}}</b></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>

            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
            <td style="background-color: #E8A600;"></td>
        </tr>
        <tr>
            <td style="background-color: #0CDDE8"></td>
            <td style="background-color: #0CDDE8">
            @php
            if($prog->nmprog!=""){
                $nomenklatur_prog=$prog->nmprog;
            }else{
                $nomenklatur_prog=$prog->master_program->nmprgrm;
            }
            @endphp
                <b>{{$nomenklatur_prog}}</b>
            </td>
            @php 
                //$jml_ind_prog = count($prog->indikator_program()); 
                $jml_ind_prog = count($prog->rkpd_prog($data_renja)); 
                $no_pink=0;
            @endphp
            @foreach($prog->rkpd_prog($data_renja) as $pi)
                @php 
                    
                    //if($periode==2016){
                    //    $v7k=$pi->t1;
                    //}elseif($periode==2017){
                    //    $v7k=$pi->t2;
                    //}elseif($periode==2018){
                    //    $v7k=$pi->t3;
                    //}elseif($periode==2019){
                    //    $v7k=$pi->t4;
                    //}elseif($periode==2020){
                    //    $v7k=$pi->t5;
                    //}elseif($periode==2021){
                    //    $v7k=$pi->t6;
                    //}


                    
                    if($data_renja!="perubahan"){
                        $sat_prog="";
                        $sat_prog="<input type='hidden' id='sat_prog[]' value='{$pi->sat_awal}'>";
                        
                        $v7k=$pi->target_awal;
                        
                        $piindikator=$pi->indikator_awal;
                        $pisatuan=$pi->sat_awal;
                    }else{
                        $sat_prog="";
                        $sat_prog="<input type='hidden' id='sat_prog[]' value='{$pi->sat_perubahan}'>";

                        $v7k=$pi->target_perubahan;

                        $piindikator=$pi->indikator_perubahan;
                        $pisatuan=$pi->sat_perubahan;
                    }
                    $simpan_p="";
                    $simpan_p="<input type='text' id='id_ind_prog[]' value='{$pi->id}' hidden='hidden' />";

                    $prog_re="";
                    $p_t1="";
                    $p_t2="";
                    $p_t3="";
                    $p_t4="";
                    
                    $tkrpjmd="";
                    $p_t7="";

                    $ket_prog="";
                    //satuan !=0 dan indikator >1
                    //if($pi->satuan != "%"){}
                    if($pi->realisasi_tprog!=""){
                        $tkrpjmd=$pi->realisasi_tprog->p_ak;
                        //$tkrpjmd="";
                        $pre=$pi->realisasi_tprog->p_re;
                        if($triwulan == 1){
                            $pt1=$pi->realisasi_tprog->p_t1;
                            $pt2='';
                            $pt3='';
                            $pt4='';
                        }else if($triwulan == 2){
                            $pt1=$pi->realisasi_tprog->p_t1;
                            $pt2=$pi->realisasi_tprog->p_t2;
                            $pt3='';
                            $pt4='';
                        }else if($triwulan == 3){
                            $pt1=$pi->realisasi_tprog->p_t1;
                            $pt2=$pi->realisasi_tprog->p_t2;
                            $pt3=$pi->realisasi_tprog->p_t3;
                            $pt4='';
                        }else if($triwulan == 4){
                            $pt1=$pi->realisasi_tprog->p_t1;
                            $pt2=$pi->realisasi_tprog->p_t2;
                            $pt3=$pi->realisasi_tprog->p_t3;
                            $pt4=$pi->realisasi_tprog->p_t4;
                        }
                        $ketp=$pi->realisasi_tprog->ket_prog;
                        $fpenghambat_prog=$pi->realisasi_tprog->fpenghambat_prog;
                        $fpendorong_prog=$pi->realisasi_tprog->fpendorong_prog;
                    }else{
                        $tkrpjmd="";
                        $pre="";
                        $pt1="";
                        $pt2="";
                        $pt3="";
                        $pt4="";
                        $ketp="";
                        $fpenghambat_prog="";
                        $fpendorong_prog="";
                    }

                    //realisasi sebelumnya
                    //if(count($api_prog)>0){
                    //    if(isset($api_prog[$pi->id])!=""){
                    //        $pre=$api_prog[$pi->id];
                    //    }
                    //}

                    //$tahun_1=$pi->t1 ? $pi->t1 : null;
                    //$tahun_2=$pi->t2 ? $pi->t2 : null;
                    //$tahun_3=$pi->t3 ? $pi->t3 : null;
                    //$tahun_4=$pi->t4 ? $pi->t4 : null;
                    //$tahun_5=$pi->t5 ? $pi->t5 : null;
                    //$tahun_6=$pi->t6 ? $pi->t6 : null;
                    //$tkrpjmd=($tahun_1)+($tahun_2)+($tahun_3)+($tahun_4)+($tahun_5)+($tahun_6);
                    
                        $tkrpjmd="<input type='text' id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='p_ak' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$tkrpjmd' onkeyup='kprog({$no_pink})' $renstra1_dis>";
                        $prog_re="<input type='text' id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='p_re' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='$pre' disabled $renstra2_dis>";
                        $p_t7="<input type='text' id='isimodalprog' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$v7k' hidden='hidden'>";

                        $p_t1="<input type='text' id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='p_t1' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt1}' $t1_dis>";
                        $p_t2="<input type='text' id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='p_t2' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt2}' $t2_dis>";
                        $p_t3="<input type='text' id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='p_t3' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt3}' $t3_dis>";
                        $p_t4="<input type='text' id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='p_t4' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt4}' $t4_dis>";

                        $p_12k="<input type='text' id='p_12k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
                        $p_13k="<input type='text' id='p_13k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
                        $p_14k="<input type='text' id='p_14k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
                        $p_15k="<input type='text' id='p_15k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";

                        $ket_prog="<textarea id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='ket_prog' rows=3 placeholder='keterangan'>{$ketp}</textarea>";
                        $fpenghambat_prog="<textarea id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='fpenghambat_prog' rows=3 placeholder='faktor penghambat'>{$fpenghambat_prog}</textarea>";
                        $fpendorong_prog="<textarea id='isimodalprog' idprog=".$pi->realisasi_tprog->id_ind_prog." kolom='fpendorong_prog' rows=3 placeholder='faktor pendorong'>{$fpendorong_prog}</textarea>";
                
                $no_pink++;
                @endphp

                @if($jml_ind_prog>1)
                    @if($no_pink<=1)
                    <td style="background-color: #0CDDE8">{{$piindikator}}</td>
                    <td style="background-color: #0CDDE8">{{$pisatuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                    <td style="background-color: #0CDDE8"  class="text-right"> @php echo $tkrpjmd; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $prog_re; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$v7k}} @php echo $p_t7; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t1; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t2; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t3; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t4; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>


                    <td style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $ket_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpenghambat_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpendorong_prog; @endphp</td>
                    </tr>
                    @else
                    </tr>
                    <tr>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$piindikator}}</td>
                    <td style="background-color: #0CDDE8">{{$pisatuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                    <td style="background-color: #0CDDE8"  class="text-right"> @php echo $tkrpjmd; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $prog_re; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$v7k}} @php echo $p_t7; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t1; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t2; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t3; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t4; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>

                    <td style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $ket_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpenghambat_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpendorong_prog; @endphp</td>
                    </tr>
                    @endif

                @else
                    
                    <td style="background-color: #0CDDE8">{{$piindikator}}</td>
                    <td style="background-color: #0CDDE8">{{$pisatuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                    <td style="background-color: #0CDDE8" class="text-right"> @php echo $tkrpjmd; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $prog_re; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$v7k}} @php echo $p_t7; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t1; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t2; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t3; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t4; ?></td>
                    <td style="background-color: #0CDDE8"></td>

                    <td style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $ket_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpenghambat_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpendorong_prog; @endphp</td>
                    </tr>
                @endif

            @endforeach

@php 
$index=-1;$index_rp=-1; 
@endphp
<!-- kegiatan 1 -->
@php $no_pinkegiatan_2=0; @endphp
@foreach($rkpd_keg as $rkpdkeg)
    <tr>
        <td style="background-color: silver"></td>
        <td style="background-color: silver">
            @php
            if($rkpdkeg->nmkeg!=""){
                $nomenklatur_keg=$rkpdkeg->nmkeg;
            }else{
                $nomenklatur_keg=$rkpdkeg->master_kegiatan->nmkegunit;
            }
            @endphp
            <b>{{$nomenklatur_keg}}</b>
        </td>

    	
    	@php 
    	                $jml_ind_kegiatan = count($rkpdkeg->rkpd_keg($data_renja)); 
    	                $no_pinkegiatan=0;
    	            @endphp
    	            @foreach($rkpdkeg->rkpd_keg($data_renja) as $pi)
    	                @php 
    	                    
    	                    if($data_renja!="perubahan"){
    	                        $sat_kegiatan="";
    	                        $sat_kegiatan="<input type='hidden' id='sat_kegiatan[]' value='{$pi->sat_awal}'>";
    	                        
    	                        $v7k=$pi->target_awal;
    	                        
    	                        $piindikator=$pi->indikator_awal;
    	                        $pisatuan=$pi->sat_awal;
    	                    }else{
    	                        $sat_kegiatan="";
    	                        $sat_kegiatan="<input type='hidden' id='sat_kegiatan[]' value='{$pi->sat_perubahan}'>";

    	                        $v7k=$pi->target_perubahan;

    	                        $piindikator=$pi->indikator_perubahan;
    	                        $pisatuan=$pi->sat_perubahan;
    	                    }
    	                    $simpan_kegiatan="";
    	                    $simpan_kegiatan="<input type='text' id='id_ind_kegiatan[]' value='{$pi->id}' hidden='hidden' />";

    	                    $rkpdkeg_re="";
    	                    $k_t1="";
    	                    $k_t2="";
    	                    $k_t3="";
    	                    $k_t4="";
    	                    
    	                    $k_t6="";
    	                    $k_t7="";

    	                    $ket_kegiatan="";
    	                    if($pi->realisasi_tkegiatan!=""){
    	                        
    	                        $tkrpjmd=$pi->realisasi_tkegiatan->p_ak;
    	                        $pre=$pi->realisasi_tkegiatan->k_re;
                                if($triwulan == 1){
        	                        $pt1=$pi->realisasi_tkegiatan->k_t1;
        	                        $pt2='';
        	                        $pt3='';
        	                        $pt4='';
                                }else if($triwulan == 2){
                                    $pt1=$pi->realisasi_tkegiatan->k_t1;
                                    $pt2=$pi->realisasi_tkegiatan->k_t2;
                                    $pt3='';
                                    $pt4='';
                                }else if($triwulan == 3){
                                    $pt1=$pi->realisasi_tkegiatan->k_t1;
                                    $pt2=$pi->realisasi_tkegiatan->k_t2;
                                    $pt3=$pi->realisasi_tkegiatan->k_t3;
                                    $pt4='';
                                }else if($triwulan == 4){
                                    $pt1=$pi->realisasi_tkegiatan->k_t1;
                                    $pt2=$pi->realisasi_tkegiatan->k_t2;
                                    $pt3=$pi->realisasi_tkegiatan->k_t3;
                                    $pt4=$pi->realisasi_tkegiatan->k_t4;
                                }
    	                        $ketp=$pi->realisasi_tkegiatan->ket_kegiatan;
    	                        $fpenghambat_kegiatan=$pi->realisasi_tkegiatan->fpenghambat_kegiatan;
    	                        $fpendorong_kegiatan=$pi->realisasi_tkegiatan->fpendorong_kegiatan;
    	                    }else{
    	                        $tkrpjmd="";
    	                        $pre="";
    	                        $pt1="";
    	                        $pt2="";
    	                        $pt3="";
    	                        $pt4="";
    	                        $ketp="";
    	                        $fpenghambat_kegiatan="";
    	                        $fpendorong_kegiatan="";
    	                    }
    	                    
                                $indeks_kkegiatan=$no_pinkegiatan_2;
    	                        $k_t6="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='p_ak' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$tkrpjmd' onkeyup='kkegiatan({$indeks_kkegiatan})' $renstra1_dis>";
    	                        $rkpdkeg_re="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_re' disabled style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kkegiatan({$indeks_kkegiatan})' value='$pre' $renstra2_dis>";
    	                        $k_t7="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_t7' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$v7k' hidden='hidden'>";

    	                        $k_t1="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_t1' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kkegiatan({$indeks_kkegiatan})' value='{$pt1}' $t1_dis>";
    	                        $k_t2="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_t2' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kkegiatan({$indeks_kkegiatan})' value='{$pt2}' $t2_dis>";
    	                        $k_t3="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_t3' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kkegiatan({$indeks_kkegiatan})' value='{$pt3}' $t3_dis>";
    	                        $k_t4="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_t4' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kkegiatan({$indeks_kkegiatan})' value='{$pt4}' $t4_dis>";

    	                        $k_12k="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_12k' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
    	                        $k_13k="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_13k' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
    	                        $k_14k="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_14k' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
    	                        $k_15k="<input type='text' id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='k_15k' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";

    	                        $ket_kegiatan="<textarea id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='ket_kegiatan' rows=3 placeholder='keterangan'>{$ketp}</textarea>";
    	                        $fpenghambat_kegiatan="<textarea id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='fpenghambat_kegiatan' rows=3 placeholder='faktor penghambat'>{$fpenghambat_kegiatan}</textarea>";
    	                        $fpendorong_kegiatan="<textarea id='isimodalkeg' idkeg=".$pi->realisasi_tkegiatan->id_ind_kegiatan." kolom='fpendorong_kegiatan' rows=3 placeholder='faktor pendorong'>{$fpendorong_kegiatan}</textarea>";
    	                
                        $no_pinkegiatan++;
    	                $no_pinkegiatan_2++;
    	                @endphp

    	                @if($jml_ind_kegiatan>0)
    	                    @if($no_pinkegiatan<=1)
    	                    <td style="background-color: silver">{{$piindikator}}</td>
    	                    <td style="background-color: silver">{{$pisatuan}} @php echo $sat_kegiatan; echo $simpan_kegiatan; @endphp</td>
    	                    <td style="background-color: silver"  class="text-right">@php echo $k_t6; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $rkpdkeg_re; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">{{$v7k}} @php echo $k_t7; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_t1; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_t2; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_t3; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_t4; @endphp</td>
    	                    <td style="background-color: silver"></td>


    	                    <td style="background-color: silver">@php echo $k_12k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_13k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_14k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_15k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $ket_kegiatan; @endphp</td>
    	                    <td style="background-color: silver">@php echo $fpenghambat_kegiatan; @endphp</td>
    	                    <td style="background-color: silver">@php echo $fpendorong_kegiatan; @endphp</td>
    	                    </tr>
    	                    @else
    	                    </tr>
    	                    <tr>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">{{$piindikator}}</td>
    	                    <td style="background-color: silver">{{$pisatuan}} @php echo $sat_kegiatan; echo $simpan_kegiatan; @endphp</td>
    	                    <td style="background-color: silver"  class="text-right">@php echo $k_t6; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $rkpdkeg_re; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">{{$v7k}} @php echo $k_t7; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_t1; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_t2; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_t3; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_t4; @endphp</td>
    	                    <td style="background-color: silver"></td>

    	                    <td style="background-color: silver">@php echo $k_12k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_13k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_14k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_15k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $ket_kegiatan; @endphp</td>
    	                    <td style="background-color: silver">@php echo $fpenghambat_kegiatan; @endphp</td>
    	                    <td style="background-color: silver">@php echo $fpendorong_kegiatan; @endphp</td>
    	                    </tr>
    	                    @endif

    	                @else
    	                    
    	                    <td style="background-color: silver">{{$piindikator}}</td>
    	                    <td style="background-color: silver">{{$pisatuan}} @php echo $sat_kegiatan; echo $simpan_kegiatan; @endphp</td>
    	                    <td style="background-color: silver" class="text-right">@php echo $k_t6; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"><?php echo $rkpdkeg_re; ?></td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">{{$v7k}} @php echo $k_t7; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"><?php echo $k_t1; ?></td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"><?php echo $k_t2; ?></td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"><?php echo $k_t3; ?></td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"><?php echo $k_t4; ?></td>
    	                    <td style="background-color: silver"></td>

    	                    <td style="background-color: silver">@php echo $k_12k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_13k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_14k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $k_15k; @endphp</td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver"></td>
    	                    <td style="background-color: silver">@php echo $ket_kegiatan; @endphp</td>
    	                    <td style="background-color: silver">@php echo $fpenghambat_kegiatan; @endphp</td>
    	                    <td style="background-color: silver">@php echo $fpendorong_kegiatan; @endphp</td>
    	                    </tr>
    	                @endif

    	            @endforeach
        <!-- <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
		<td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
        <td style="background-color: silver;"></td>
    </tr> -->
    <!-- Sub Kegiatan -->
 
        @foreach($rkpdkeg->rkpd_subkeg($data_renja) as $vr)
            @php 
                //$jml_ind_keg = count($vr->indikator_kegiatan);
                $jml_ind_keg = count($vr->rkpd_subkeg($data_renja));
                $no_ink=0;

                $rp5="";
                $rp6="";
                $rpt1="";
                $rpt2="";
                $rpt3="";
                $rpt4="";
                if($vr->realisasi_renja($data_renja) != ""){
                    $rp5 = $vr->realisasi_renja($data_renja)->rp5;
                    $rp6 = $vr->realisasi_renja($data_renja)->rp6;
                    if($triwulan == 1){
                        $rpt1 = $vr->realisasi_renja($data_renja)->rpt1;
                        $rpt2 = '';
                        $rpt3 = '';
                        $rpt4 = '';
                    }else if($triwulan == 2){
                        $rpt1 = $vr->realisasi_renja($data_renja)->rpt1;
                        $rpt2 = $vr->realisasi_renja($data_renja)->rpt2;
                        $rpt3 = '';
                        $rpt4 = '';
                    }else if($triwulan == 3){
                        $rpt1 = $vr->realisasi_renja($data_renja)->rpt1;
                        $rpt2 = $vr->realisasi_renja($data_renja)->rpt2;
                        $rpt3 = $vr->realisasi_renja($data_renja)->rpt3;
                        $rpt4 = '';
                    }else if($triwulan == 4){
                        $rpt1 = $vr->realisasi_renja($data_renja)->rpt1;
                        $rpt2 = $vr->realisasi_renja($data_renja)->rpt2;
                        $rpt3 = $vr->realisasi_renja($data_renja)->rpt3;
                        $rpt4 = $vr->realisasi_renja($data_renja)->rpt4;
                    }
                }


                if(count($api_keg)>0){
                        if(isset($api_keg[$vr->kdkegunit]['real'])!=""){
                            $rp6=$api_keg[$vr->kdkegunit]['real'];
                        }
                        if(isset($api_keg[$vr->kdkegunit]['tren'])!="" and in_array($vr->id_instansi, $pengecualian_rensta)){
                            $rp5=$api_keg[$vr->kdkegunit]['tren'];
                        }
                }
            @endphp
 

            <tr>
                <td>{{$novr++}} </td>
                @php
                if($vr->nmsubkeg!=""){
                    $nomenklatur_subkeg=$vr->nmsubkeg;
                }else{
                    $nomenklatur_subkeg=$vr->master_subkegiatan->nmsub_keg;
                }
                @endphp
                <td>{{$nomenklatur_subkeg}} </td>

                @php $tolokur="";$tolokur2=""; @endphp

                @foreach($vr->indikator_kegiatan_target($data_renja) as $vik)
                @php

                    if($triwulan == 1){
                        $nk8 = $vik->kt1;
                        $nk9 = '';
                        $nk10 = '';
                        $nk11 = '';
                    }else if($triwulan == 2){
                        $nk8 = $vik->kt1;
                        $nk9 = $vik->kt2;
                        $nk10 = '';
                        $nk11 = '';
                    }else if($triwulan == 3){
                        $nk8 = $vik->kt1;
                        $nk9 = $vik->kt2;
                        $nk10 = $vik->kt3;
                        $nk11 = '';
                    }else if($triwulan == 4){
                        $nk8 = $vik->kt1;
                        $nk9 = $vik->kt2;
                        $nk10 = $vik->kt3;
                        $nk11 = $vik->kt4;
                    }

                if($data_renja=="awal"){
                    $tolokur=$vik->indikator_awal;
                }elseif($data_renja=="perubahan"){
                    $tolokur=$vik->indikator_perubahan;
                }


                if($tolokur==$tolokur2){$tolokur="";}else{
                    $tolokur=$tolokur;
                    $tolokur2=$tolokur;
                }
                
                if($data_renja=="awal"){
                    //$dana=str_replace(',','',$vr->pagu_awal);                
                    $dana=$vr->pagu_awal;                
                }elseif($data_renja=="perubahan"){
                    //$dana=str_replace(',','',$vr->pagu_perubahan);
                    $dana=$vr->pagu_perubahan;
                }
                
                if($data_renja=="awal"){
                    $target_det=$vik->target_det;
                }elseif($data_renja=="perubahan"){
                    $target_det=$vik->target_det_per;
                }
                
                @endphp
                
                @if($data_renja!="")
                
                @php 
                    $no_ink++;

                    if($vik->ket_keg != ""){
                        $ketk=$vik->ket_keg;
                    }else{
                        $ketk="";
                    }
                    
                    if($vik->fpenghambat_keg != ""){
                        $fpenghambat_keg=$vik->fpenghambat_keg;
                    }else{
                        $fpenghambat_keg="";
                    }

                    if($vik->fpendorong_keg != ""){
                        $fpendorong_keg=$vik->fpendorong_keg;
                    }else{
                        $fpendorong_keg="";
                    }
                    
                    $ket_keg="<textarea id='isimodalsub' id-target=".$vik->id_target." kolom='ket_keg' rows=3 placeholder='keterangan'>{$ketk}</textarea>";
                    $fpenghambat_keg="<textarea id='isimodalsub' id-target=".$vik->id_target." kolom='fpenghambat_keg' rows=3 placeholder='faktor penghambat'>{$fpenghambat_keg}</textarea>";
                    $fpendorong_keg="<textarea id='isimodalsub' id-target=".$vik->id_target." kolom='fpendorong_keg' rows=3 placeholder='faktor pendorong'>{$fpendorong_keg}</textarea>";
                @endphp
                @if($jml_ind_keg>1)
                    @if($no_ink<=1)
                    <!-- id : {{$vik->id}} {{$vik->id_target}} -->
                    @php $index++;$index_rp++; @endphp
                    <input type="text" id="id_target[]" value="{{$vik->id_target}}" hidden="hidden" />
                    <input type="text" id="id_renja[]" value="{{$vr->id}}" hidden="hidden" />
                    <td>{{$tolokur}}\\{{$vik->id_target}}\\{{$vr->id}}</td>
                    <td>{{$vik->sat_det}}</td>
                    
                    <td style="padding-left: 10px">
                    
                        <input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k5" style='width:50px;' class="angka_k"  maxlength='18' placeholder="K" value="{{$vik->k5}}" onkeyup="k({{$index}})" {{$renstra1_dis}}></td>
                    <td><input type="text" id="isimodalren" kolom="rp5" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Rp" onkeyup="rp({{$index_rp}})" onload="rp({{$index_rp}})" value="{{$rp5}}" {{$renstra1_dis}}></td>
                    
                    <td><input type="text" id="isimodalsub" disabled id-target="{{$vik->id_target}}" kolom="k6" style='width:50px;' class="angka_k"  maxlength='18' placeholder="K" value="{{$vik->k6}}" onkeyup="k({{$index}})" {{$renstra2_dis}}></td>
                    <td><input type="text" id="isimodalren" kolom="rp6" disabled id-renja="{{$vr->id}}"  style='width:110px;' class="angka" maxlength='18' placeholder="Rp" onkeyup="rp({{$index_rp}})" value="{{$rp6}}" {{$renstra2_dis}}></td>
                    
                    <td>{{$target_det}}<input type="hidden" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k7" style='width:50px;' value='{{$target_det}}'></td>
                    <td>{{number_format($dana,0)}}<input type="hidden" id="isimodalren" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana}}"></td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt1" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$nk8}}" onkeyup="k({{$index}})" {{$t1_dis}}></td>
                    <td><input type="text"  id="isimodalren" kolom="rpt1" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt1}}" {{$t1_dis}}></td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt2" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T II (K)"  value="{{$nk9}}" onkeyup="k({{$index}})" {{$t2_dis}}></td>
                    <td><input type="text" id="isimodalren" kolom="rpt2" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan II (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt2}}" {{$t2_dis}}></td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt3" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T III (K)" value="{{$nk10}}" onkeyup="k({{$index}})" {{$t3_dis}}></td>
                    <td><input type="text" id="isimodalren" kolom="rpt3" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan III (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt3}}" {{$t3_dis}}></td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt4" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T IV (K)" value="{{$nk11}}" onkeyup="k({{$index}})" {{$t4_dis}}></td>
                    <td><input type="text" id="isimodalren" kolom="rpt4" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan IV (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt4}}" {{$t4_dis}}></td>


                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k12" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="isimodalren" kolom="rp12" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled"></td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k13" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="isimodalren" kolom="rp13" id-target="{{$vr->id}}" style='width:110px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k14" style='width:50px;' class="angka_k" disabled="disabled"></span></td>
                    <td><input type="readonly" id="isimodalren" kolom="rp14" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled"></td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k15" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="isimodalren" kolom="rp15" id-target="{{$vr->id}}" style='width:110px;' class="angka_k" disabled="disabled"></td>
                    <td>{{@$vr->singkatan_opd()}}</td>
                    <td>@php echo $ket_keg; @endphp</td>
                    <td>@php echo $fpenghambat_keg; @endphp</td>
                    <td>@php echo $fpendorong_keg; @endphp</td>
                    </tr>
                    @else
                    @php $index++; @endphp
                    <input type="text" id="id_target[]" value="{{$vik->id_target}}" hidden="hidden" />
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td>{{$tolokur}}\\{{$vik->id_target}}\\{{$vr->id}}</td>
                    <td>{{$vik->sat_det}}</td>
                    <td  style="padding-left: 10px">
                        <!-- {{$vik->id_target}}  -->
                        <input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom='k5' style='width:50px;' class="angka_k"  maxlength='18' placeholder="K" value="{{$vik->k5}}" onkeyup="k({{$index}})" {{$renstra1_dis}}></td>
                    <td></td>
                    <td><input type="text" id="isimodalsub" disabled id-target="{{$vik->id_target}}" kolom="k6" style='width:50px;' class="angka_k"  maxlength='18' placeholder="K" value="{{$vik->k6}}" onkeyup="k({{$index}})" {{$renstra2_dis}}></td>
                    <td></td>
                    <td>{{$target_det}} <input type="hidden" id="k7[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target_det}}'></td>
                    <td></td>
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt1" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$nk8}}" onkeyup="k({{$index}})" {{$t1_dis}}></td>
                    <td></td>
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt2" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T II (K)" value="{{$nk9}}" onkeyup="k({{$index}})"  {{$t2_dis}}></td>
                    <td></td>
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt3" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T III (K)" value="{{$nk10}}" onkeyup="k({{$index}})" {{$t3_dis}}></td>
                    <td></td>
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt4" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T IV (K)" value="{{$nk11}}" onkeyup="k({{$index}})"  {{$t4_dis}}></td>
                    <td></td>

                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k12" style='width:50px;' class="angka_k" disabled="disabled" ></td>
                    <td></td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k13" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td></td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k14" style='width:50px;' class="angka_k" disabled="disabled" ></span></td>
                    <td></td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k15" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td></td>
                    <td>{{$vr->singkatan_opd()}}</td>
                    <td>@php echo $ket_keg; @endphp</td>
                    <td>@php echo $fpenghambat_keg; @endphp</td>
                    <td>@php echo $fpendorong_keg; @endphp</td>
                    </tr>
                    @endif

                @else
                
                    @php 
                        //$index++;$index_rp++; 
                        $index++; 
                    @endphp
                <input type="text" id="id_target[]" value="{{$vik->id_target}}" hidden="hidden" />
                @if($no_ink<=1)
                    @php 
                        $index_rp++;
                    @endphp
                <input type="text" id="id_renja[]" value="{{$vr->id}}" hidden="hidden" />
                @endif
                    @if($no_ink>1)
                    <td></td>
                    <td></td>
                    @endif
                    <td>{{$tolokur}}\\{{$vik->id_target}}\\{{$vr->id}}</td>
                    <td>{{$vik->sat_det}}</td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k5" style='width:50px;' class="angka_k"  maxlength='18' placeholder="K" value="{{$vik->k5}}" onkeyup="k({{$index}})" {{$renstra1_dis}}></td>
                    <td>
                         @if($no_ink<=1)
                        <input type="text" id="isimodalren" kolom="rp5" id-target="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Rp" onkeyup="rp({{$index_rp}})" value="{{$rp5}}" {{$renstra1_dis}}>
                        @endif
                    </td>
                    
                    <td><input type="text" id="isimodalsub" disabled id-target="{{$vik->id_target}}" kolom="k6" style='width:50px;' class="angka_k"  maxlength='18' placeholder="K" value="{{$vik->k6}}" onkeyup="k({{$index}})" {{$renstra2_dis}}></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text" id="isimodalren" kolom="rp6" disabled id-target="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Rp" onkeyup="rp({{$index_rp}})" value="{{$rp6}}" {{$renstra2_dis}}>
                        @endif
                    </td>
                    
                    <td>{{$target_det}}<input type="hidden" id="k7[]" id-target="{{$vik->id_target}}" kolom="k7" style='width:50px;' value='{{$target_det}}'></td>
                    <td>
                        @if($no_ink<=1)
                        {{number_format($dana,0)}}<input type="hidden" id="isimodalren" id-target="{{$vr->id}}" style='width:110px;' value="{{$dana}}">
                        @endif
                    </td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt1" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (k)" value="{{$nk8}}" onkeyup="k({{$index}})" {{$t1_dis}}></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text" id="isimodalren" kolom="rpt1" id-target="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt1}}" {{$t1_dis}}>
                        @endif
                    </td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt2" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T II (K)" value="{{$nk9}}" onkeyup="k({{$index}})" {{$t2_dis}}></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text" id="isimodalren" kolom="rpt2" id-target="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan II (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt2}}" {{$t2_dis}}>
                        @endif
                    </td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt3" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T III (K)" value="{{$nk10}}" onkeyup="k({{$index}})" {{$t3_dis}}></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text" id="isimodalren" kolom="rpt3" id-target="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan III (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt3}}" {{$t3_dis}}>
                        @endif
                    </td>
                    
                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="kt4" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T IV (K)" value="{{$nk11}}" onkeyup="k({{$index}})" {{$t4_dis}}></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text" id="isimodalren" kolom="rpt4" id-target="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan IV (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt4}}" {{$t4_dis}}>
                        @endif
                    </td>

                    <td><input type="text" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k12" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="isimodalren" kolom="rp12" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled">
                        @endif
                    </td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k13" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="isimodalren" kolom="rp13" id-target="{{$vr->id}}" style='width:110px;' class="angka_k" disabled="disabled">
                        @endif
                    </td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k14" style='width:50px;' class="angka_k" disabled="disabled"></span></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="isimodalren" kolom="rp14" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled">
                        @endif
                    </td>
                    <td><input type="readonly" id="isimodalsub" id-target="{{$vik->id_target}}" kolom="k15" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="isimodalren" kolom="rp15" id-target="{{$vr->id}}" style='width:110px;' class="angka_k" disabled="disabled">
                        @endif
                    </td>
                    <td>{{$vr->singkatan_opd()}}</td>
                    <td>@php echo $ket_keg; @endphp</td>

                    <td>@php echo $fpenghambat_keg; @endphp</td>
                    <td>@php echo $fpendorong_keg; @endphp</td>
                    </tr>
                @endif
                
                @endif

                @endforeach

        @endforeach

        @endforeach
        
        </tbody>
    </table>
    <div class="result"></div>
    <div class="text-right" style="margin:0px;">
        @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check())
        <!-- <br> -->
        <span class="text text-danger"><b>*) Perhatian..! Sebelum menyimpan mohon kata kunci di kolom pencarian dihapus..!!!</b></span>
        <button class="btn btn-xs btn-primary" id="btn-simpan"><i class="fa fa-save" id='icon-simpan'></i> <span id="txt-simpan">Simpan</span></button>
        <a href="#" class="btn btn-xs btn-danger reload_data"  data-dismiss="modal" aria-label="Close" id="batal"><i class="fa fa-close"></i> Kembali</a>
        @endif

    </div>
 </div>
</div>
<!-- <script type="text/javascript" src="http://www.teamdf.com/jquery-plugins/resources/javascripts/prettify.js"></script>
<script type="text/javascript" src="http://www.teamdf.com/jquery-plugins/resources/javascripts/docs.js"></script> -->
<script src="{{ asset('public/template/jquery.number.min.js') }}"></script>


<script type="text/javascript">
// $(document).ready(function(){    
    $('#wait').hide();
        $(".angka_k").number(true, 2);
        $(".angka").number(true, 0);
//        $(".persen").number(true, 2);
        var layary= $(window).height();
        $(document).ready(function() {
            var table = $('#data-table').DataTable( {
            scrollY:        layary-188,
            // scrollY:        layary-250,
            scrollX:        true,
            scrollCollapse: true,
            info:true,ordering:false,
            paging:         false,
            // pageResize: true,
            // "dom": 'rt<"bottom"f><"clear">',
            "dom": '<t>f',
            fixedColumns:   {
                leftColumns: 4
            }
            } );

        });

        $( "#batal" ).click(function() {
          $( ".close" ).click();
        });
        //alert('tes');
        
        // $(function(){
        //     $(".wrapper1").scroll(function(){
        //         $(".wrapper2")
        //             .scrollLeft($(".wrapper1").scrollLeft());
        //     });
        //     $(".wrapper2").scroll(function(){
        //         $(".wrapper1")
        //             .scrollLeft($(".wrapper2").scrollLeft());
        //     });
        // });

        //kalkulasi
        // program
        var p_t6 = $('input[id^="p_t6"]');
        var p_re = $('input[id^="p_re"]');
        var p_t7 = $('input[id^="p_t7"]');
        var p_t1 = $('input[id^="p_t1"]');
        var p_t2 = $('input[id^="p_t2"]');
        var p_t3 = $('input[id^="p_t3"]');
        var p_t4 = $('input[id^="p_t4"]');
        var p_12k = $('input[id^="p_12k"]');
        var p_13k = $('input[id^="p_13k"]');
        var p_14k = $('input[id^="p_14k"]');
        var p_15k = $('input[id^="p_15k"]');
        
        var p_12k = $('input[id^="p_12k"]');
        var p_13k = $('input[id^="p_13k"]');
        var p_14k = $('input[id^="p_14k"]');
        var p_15k = $('input[id^="p_15k"]');

        // kegiatan90
        var k_t6 = $('input[id^="k_t6"]');
        var k_re = $('input[id^="k_re"]');
        var k_t7 = $('input[id^="k_t7"]');
        var k_t1 = $('input[id^="k_t1"]');
        var k_t2 = $('input[id^="k_t2"]');
        var k_t3 = $('input[id^="k_t3"]');
        var k_t4 = $('input[id^="k_t4"]');
        var k_12k = $('input[id^="k_12k"]');
        var k_13k = $('input[id^="k_13k"]');
        var k_14k = $('input[id^="k_14k"]');
        var k_15k = $('input[id^="k_15k"]');

        //kegiatan        
        var k5 = $('input[id^="k5"]');
        var k6 = $('input[id^="k6"]');
        var k7 = $('input[id^="k7"]');
        var k8 = $('input[id^="k8"]');
        var k9 = $('input[id^="k9"]');
        var k10 = $('input[id^="k10"]');
        var k11 = $('input[id^="k11"]');
        var k12 = $('input[id^="k12"]');
        var k13 = $('input[id^="k13"]');
        var k14 = $('input[id^="k14"]');
        var k15 = $('input[id^="k15"]');

        var rp5 = $('input[id^="rp5"]');
        var rp6 = $('input[id^="rp6"]');
        var rp7 = $('input[id^="rp7"]');
        var rp8 = $('input[id^="rp8"]');
        var rp9 = $('input[id^="rp9"]');
        var rp10 = $('input[id^="rp10"]');
        var rp11 = $('input[id^="rp11"]');
        var rp12 = $('input[id^="rp12"]');
        var rp13 = $('input[id^="rp13"]');
        var rp14 = $('input[id^="rp14"]');
        var rp15 = $('input[id^="rp15"]');

        function hitung_k(index){
            var hasil_k12 = 0;
            var hasil_k13 = 0;
            var hasil_k14 = 0;
            var hasil_k15 = 0;
            // i.each(function(index) {
                var vk5 = k5.eq(index).val();
                var vk6 = k6.eq(index).val();
                var vk7 = k7.eq(index).val();
                var vk8 = k8.eq(index).val();
                var vk9 = k9.eq(index).val();
                var vk10 = k10.eq(index).val();
                var vk11 = k11.eq(index).val();
                if(k5.eq(index).val() == '') {vk5=0;}
                if(k6.eq(index).val() == '') {vk6=0;}
                if(k7.eq(index).val() == '') {vk7=0;}
                if(k8.eq(index).val() == '') {vk8=0;}
                if(k9.eq(index).val() == '') {vk9=0;}
                if(k10.eq(index).val() == '') {vk10=0;}
                if(k11.eq(index).val() == '') {vk11=0;}
                
                hasil_k12 = Number(vk8)+Number(vk9)+Number(vk10)+Number(vk11);
                hasil_k13 = (Number(hasil_k12)/Number(vk7))*100;
                hasil_k14 = Number(hasil_k12)+Number(vk6);
                hasil_k15 = (Number(hasil_k14)/Number(vk5))*100;
 //               $('input[id-k12="'+$(this).attr('id-target')+'"]').val(hasil_k12);
                //$('span[id-k12="'+$(this).attr('id-target')+'"]').text(hasil_k12);
                k12.eq(index).val(hasil_k12);
                k13.eq(index).val(hasil_k13.toFixed(2));
                k14.eq(index).val(hasil_k14);
                k15.eq(index).val(hasil_k15.toFixed(2));
            // });
        }

        function hitung_rp(index){
            var hasil_rp12 = 0;
            var hasil_rp13 = 0;
            var hasil_rp14 = 0;
            var hasil_rp15 = 0;
            // i.each(function(index) {
                var vrp5 = rp5.eq(index).val();
                var vrp6 = rp6.eq(index).val();
                var vrp7 = rp7.eq(index).val();
                var vrp8 = rp8.eq(index).val();
                var vrp9 = rp9.eq(index).val();
                var vrp10 = rp10.eq(index).val();
                var vrp11 = rp11.eq(index).val();
                if(rp5.eq(index).val() == '') {vrp5=0;}
                if(rp6.eq(index).val() == '') {vrp6=0;}
                if(rp7.eq(index).val() == '') {vrp7=0;}
                if(rp8.eq(index).val() == '') {vrp8=0;}
                if(rp9.eq(index).val() == '') {vrp9=0;}
                if(rp10.eq(index).val() == '') {vrp10=0;}
                if(rp11.eq(index).val() == '') {vrp11=0;}
                
                hasil_rp12 = parseInt(vrp8)+parseInt(vrp9)+parseInt(vrp10)+parseInt(vrp11);
                hasil_rp13 = (parseInt(hasil_rp12)/parseInt(vrp7))*100;
                hasil_rp14 = parseInt(hasil_rp12)+parseInt(vrp6);
                hasil_rp15 = (parseInt(hasil_rp14)/parseInt(vrp5))*100;
 //               $('input[id-k12="'+$(this).attr('id-target')+'"]').val(hasil_k12);
                //$('span[id-k12="'+$(this).attr('id-target')+'"]').text(hasil_k12);
                rp12.eq(index).val(hasil_rp12);
                rp13.eq(index).val(hasil_rp13.toFixed(2));
                rp14.eq(index).val(hasil_rp14);
                rp15.eq(index).val(hasil_rp15.toFixed(2));
            // });
        }

        function k(index){
            hitung_k(index);
        }
        function rp(index){
            hitung_rp(index);
        }

        $('input[id^="id_target"]').each(function(index) {
            k(index);
        });
        $('input[id^="id_renja"]').each(function(index) {
            rp(index);
        });

        $("#btn-simpan").click(function(e) {
            
            // $("#txt-simpan").html('Menyimpan');
            // $("#icon-simpan").removeClass('fa fa-save');
            // $("#icon-simpan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            // $("#icon-simpan").css("background", "url('{{ asset('public/assets/img/123.svg') }}')");
            // $("#btn-simpan").addClass('disabled');
            
            
            // var url = "{{ route('evaluasi-renja.store') }}";
            // $.ajaxSetup({
            //     headers: {
            //         // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // })
            // e.preventDefault();

            // //prog form
            // var id_ind_prog = $('input[id="id_ind_prog[]"]').map(function(){ return this.value; }).get();
            // var ket_prog = $('textarea[id="ket_prog[]"]').map(function(){ return this.value; }).get();
            // var fpenghambat_prog = $('textarea[id="fpenghambat_prog[]"]').map(function(){ return this.value; }).get();
            // var fpendorong_prog = $('textarea[id="fpendorong_prog[]"]').map(function(){ return this.value; }).get();
            // // console.log('ket='+ket_prog);
            // var ap_t6 = $(p_t6).map(function(){ return this.value; }).get();
            // // console.log(ap_t6);
            // var ap_re = $(p_re).map(function(){ return this.value; }).get();
            // // var ap_t7 = $(p_t7).map(function(){ return this.value; }).get();
            // var ap_t1 = $(p_t1).map(function(){ return this.value; }).get();
            // var ap_t2 = $(p_t2).map(function(){ return this.value; }).get();
            // var ap_t3 = $(p_t3).map(function(){ return this.value; }).get();
            // var ap_t4 = $(p_t4).map(function(){ return this.value; }).get();

            // var id_ind_kegiatan = $('input[id="id_ind_kegiatan[]"]').map(function(){ return this.value; }).get();
            // var ket_kegiatan = $('textarea[id="ket_kegiatan[]"]').map(function(){ return this.value; }).get();
            // var fpenghambat_kegiatan = $('textarea[id="fpenghambat_kegiatan[]"]').map(function(){ return this.value; }).get();
            // var fpendorong_kegiatan = $('textarea[id="fpendorong_kegiatan[]"]').map(function(){ return this.value; }).get();
            // // console.log('ket='+ket_kegiatan);
            // var ak_t6 = $(k_t6).map(function(){ return this.value; }).get();
            // var ak_re = $(k_re).map(function(){ return this.value; }).get();
            // // var ak_t7 = $(k_t7).map(function(){ return this.value; }).get();
            // var ak_t1 = $(k_t1).map(function(){ return this.value; }).get();
            // var ak_t2 = $(k_t2).map(function(){ return this.value; }).get();
            // var ak_t3 = $(k_t3).map(function(){ return this.value; }).get();
            // var ak_t4 = $(k_t4).map(function(){ return this.value; }).get();

            // // console.log(formData);
            // var id_target = $('input[id="id_target[]"]').map(function(){ return this.value; }).get();
            // console.log(id_target);
            // var ak5 = $(k5).map(function(){ return this.value; }).get();
            // var ak6 = $(k6).map(function(){ return this.value; }).get();
            // // var ak7 = $(k7).map(function(){ return this.value; }).get();
            // var ak8 = $(k8).map(function(){ return this.value; }).get();
            // var ak9 = $(k9).map(function(){ return this.value; }).get();
            // var ak10 = $(k10).map(function(){ return this.value; }).get();
            // var ak11 = $(k11).map(function(){ return this.value; }).get();
            // var ket_keg = $('textarea[id="ket_keg[]"]').map(function(){ return this.value; }).get();
            // var fpenghambat_keg = $('textarea[id="fpenghambat_keg[]"]').map(function(){ return this.value; }).get();
            // var fpendorong_keg = $('textarea[id="fpendorong_keg[]"]').map(function(){ return this.value; }).get();
            
            // var id_renja = $('input[id="id_renja[]"]').map(function(){ return this.value; }).get();
            // console.log(id_renja);
            // var arp5 = $(rp5).map(function(){ return this.value; }).get();
            // var arp6 = $(rp6).map(function(){ return this.value; }).get();
            // // var ak7 = $(k7).map(function(){ return this.value; }).get();
            // var arp8 = $(rp8).map(function(){ return this.value; }).get();
            // var arp9 = $(rp9).map(function(){ return this.value; }).get();
            // var arp10 = $(rp10).map(function(){ return this.value; }).get();
            // var arp11 = $(rp11).map(function(){ return this.value; }).get();
            
            // var data_renja=$('#datarenja').val();
            // var formData = {
            //     id_ind_prog: id_ind_prog,
            //     ket_prog: ket_prog,
            //     fpenghambat_prog: fpenghambat_prog,
            //     fpendorong_prog: fpendorong_prog,
            //     p_t6: ap_t6,
            //     p_re: ap_re,
            //     p_t1: ap_t1,
            //     p_t2: ap_t2,
            //     p_t3: ap_t3,
            //     p_t4: ap_t4,
            //     id_ind_kegiatan: id_ind_kegiatan,
            //     ket_kegiatan: ket_kegiatan,
            //     fpenghambat_kegiatan: fpenghambat_kegiatan,
            //     fpendorong_kegiatan: fpendorong_kegiatan,
            //     k_t6: ak_t6,
            //     k_re: ak_re,
            //     k_t1: ak_t1,
            //     k_t2: ak_t2,
            //     k_t3: ak_t3,
            //     k_t4: ak_t4,
            //     id_target: id_target,
            //     k5: ak5,
            //     k6: ak6,
            //     k8: ak8,
            //     k9: ak9,
            //     k10: ak10,
            //     k11: ak11,
            //     ket_keg: ket_keg,
            //     fpenghambat_keg: fpenghambat_keg,
            //     fpendorong_keg: fpendorong_keg,
            //     id_renja: id_renja,
            //     rp5: arp5,
            //     rp6: arp6,
            //     rp8: arp8,
            //     rp9: arp9,
            //     rp10: arp10,
            //     rp11: arp11,
            //     data_renja: data_renja,
            // }
            // console.log(formData);

            
            // var tw= {{$triwulan}};
            // // formData = JSON.stringify(formData)
            // if(tw=="1"){
            //     formData = {
            //                     id_ind_prog: id_ind_prog,
            //                     ket_prog: ket_prog,
            //                     fpenghambat_prog: fpenghambat_prog,
            //                     fpendorong_prog: fpendorong_prog,
            //                     p_t6: ap_t6,
            //                     p_re: ap_re,
            //                     p_t1: ap_t1,
            //                     p_t2: ap_t2,
            //                     p_t3: ap_t3,
            //                     p_t4: ap_t4,
            //                     id_ind_kegiatan: id_ind_kegiatan,
            //                     ket_kegiatan: ket_kegiatan,
            //                     fpenghambat_kegiatan: fpenghambat_kegiatan,
            //                     fpendorong_kegiatan: fpendorong_kegiatan,
            //                     k_t6: ak_t6,
            //                     k_re: ak_re,
            //                     k_t1: ak_t1,
            //                     k_t2: ak_t2,
            //                     k_t3: ak_t3,
            //                     k_t4: ak_t4,
            //                     id_target: id_target,
            //                     k5: ak5,
            //                     k6: ak6,
            //                     k8: ak8,
            //                     ket_keg: ket_keg,
            //                     fpenghambat_keg: fpenghambat_keg,
            //                     fpendorong_keg: fpendorong_keg,
            //                     id_renja: id_renja,
            //                     rp5: arp5,
            //                     rp6: arp6,
            //                     rp8: arp8,
            //                     data_renja: data_renja,
            //                     tw: tw,
            //                 }
            // }else if(tw=="2"){
            //     formData = {
            //                     id_ind_prog: id_ind_prog,
            //                     ket_prog: ket_prog,
            //                     fpenghambat_prog: fpenghambat_prog,
            //                     fpendorong_prog: fpendorong_prog,
            //                     p_t6: ap_t6,
            //                     p_re: ap_re,
            //                     p_t1: ap_t1,
            //                     p_t2: ap_t2,
            //                     p_t3: ap_t3,
            //                     p_t4: ap_t4,
            //                     id_ind_kegiatan: id_ind_kegiatan,
            //                     ket_kegiatan: ket_kegiatan,
            //                     fpenghambat_kegiatan: fpenghambat_kegiatan,
            //                     fpendorong_kegiatan: fpendorong_kegiatan,
            //                     k_t6: ak_t6,
            //                     k_re: ak_re,
            //                     k_t1: ak_t1,
            //                     k_t2: ak_t2,
            //                     k_t3: ak_t3,
            //                     k_t4: ak_t4,
            //                     id_target: id_target,
            //                     k9: ak9,
            //                     ket_keg: ket_keg,
            //                     fpenghambat_keg: fpenghambat_keg,
            //                     fpendorong_keg: fpendorong_keg,
            //                     id_renja: id_renja,
            //                     rp9: arp9,
            //                     data_renja: data_renja,
            //                     tw: tw,
            //                 }
            // }else if(tw=="3"){
            //     formData = {
            //                     id_ind_prog: id_ind_prog,
            //                     ket_prog: ket_prog,
            //                     fpenghambat_prog: fpenghambat_prog,
            //                     fpendorong_prog: fpendorong_prog,
            //                     p_t6: ap_t6,
            //                     p_re: ap_re,
            //                     p_t1: ap_t1,
            //                     p_t2: ap_t2,
            //                     p_t3: ap_t3,
            //                     p_t4: ap_t4,
            //                     id_ind_kegiatan: id_ind_kegiatan,
            //                     ket_kegiatan: ket_kegiatan,
            //                     fpenghambat_kegiatan: fpenghambat_kegiatan,
            //                     fpendorong_kegiatan: fpendorong_kegiatan,
            //                     k_t6: ak_t6,
            //                     k_re: ak_re,
            //                     k_t1: ak_t1,
            //                     k_t2: ak_t2,
            //                     k_t3: ak_t3,
            //                     k_t4: ak_t4,
            //                     id_target: id_target,
            //                     k10: ak10,
            //                     ket_keg: ket_keg,
            //                     fpenghambat_keg: fpenghambat_keg,
            //                     fpendorong_keg: fpendorong_keg,
            //                     id_renja: id_renja,
            //                     rp10: arp10,
            //                     data_renja: data_renja,
            //                     tw: tw,
            //                 }
            // }else if(tw=="4"){
            //     formData = {
            //                     id_ind_prog: id_ind_prog,
            //                     ket_prog: ket_prog,
            //                     fpenghambat_prog: fpenghambat_prog,
            //                     fpendorong_prog: fpendorong_prog,
            //                     p_t6: ap_t6,
            //                     p_re: ap_re,
            //                     p_t1: ap_t1,
            //                     p_t2: ap_t2,
            //                     p_t3: ap_t3,
            //                     p_t4: ap_t4,
            //                     id_ind_kegiatan: id_ind_kegiatan,
            //                     ket_kegiatan: ket_kegiatan,
            //                     fpenghambat_kegiatan: fpenghambat_kegiatan,
            //                     fpendorong_kegiatan: fpendorong_kegiatan,
            //                     k_t6: ak_t6,
            //                     k_re: ak_re,
            //                     k_t1: ak_t1,
            //                     k_t2: ak_t2,
            //                     k_t3: ak_t3,
            //                     k_t4: ak_t4,
            //                     id_target: id_target,
            //                     k11: ak11,
            //                     ket_keg: ket_keg,
            //                     fpenghambat_keg: fpenghambat_keg,
            //                     fpendorong_keg: fpendorong_keg,
            //                     id_renja: id_renja,
            //                     rp11: arp11,
            //                     data_renja: data_renja,
            //                     tw: tw,
            //                 }
            // }

            //  console.log(formData);
            
            // $.ajax({
            //     type    : "POST",
            //     url     : url,
            //     data    : formData,
            //     dataType: 'json',
            //     success : function (data) {
            //         $('#wait').hide();
            //         console.log(data);
            //         alert(data.msg);
            //         $("#hasil").html(data);
                    
            //         $("#txt-simpan").html('Simpan');
            //         $("#icon-simpan").addClass('fa fa-save');
            //         $("#icon-simpan").html('');
            //         $("#icon-simpan").removeAttr('style');
            //         $("#btn-simpan").removeClass('disabled');

            //         @if(@Auth::guard('opd')->check())
            //         $('.reload_data').attr('onClick', 'window.location.reload();');
            //         @endif
            //     },
            //     error: function (jqXHR, status, thrownError) {
            //         alert('error, Refresh kembali halaman');
            //                 var responseText = jQuery.parseJSON(jqXHR.responseText);
            //                 console.log(status);
            //                 console.log(responseText);
            //         console.log('Error:', responseText.message);
            //         $('#wait').hide();
            //         $("#txt-simpan").html('Simpan');
            //         $("#icon-simpan").addClass('fa fa-save');
            //         $("#icon-simpan").html('');
            //         $("#icon-simpan").removeAttr('style');;
            //         $("#btn-simpan").removeClass('disabled');
            //     }
            // });

            $("#txt-simpan").html('Menyimpan');
            $("#icon-simpan").removeClass('fa fa-save');
            $("#icon-simpan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            $("#icon-simpan").css("background", "url('{{ asset('public/assets/img/123.svg') }}')");
            $("#btn-simpan").addClass('disabled');

            $('#wait').hide();
            alert("Data Berhasil Disimpan");
            
            $("#txt-simpan").html('Simpan');
            $("#icon-simpan").addClass('fa fa-save');
            $("#icon-simpan").html('');
            $("#icon-simpan").removeAttr('style');
            $("#btn-simpan").removeClass('disabled');

            @if(@Auth::guard('opd')->check())
            $('.reload_data').attr('onClick', 'window.location.reload();');
            @endif


        });

        $("#modaltbody #isimodalprog").on('paste change', function(){
            
            $("#txt-simpan").html('Menyimpan');
            $("#icon-simpan").removeClass('fa fa-save');
            $("#icon-simpan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            $("#icon-simpan").css("background", "url('{{ asset('public/assets/img/123.svg') }}')");
            $("#btn-simpan").addClass('disabled');

            var id = $(this).attr("idprog");
            var kolom = $(this).attr("kolom");
            var isi = $(this).val();

            $.ajax({
                type:"GET",
                url:"evaluasi_renja_prog?kolom="+kolom+"&id="+id+"&isi="+isi,
                success: function(data){
                    $('#wait').hide();
                    console.log(data);
                    $("#hasil").html(data);
                    
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');
                    $("#btn-simpan").removeClass('disabled');

                    @if(@Auth::guard('opd')->check())
                    $('.reload_data').attr('onClick', 'window.location.reload();');
                    @endif
                },
                error: function (jqXHR, status, thrownError) {
                    var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(status);
                            console.log(responseText);
                    console.log('Error:', responseText.message);
                    $('#wait').hide();
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');;
                    $("#btn-simpan").removeClass('disabled');
                }
            })
        })

        $("#modaltbody #isimodalkeg").on('paste change', function(){
            
            $("#txt-simpan").html('Menyimpan');
            $("#icon-simpan").removeClass('fa fa-save');
            $("#icon-simpan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            $("#icon-simpan").css("background", "url('{{ asset('public/assets/img/123.svg') }}')");
            $("#btn-simpan").addClass('disabled');

            var id = $(this).attr("idkeg");
            var kolom = $(this).attr("kolom");
            var isi = $(this).val();
            console.log('isinya:'+isi);

            $.ajax({
                type:"GET",
                url:"evaluasi_renja_keg?kolom="+kolom+"&id="+id+"&isi="+isi,
                success: function(data){
                    $('#wait').hide();
                    console.log(data);
                    $("#hasil").html(data);
                    
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');
                    $("#btn-simpan").removeClass('disabled');

                    @if(@Auth::guard('opd')->check())
                    $('.reload_data').attr('onClick', 'window.location.reload();');
                    @endif
                },
                error: function (jqXHR, status, thrownError) {
                    var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(status);
                            console.log(responseText);
                    console.log('Error:', responseText.message);
                    $('#wait').hide();
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');;
                    $("#btn-simpan").removeClass('disabled');
                }
            })
        })

        $("#modaltbody #isimodalsub").on('paste change', function(){
            
            $("#txt-simpan").html('Menyimpan');
            $("#icon-simpan").removeClass('fa fa-save');
            $("#icon-simpan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            $("#icon-simpan").css("background", "url('{{ asset('public/assets/img/123.svg') }}')");
            $("#btn-simpan").addClass('disabled');

            var id = $(this).attr("id-target");
            var kolom = $(this).attr("kolom");
            var isi = $(this).val();

            $.ajax({
                type:"GET",
                url:"evaluasi_renja_sub?kolom="+kolom+"&id="+id+"&isi="+isi,
                success: function(data){
                    $('#wait').hide();
                    console.log(data);
                    $("#hasil").html(data);
                    
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');
                    $("#btn-simpan").removeClass('disabled');

                    @if(@Auth::guard('opd')->check())
                    $('.reload_data').attr('onClick', 'window.location.reload();');
                    @endif
                },
                error: function (jqXHR, status, thrownError) {
                    var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(status);
                            console.log(responseText);
                    console.log('Error:', responseText.message);
                    $('#wait').hide();
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');;
                    $("#btn-simpan").removeClass('disabled');
                }
            })
        })

        $("#modaltbody #isimodalren").on('paste change', function(){
            
            $("#txt-simpan").html('Menyimpan');
            $("#icon-simpan").removeClass('fa fa-save');
            $("#icon-simpan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            $("#icon-simpan").css("background", "url('{{ asset('public/assets/img/123.svg') }}')");
            $("#btn-simpan").addClass('disabled');

            var id = $(this).attr("id-target");
            console.log(id);
            if(id === undefined){
                id = $(this).attr("id-renja");
            }
            var kolom = $(this).attr("kolom");
            var isi = $(this).val();

            $.ajax({
                type:"GET",
                url:"evaluasi_renja_ren?kolom="+kolom+"&id="+id+"&isi="+isi,
                success: function(data){
                    $('#wait').hide();
                    console.log(data);
                    $("#hasil").html(data);
                    
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');
                    $("#btn-simpan").removeClass('disabled');

                    @if(@Auth::guard('opd')->check())
                    $('.reload_data').attr('onClick', 'window.location.reload();');
                    @endif
                },
                error: function (jqXHR, status, thrownError) {
                    var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(status);
                            console.log(responseText);
                    console.log('Error:', responseText.message);
                    $('#wait').hide();
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');;
                    $("#btn-simpan").removeClass('disabled');
                }
            })
        })

        // hitung program
        function kprog(index){
            var hp_t12="";
            var hp_t13="";
            var hp_t14="";
            var hp_t15="";

            var vp_t6 = p_t6.eq(index).val();
            var vp_re = p_re.eq(index).val();
            var vp_t7 = p_t7.eq(index).val();
            var vp_t1 = p_t1.eq(index).val();
            var vp_t2 = p_t2.eq(index).val();
            var vp_t3 = p_t3.eq(index).val();
            var vp_t4 = p_t4.eq(index).val();
            if(p_t6.eq(index).val() == '') {vp_t6=0;}
            if(p_re.eq(index).val() == '') {vp_re=0;}
            if(p_t7.eq(index).val() == '') {vp_t7=0;}
            if(p_t1.eq(index).val() == '') {vp_t1=0;}
            if(p_t2.eq(index).val() == '') {vp_t2=0;}
            if(p_t3.eq(index).val() == '') {vp_t3=0;}
            if(p_t4.eq(index).val() == '') {vp_t4=0;}

            // $('#p_12k-'+index).val(Number($('#p_t1-'+index).val())+Number($('#p_t2-'+index).val())+Number($('#p_t3-'+index).val())+Number($('#p_t4-'+index).val()));
            hp_t12=Number(vp_t1)+Number(vp_t2)+Number(vp_t3)+Number(vp_t4);
            hp_t13=(Number(hp_t12)/Number(vp_t7))*100;
            hp_t14=Number(vp_re)+Number(hp_t12);
            hp_t15=(Number(hp_t14)/Number(vp_t6))*100;

            p_12k.eq(index).val(hp_t12);
            p_13k.eq(index).val(hp_t13);
            p_14k.eq(index).val(hp_t14);
            p_15k.eq(index).val(hp_t15);
        }

        // hitung kegiatan90
        function kkegiatan(index){
            var hk_t12="";
            var hk_t13="";
            var hk_t14="";
            var hk_t15="";

            var vk_t6 = k_t6.eq(index).val();
            var vk_re = k_re.eq(index).val();
            var vk_t7 = k_t7.eq(index).val();
            var vk_t1 = k_t1.eq(index).val();
            var vk_t2 = k_t2.eq(index).val();
            var vk_t3 = k_t3.eq(index).val();
            var vk_t4 = k_t4.eq(index).val();
            if(k_t6.eq(index).val() == '') {vk_t6=0;}
            if(k_re.eq(index).val() == '') {vk_re=0;}
            if(k_t7.eq(index).val() == '') {vk_t7=0;}
            if(k_t1.eq(index).val() == '') {vk_t1=0;}
            if(k_t2.eq(index).val() == '') {vk_t2=0;}
            if(k_t3.eq(index).val() == '') {vk_t3=0;}
            if(k_t4.eq(index).val() == '') {vk_t4=0;}

            // $('#k_12k-'+index).val(Number($('#k_t1-'+index).val())+Number($('#k_t2-'+index).val())+Number($('#k_t3-'+index).val())+Number($('#k_t4-'+index).val()));
            hk_t12=Number(vk_t1)+Number(vk_t2)+Number(vk_t3)+Number(vk_t4);
            hk_t13=(Number(hk_t12)/Number(vk_t7))*100;
            hk_t14=Number(vk_re)+Number(hk_t12);
            hk_t15=(Number(hk_t14)/Number(vk_t6))*100;

            k_12k.eq(index).val(hk_t12);
            k_13k.eq(index).val(hk_t13);
            k_14k.eq(index).val(hk_t14);
            k_15k.eq(index).val(hk_t15);
        }

// });
</script>

@endsection