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
    <table border=1 class="table table-bordered table-striped display pageResize" id="data-table" width="100%">
        <thead class="fixedHeader" style="font-size: 9px">
        <tr>
            <th rowspan=2 class="text-center" style="vertical-align: top;">No </th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Indikator Kinerja Program (<i>outcome</i>)/Kegiatan(<i>output</i>)</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Data Capaian Pada Awal Tahun Perencanaan</th>
            <th rowspan=2 colspan=2 class="text-center" style="vertical-align: top;">Target Capaian pada Akhir Tahun Perencanaan (2021) </th>
            <th colspan=10 class="text-center" style="vertical-align: top;">Target Renstra Perangkat Daerah Tahun ke-</th>
            <th colspan=12 class="text-center" style="vertical-align: top;">Realisasi Capaian Tahun ke-</th>
            <th colspan=12 class="text-center" style="vertical-align: top;">Rasio Capaian Tahun ke-</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Unit Perangkat Daerah Penanggung Jawab</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Keterangan</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Faktor Penghambat</th>
            <th rowspan=2 class="text-center" style="vertical-align: top;">Faktor Pendorong</th>
        </tr>
        <tr>
            <th colspan=2 class="text-center" style="vertical-align: top;">1 (2016)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">2 (2017)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">3 (2018)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">4 (2019)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">5 (2020)</th>

            <th colspan=2 class="text-center" style="vertical-align: top;">1 (2016)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">2 (2017)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">3 (2018)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">4 (2019)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">5 (2020)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">6 (2021)</th>

            <th colspan=2 class="text-center" style="vertical-align: top;">1 (2016)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">2 (2017)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">3 (2018)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">4 (2019)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">5 (2020)</th>
            <th colspan=2 class="text-center" style="vertical-align: top;">6 (2021)</th>
        </tr>
        <tr>
            <th rowspan=2 class="text-center">(1)</th>
            <th rowspan=2 class="text-center">(3)</th>
            <th rowspan=2 class="text-center">(4)</th>
            <th rowspan=2></th>
            <th rowspan=2 class="text-center">(5)</th>
            <th colspan=2 class="text-center">(6)</th>
            <th colspan=2 class="text-center">(7)</th>
            <th colspan=2 class="text-center">(8)</th>
            <th colspan=2 class="text-center">(9)</th>
            <th colspan=2 class="text-center">(10)</th>
            <th colspan=2 class="text-center">(11)</th>
            <th colspan=2 class="text-center">(12)</th>
            <th colspan=2 class="text-center">(13)</th>
            <th colspan=2 class="text-center">(14)</th>
            <th colspan=2 class="text-center">(15)</th>
            <th colspan=2 class="text-center">(16)</th>
            <th colspan=2 class="text-center">(17)</th>
            <th colspan=2 class="text-center">(18)</th>
            <th colspan=2 class="text-center">(19)</th>
            <th colspan=2 class="text-center">(20)</th>
            <th colspan=2 class="text-center">(21)</th>
            <th colspan=2 class="text-center">(22)</th>
            <th colspan=2 class="text-center">(23)</th>
            <th rowspan=2 class="text-center">(24)</th>
            <th rowspan=2 class="text-center">(25)</th>
            <th rowspan=2 class="text-center">(26)</th>
            <th rowspan=2 class="text-center">(27)</th>
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
        <tbody class="scrollContent">
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
            <td style="background-color: #57FF00;"><b>{{$prog->urusan_program()}} </b></td>
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
            <td style="background-color: #0CDDE8"><b>{{$prog->master_program->nmprgrm}}</b></td>
            @php 
                $jml_ind_prog = count($prog->indikator_program()); 
                $no_pink=0;
            @endphp
            @foreach($prog->indikator_program() as $pi)
                @php 
                    $sat_prog="";
                    $sat_prog="<input type='hidden' id='sat_prog[]' value='{$pi->satuan}'>";
                    $simpan_p="";
                    $simpan_p="<input type='text' id='id_ind_prog[]' value='{$pi->id}' hidden='hidden' />";

                    $prog_re="";
                    $p_t1="";
                    $p_t2="";
                    $p_t3="";
                    $p_t4="";
                    
                    $p_t6="";
                    $p_t7="";

                    $ket_prog="";
                    //satuan !=0 dan indikator >1
                    //if($pi->satuan != "%"){}
                    if($pi->realisasi_renstra_tprog!=""){
                        $pre=$pi->realisasi_renstra_tprog->p_re;
                        $pt1=$pi->realisasi_renstra_tprog->p_t1;
                        $pt2=$pi->realisasi_renstra_tprog->p_t2;
                        $pt3=$pi->realisasi_renstra_tprog->p_t3;
                        $pt4=$pi->realisasi_renstra_tprog->p_t4;
                        $pt5=$pi->realisasi_renstra_tprog->p_t5;
                        $pt6=$pi->realisasi_renstra_tprog->p_t6;
                        $ketp=$pi->realisasi_renstra_tprog->ket_prog;
                        $fpenghambat_prog=$pi->realisasi_renstra_tprog->fpenghambat_prog;
                        $fpendorong_prog=$pi->realisasi_renstra_tprog->fpendorong_prog;
                    }else{
                        $pre="";
                        $pt1="";
                        $pt2="";
                        $pt3="";
                        $pt4="";
                        $pt5="";
                        $pt6="";
                        $ketp="";
                        $fpenghambat_prog="";
                        $fpendorong_prog="";
                    }

                    $tahun_1=$pi->t1 ? $pi->t1 : null;
                    $tahun_2=$pi->t2 ? $pi->t2 : null;
                    $tahun_3=$pi->t3 ? $pi->t3 : null;
                    $tahun_4=$pi->t4 ? $pi->t4 : null;
                    $tahun_5=$pi->t5 ? $pi->t5 : null;
                    $tahun_6=$pi->t6 ? $pi->t6 : null;
                    $tkrpjmd=($tahun_1)+($tahun_2)+($tahun_3)+($tahun_4)+($tahun_5)+($tahun_6);
                    
                        $dt_awl="<textarea id='p_t6[]' rows=3 placeholder='data capaian pada awal thn perencanaan'>{$pre}</textarea>";
                        
                        $tt6="<input type='text' id='tt6[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$tahun_6' hidden='hidden'>";
                        $tt1="<input type='text' id='tt1[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$tahun_1' hidden='hidden'>";
                        $tt2="<input type='text' id='tt2[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$tahun_2' hidden='hidden'>";
                        $tt3="<input type='text' id='tt3[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$tahun_3' hidden='hidden'>";
                        $tt4="<input type='text' id='tt4[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$tahun_4' hidden='hidden'>";
                        $tt5="<input type='text' id='tt5[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' value='$tahun_5' hidden='hidden'>";

                        $p_t1="<input type='text' id='p_t1[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt1}' >";
                        $p_t2="<input type='text' id='p_t2[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt2}' >";
                        $p_t3="<input type='text' id='p_t3[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt3}' >";
                        $p_t4="<input type='text' id='p_t4[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt4}' >";
                        $p_t5="<input type='text' id='p_t5[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt5}' >";
                        $p_t6="<input type='text' id='p_t6[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' onkeyup='kprog({$no_pink})' value='{$pt4}' >";

                        $p_12k="<input type='text' id='p_12k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
                        $p_13k="<input type='text' id='p_13k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
                        $p_14k="<input type='text' id='p_14k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
                        $p_15k="<input type='text' id='p_15k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
                        $p_16k="<input type='text' id='p_16k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";
                        $p_17k="<input type='text' id='p_17k[]' style='width:50px;' class='angka_k' maxlength='18' placeholder='K' disabled='disabled'>";

                        $ket_prog="<textarea id='ket_prog[]' rows=3 placeholder='keterangan'>{$ketp}</textarea>";
                        $fpenghambat_prog="<textarea id='fpenghambat_prog[]' rows=3 placeholder='faktor penghambat'>{$fpenghambat_prog}</textarea>";
                        $fpendorong_prog="<textarea id='fpendorong_prog[]' rows=3 placeholder='faktor pendorong'>{$fpendorong_prog}</textarea>";
                
                $no_pink++;
                @endphp

                @if($jml_ind_prog>1)
                    @if($no_pink<=1)
                    <td style="background-color: #0CDDE8">{{$pi->indikator}}</td>
                    <td style="background-color: #0CDDE8">{{$pi->satuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                    <td style="background-color: #0CDDE8"  class="text-right">@php echo $dt_awl; @endphp</td>

                    <td style="background-color: #0CDDE8">{{$tahun_6}} @php echo $tt6; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_1}} @php echo $tt1; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_2}} @php echo $tt2; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_3}} @php echo $tt3; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_4}} @php echo $tt4; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_5}} @php echo $tt5; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>


                    <td style="background-color: #0CDDE8">@php echo $p_t1; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t2; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t3; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t4; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t5; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t6; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>

                    <td style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_16k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_17k; @endphp</td>
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
                    <td style="background-color: #0CDDE8">{{$pi->indikator}}</td>
                    <td style="background-color: #0CDDE8">{{$pi->satuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                    <td style="background-color: #0CDDE8"  class="text-right">@php echo $dt_awl; @endphp</td>
                    
                    <td style="background-color: #0CDDE8">{{$tahun_6}} @php echo $tt6; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    
                    <td style="background-color: #0CDDE8">{{$tahun_1}} @php echo $tt1; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_2}} @php echo $tt2; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_3}} @php echo $tt3; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_4}} @php echo $tt4; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_5}} @php echo $tt5; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>

                    
                    <td style="background-color: #0CDDE8">@php echo $p_t1; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t2; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t3; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t4; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t5; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_t6; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>

                    <td style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_16k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_17k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>

                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $ket_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpenghambat_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpendorong_prog; @endphp</td>
                    </tr>
                    @endif

                @else
                    
                    <td style="background-color: #0CDDE8">{{$pi->indikator}}</td>
                    <td style="background-color: #0CDDE8">{{$pi->satuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                    <td style="background-color: #0CDDE8" class="text-right">@php echo $dt_awl; @endphp</td>                    

                    <td style="background-color: #0CDDE8">{{$tahun_6}} @php echo $tt6; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_1}} @php echo $tt1; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_2}} @php echo $tt2; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_3}} @php echo $tt3; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_4}} @php echo $tt4; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">{{$tahun_5}} @php echo $tt5; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>


                    <td style="background-color: #0CDDE8"><?php echo $p_t1; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t2; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t3; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t4; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t5; ?></td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8"><?php echo $p_t6; ?></td>
                    <td style="background-color: #0CDDE8"></td>

                    <td style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_16k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $p_17k; @endphp</td>
                    <td style="background-color: #0CDDE8"></td>

                    <td style="background-color: #0CDDE8"></td>
                    <td style="background-color: #0CDDE8">@php echo $ket_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpenghambat_prog; @endphp</td>
                    <td style="background-color: #0CDDE8">@php echo $fpendorong_prog; @endphp</td>
                    </tr>
                @endif

            @endforeach

@php $index=-1;$index_rp=-1; @endphp            
        @foreach($renja as $vr)
            @php 
                $jml_ind_keg = count($vr->indikator_kegiatan);
                $no_ink=0;

                $rp5="";
                $rp6="";
                $rpt1="";
                $rpt2="";
                $rpt3="";
                $rpt4="";
                $rpt5="";
                $rpt6="";
                if($vr->realisasi_renstra != ""){
                    $rp5 = $vr->realisasi_renstra->rp5;
                    $rp6 = $vr->realisasi_renstra->rp6;
                    $rpt1 = $vr->realisasi_renstra->rpt1;
                    $rpt2 = $vr->realisasi_renstra->rpt2;
                    $rpt3 = $vr->realisasi_renstra->rpt3;
                    $rpt4 = $vr->realisasi_renstra->rpt4;
                    $rpt5 = $vr->realisasi_renstra->rpt5;
                    $rpt6 = $vr->realisasi_renstra->rpt6;
                }

            @endphp
 

            <!-- {{$vr->realisasi_renstra}} -->
            <tr>
                <td>{{$novr++}}</td>
                <td>{{$vr->master_kegiatan->nmkegunit}} </td>
                @php $tolokur="";$tolokur2=""; @endphp
                @foreach($vr->indikator_kegiatan_target() as $vik)
                
                @php
                $tolokur=$vik->tolokur;
                if($tolokur==$tolokur2){$tolokur="";}else{$tolokur=$vik->tolokur;$tolokur2=$vik->tolokur;}

                $data_awl=$vr->data_awl;
                $dana=$vr->trp_1;
                $dana2=$vr->trp_2;
                $dana3=$vr->trp_3;
                $dana4=$vr->trp_4;
                $dana5=$vr->trp_5;
                $dana6=$vr->trp_6;
                
                $target_det=$vik->target_det;
                $target2_det=$vik->target2_det;
                $target3_det=$vik->target3_det;
                $target4_det=$vik->target4_det;
                $target5_det=$vik->target5_det;
                $target6_det=$vik->target6_det;
                
                @endphp

                @if($vik->kdjkk=="02")
                
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
                    
                    $ket_keg="<textarea id='ket_keg[]' rows=3 placeholder='keterangan'>{$ketk}</textarea>";
                    $fpenghambat_keg="<textarea id='fpenghambat_keg[]' rows=3 placeholder='faktor penghambat'>{$fpenghambat_keg}</textarea>";
                    $fpendorong_keg="<textarea id='fpendorong_keg[]' rows=3 placeholder='faktor pendorong'>{$fpendorong_keg}</textarea>";
                @endphp
                @if($jml_ind_keg>1)
                    @if($no_ink<=1)
                    <!-- id : {{$vik->id}} {{$vik->id_target}} -->
                    @php $index++;$index_rp++; @endphp
                    <input type="text" id="id_target[]" value="{{$vik->id_target}}" hidden="hidden" />
                    <input type="text" id="id_renja[]" value="{{$vr->id}}" hidden="hidden" />
                    <td>{{$tolokur}}</td>
                    <td>{{$vik->sat_det}}</td>
                    
                    <td style="padding-left: 10px">
                        {{$data_awl}}
                    </td>

                    <td>{{$target6_det}}<input type="hidden" id="target6_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target6_det}}'></td>
                    <td>{{number_format($dana6,0)}}<input type="hidden" id="trp_6[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana6}}"></td>

                    <td>{{$target_det}}<input type="hidden" id="target_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target_det}}'></td>
                    <td>{{number_format($dana,0)}}<input type="hidden" id="trp_1[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana}}"></td>
                    <td>{{$target2_det}}<input type="hidden" id="target2_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target2_det}}'></td>
                    <td>{{number_format($dana2,0)}}<input type="hidden" id="trp_2[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana2}}"></td>
                    <td>{{$target3_det}}<input type="hidden" id="target3_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target3_det}}'></td>
                    <td>{{number_format($dana3,0)}}<input type="hidden" id="trp_3[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana3}}"></td>
                    <td>{{$target4_det}}<input type="hidden" id="target4_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target4_det}}'></td>
                    <td>{{number_format($dana4,0)}}<input type="hidden" id="trp_4[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana4}}"></td>
                    <td>{{$target5_det}}<input type="hidden" id="target5_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target5_det}}'></td>
                    <td>{{number_format($dana5,0)}}<input type="hidden" id="trp_5[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana5}}"></td>
                    
                    <td><input type="text" id="kt1[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt1}}" onkeyup="k({{$index}})" ></td>
                    <td><input type="text"  id="rpt1[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt1}}" ></td>
                    <td><input type="text" id="kt2[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt2}}" onkeyup="k({{$index}})" ></td>
                    <td><input type="text"  id="rpt2[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt2}}" ></td>
                    <td><input type="text" id="kt3[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt3}}" onkeyup="k({{$index}})" ></td>
                    <td><input type="text"  id="rpt3[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt3}}" ></td>
                    <td><input type="text" id="kt4[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt4}}" onkeyup="k({{$index}})" ></td>
                    <td><input type="text"  id="rpt4[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt4}}" ></td>
                    <td><input type="text" id="kt5[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt5}}" onkeyup="k({{$index}})" ></td>
                    <td><input type="text"  id="rpt5[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt5}}" ></td>
                    <td><input type="text" id="kt6[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt6}}" onkeyup="k({{$index}})" ></td>
                    <td><input type="text"  id="rpt6[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt6}}" ></td>
                    
                    <td><input type="text" id="kras1[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="rpras1[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled"></td>
                    <td><input type="text" id="kras2[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="rpras2[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled"></td>
                    <td><input type="text" id="kras3[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="rpras3[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled"></td>
                    <td><input type="text" id="kras4[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="rpras4[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled"></td>
                    <td><input type="text" id="kras5[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="rpras5[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled"></td>
                    <td><input type="text" id="kras6[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td><input type="readonly" id="rpras6[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled"></td>
                    
                    <td>{{$vr->singkatan_opd()}}</td>
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
                    <td>{{$tolokur}}</td>
                    <td>{{$vik->sat_det}}</td>
                    
                    <td>{{$target6_det}}<input type="hidden" id="target6_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target6_det}}'></td>
                    <td></td>

                    <td>{{$target_det}}<input type="hidden" id="target_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target_det}}'></td>
                    <td></td>
                    <td>{{$target2_det}}<input type="hidden" id="target2_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target2_det}}'></td>
                    <td></td>
                    <td>{{$target3_det}}<input type="hidden" id="target3_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target3_det}}'></td>
                    <td></td>
                    <td>{{$target4_det}}<input type="hidden" id="target4_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target4_det}}'></td>
                    <td></td>
                    <td>{{$target5_det}}<input type="hidden" id="target5_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target5_det}}'></td>
                    <td></td>
                    
                    <td><input type="text" id="kt1[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt1}}" onkeyup="k({{$index}})" ></td>
                    <td></td>
                    <td><input type="text" id="kt2[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt2}}" onkeyup="k({{$index}})" ></td>
                    <td></td>
                    <td><input type="text" id="kt3[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt3}}" onkeyup="k({{$index}})" ></td>
                    <td></td>
                    <td><input type="text" id="kt4[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt4}}" onkeyup="k({{$index}})" ></td>
                    <td></td>
                    <td><input type="text" id="kt5[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt5}}" onkeyup="k({{$index}})" ></td>
                    <td></td>
                    <td><input type="text" id="kt6[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt6}}" onkeyup="k({{$index}})" ></td>
                    <td></td>
                    
                    <td><input type="text" id="kras1[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td></td>
                    <td><input type="text" id="kras2[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td></td>
                    <td><input type="text" id="kras3[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td></td>
                    <td><input type="text" id="kras4[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td></td>
                    <td><input type="text" id="kras5[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td></td>
                    <td><input type="text" id="kras6[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
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
                    <td>{{$tolokur}} </td>
                    <td>{{$vik->sat_det}}</td>
                    
                    <td style="padding-left: 10px">
                        @if($no_ink<=1)
                            {{$data_awl}}
                        @endif
                    </td>

                    <td>{{$target6_det}}<input type="hidden" id="target6_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target6_det}}'></td>
                    <td>
                        @if($no_ink<=1)
                        {{number_format($dana6,0)}}<input type="hidden" id="trp_6[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana6}}">
                        @endif
                    </td>

                    <td>{{$target_det}}<input type="hidden" id="target_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target_det}}'></td>
                    <td>
                        @if($no_ink<=1)
                        {{number_format($dana,0)}}<input type="hidden" id="trp_1[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana}}">
                        @endif
                    </td>
                    <td>{{$target2_det}}<input type="hidden" id="target2_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target2_det}}'></td>
                    <td>
                        @if($no_ink<=1)
                        {{number_format($dana2,0)}}<input type="hidden" id="trp_2[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana2}}">
                        @endif
                    </td>
                    <td>{{$target3_det}}<input type="hidden" id="target3_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target3_det}}'></td>
                    <td>
                        @if($no_ink<=1)
                        {{number_format($dana3,0)}}<input type="hidden" id="trp_3[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana3}}">
                        @endif
                    </td>
                    <td>{{$target4_det}}<input type="hidden" id="target4_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target4_det}}'></td>
                    <td>
                        @if($no_ink<=1)
                        {{number_format($dana4,0)}}<input type="hidden" id="trp_4[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana4}}">
                        @endif
                    </td>
                    <td>{{$target5_det}}<input type="hidden" id="target5_det[]" id-target="{{$vik->id_target}}" style='width:50px;' value='{{$target5_det}}'></td>
                    <td>
                        @if($no_ink<=1)
                        {{number_format($dana5,0)}}<input type="hidden" id="trp_5[]" id-renja="{{$vr->id}}"  style='width:110px;' value="{{$dana5}}">
                        @endif
                    </td>
                    
                    <td><input type="text" id="kt1[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt1}}" onkeyup="k({{$index}})" ></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text"  id="rpt1[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt1}}" >
                        @endif
                    </td>
                    <td><input type="text" id="kt2[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt2}}" onkeyup="k({{$index}})" ></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text"  id="rpt2[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt2}}" >
                        @endif
                    </td>
                    <td><input type="text" id="kt3[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt3}}" onkeyup="k({{$index}})" ></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text"  id="rpt3[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt3}}" >
                        @endif
                    </td>
                    <td><input type="text" id="kt4[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt4}}" onkeyup="k({{$index}})" ></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text"  id="rpt4[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt4}}" >
                        @endif
                    </td>
                    <td><input type="text" id="kt5[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt5}}" onkeyup="k({{$index}})" ></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text"  id="rpt5[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt5}}" >
                        @endif
                    </td>
                    <td><input type="text" id="kt6[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k"  maxlength='18' placeholder="T I (K)" value="{{$vik->kt6}}" onkeyup="k({{$index}})" ></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="text"  id="rpt6[]" id-renja="{{$vr->id}}" style='width:110px;' class="angka" maxlength='18' placeholder="Triwulan I (Rp)" onkeyup="rp({{$index_rp}})" value="{{$rpt6}}" >
                        @endif
                    </td>
                    
                    <td><input type="text" id="kras1[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="rpras1[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled">
                        @endif
                    </td>
                    <td><input type="text" id="kras2[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="rpras2[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled">
                        @endif
                    </td>
                    <td><input type="text" id="kras3[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="rpras3[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled">
                        @endif
                    </td>
                    <td><input type="text" id="kras4[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="rpras4[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled">
                        @endif
                    </td>
                    <td><input type="text" id="kras5[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="rpras5[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled">
                        @endif
                    </td>
                    <td><input type="text" id="kras6[]" id-target="{{$vik->id_target}}" style='width:50px;' class="angka_k" disabled="disabled"></td>
                    <td>
                        @if($no_ink<=1)
                        <input type="readonly" id="rpras6[]" id-target="{{$vr->id}}" style='width:110px;' class="angka" disabled="disabled">
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
        </tbody>
    </table>
    <div class="result"></div>
    <div class="text-right" style="margin:0px;">
        @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check())
        <span class="text text-danger"><b>*) Perhatian..! Sebelum menyimpan mohon kata kunci di kolom pencarian dihapus..!!!</b></span>
        <button class="btn btn-xs btn-primary" id="btn-simpan"><i class="fa fa-save" id='icon-simpan'></i> <span id="txt-simpan">Simpan</span></button>
        <a href="#" class="btn btn-xs btn-danger  data-dismiss="modal" aria-label="Close" id="batal"><i class="fa fa-close"></i> Kembali</a>
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
        
        var tt1 = $('input[id^="tt1"]');
        var tt2 = $('input[id^="tt2"]');
        var tt3 = $('input[id^="tt3"]');
        var tt4 = $('input[id^="tt4"]');
        var tt5 = $('input[id^="tt5"]');
        var tt6 = $('input[id^="tt6"]');

        var p_t1 = $('input[id^="p_t1"]');
        var p_t2 = $('input[id^="p_t2"]');
        var p_t3 = $('input[id^="p_t3"]');
        var p_t4 = $('input[id^="p_t4"]');
        var p_t5 = $('input[id^="p_t5"]');
        var p_t6 = $('input[id^="p_t6"]');

        var p_12k = $('input[id^="p_12k"]');
        var p_13k = $('input[id^="p_13k"]');
        var p_14k = $('input[id^="p_14k"]');
        var p_15k = $('input[id^="p_15k"]');
        var p_16k = $('input[id^="p_16k"]');
        var p_17k = $('input[id^="p_17k"]');
        
        //kegiatan        
        // var k5 = $('input[id^="k5"]');
        // var k6 = $('input[id^="k6"]');
        var target_det = $('input[id^="target_det"]');
        var target2_det = $('input[id^="target2_det"]');
        var target3_det = $('input[id^="target3_det"]');
        var target4_det = $('input[id^="target4_det"]');
        var target5_det = $('input[id^="target5_det"]');
        var target6_det = $('input[id^="target6_det"]');
        var kt1 = $('input[id^="kt1"]');
        var kt2 = $('input[id^="kt2"]');
        var kt3 = $('input[id^="kt3"]');
        var kt4 = $('input[id^="kt4"]');
        var kt5 = $('input[id^="kt5"]');
        var kt6 = $('input[id^="kt6"]');

        var kras1 = $('input[id^="kras1"]');
        var kras2 = $('input[id^="kras2"]');
        var kras3 = $('input[id^="kras3"]');
        var kras4 = $('input[id^="kras4"]');
        var kras5 = $('input[id^="kras5"]');
        var kras6 = $('input[id^="kras6"]');
        
        var trp_1 = $('input[id^="trp_1"]');
        var trp_2 = $('input[id^="trp_2"]');
        var trp_3 = $('input[id^="trp_3"]');
        var trp_4 = $('input[id^="trp_4"]');
        var trp_5 = $('input[id^="trp_5"]');
        var trp_6 = $('input[id^="trp_6"]');

        var rpt1 = $('input[id^="rpt1"]');
        var rpt2 = $('input[id^="rpt2"]');
        var rpt3 = $('input[id^="rpt3"]');
        var rpt4 = $('input[id^="rpt4"]');
        var rpt5 = $('input[id^="rpt5"]');
        var rpt6 = $('input[id^="rpt6"]');
        
        var rpras1 = $('input[id^="rpras1"]');
        var rpras2 = $('input[id^="rpras2"]');
        var rpras3 = $('input[id^="rpras3"]');
        var rpras4 = $('input[id^="rpras4"]');
        var rpras5 = $('input[id^="rpras5"]');
        var rpras6 = $('input[id^="rpras6"]');

        function hitung_k(index){
            var hasil_kras1 = 0;
            var hasil_kras2 = 0;
            var hasil_kras3 = 0;
            var hasil_kras4 = 0;
            var hasil_kras5 = 0;
            var hasil_kras6 = 0;
            // i.each(function(index) {
                var vtarget_det = target_det.eq(index).val();
                var vtarget2_det = target2_det.eq(index).val();
                var vtarget3_det = target3_det.eq(index).val();
                var vtarget4_det = target4_det.eq(index).val();
                var vtarget5_det = target5_det.eq(index).val();
                var vtarget6_det = target6_det.eq(index).val();
                var vkt1 = kt1.eq(index).val();
                var vkt2 = kt2.eq(index).val();
                var vkt3 = kt3.eq(index).val();
                var vkt4 = kt4.eq(index).val();
                var vkt5 = kt5.eq(index).val();
                var vkt6 = kt6.eq(index).val();
                if(target_det.eq(index).val() == '') {vtarget_det=0;}
                if(target2_det.eq(index).val() == '') {vtarget2_det=0;}
                if(target3_det.eq(index).val() == '') {vtarget3_det=0;}
                if(target4_det.eq(index).val() == '') {vtarget4_det=0;}
                if(target5_det.eq(index).val() == '') {vtarget5_det=0;}
                if(target6_det.eq(index).val() == '') {vtarget6_det=0;}
                if(kt1.eq(index).val() == '') {vkt1=0;}
                if(kt2.eq(index).val() == '') {vkt2=0;}
                if(kt3.eq(index).val() == '') {vkt3=0;}
                if(kt4.eq(index).val() == '') {vkt4=0;}
                if(kt5.eq(index).val() == '') {vkt5=0;}
                if(kt6.eq(index).val() == '') {vkt6=0;}
                
                hasil_kras1 = (Number(vkt1)/Number(vtarget_det))*100;
                hasil_kras2 = (Number(vkt2)/Number(vtarget2_det))*100;
                hasil_kras3 = (Number(vkt3)/Number(vtarget3_det))*100;
                hasil_kras4 = (Number(vkt4)/Number(vtarget4_det))*100;
                hasil_kras5 = (Number(vkt5)/Number(vtarget5_det))*100;
                hasil_kras6 = (Number(vkt6)/Number(vtarget6_det))*100;
                
 //               $('input[id-k12="'+$(this).attr('id-target')+'"]').val(hasil_k12);
                //$('span[id-k12="'+$(this).attr('id-target')+'"]').text(hasil_k12);
                kras1.eq(index).val(hasil_kras1.toFixed(2));
                kras2.eq(index).val(hasil_kras2.toFixed(2));
                kras3.eq(index).val(hasil_kras3.toFixed(2));
                kras4.eq(index).val(hasil_kras4.toFixed(2));
                kras5.eq(index).val(hasil_kras5.toFixed(2));
                kras6.eq(index).val(hasil_kras6.toFixed(2));
            // });
        }

        function hitung_rp(index){
            var hasil_rp1 = 0;
            var hasil_rp2 = 0;
            var hasil_rp3 = 0;
            var hasil_rp4 = 0;
            var hasil_rp5 = 0;
            var hasil_rp6 = 0;
            // i.each(function(index) {
                var vtrp_1 = trp_1.eq(index).val();
                var vtrp_2 = trp_2.eq(index).val();
                var vtrp_3 = trp_3.eq(index).val();
                var vtrp_4 = trp_4.eq(index).val();
                var vtrp_5 = trp_5.eq(index).val();
                var vtrp_6 = trp_6.eq(index).val();
                
                var vrpt1 = rpt1.eq(index).val();
                var vrpt2 = rpt2.eq(index).val();
                var vrpt3 = rpt3.eq(index).val();
                var vrpt4 = rpt4.eq(index).val();
                var vrpt5 = rpt5.eq(index).val();
                var vrpt6 = rpt6.eq(index).val();
                if(trp_1.eq(index).val() == '') {vtrp_1=0;}
                if(trp_2.eq(index).val() == '') {vtrp_2=0;}
                if(trp_3.eq(index).val() == '') {vtrp_3=0;}
                if(trp_4.eq(index).val() == '') {vtrp_4=0;}
                if(trp_5.eq(index).val() == '') {vtrp_5=0;}
                if(trp_6.eq(index).val() == '') {vtrp_6=0;}
                if(rpt1.eq(index).val() == '') {vrpt1=0;}
                if(rpt2.eq(index).val() == '') {vrpt2=0;}
                if(rpt3.eq(index).val() == '') {vrpt3=0;}
                if(rpt4.eq(index).val() == '') {vrpt4=0;}
                if(rpt5.eq(index).val() == '') {vrpt5=0;}
                if(rpt6.eq(index).val() == '') {vrpt6=0;}
                
                hasil_rp1 = (parseInt(vrpt1)/parseInt(vtrp_1))*100;
                hasil_rp2 = (parseInt(vrpt2)/parseInt(vtrp_2))*100;
                hasil_rp3 = (parseInt(vrpt3)/parseInt(vtrp_3))*100;
                hasil_rp4 = (parseInt(vrpt4)/parseInt(vtrp_4))*100;
                hasil_rp5 = (parseInt(vrpt5)/parseInt(vtrp_5))*100;
                hasil_rp6 = (parseInt(vrpt6)/parseInt(vtrp_6))*100;
                  // $('input[id-k12="'+$(this).attr('id-target')+'"]').val(hasil_k12);
                //$('span[id-k12="'+$(this).attr('id-target')+'"]').text(hasil_k12);
                rpras1.eq(index).val(hasil_rp1.toFixed(2));
                rpras2.eq(index).val(hasil_rp2.toFixed(2));
                rpras3.eq(index).val(hasil_rp3.toFixed(2));
                rpras4.eq(index).val(hasil_rp4.toFixed(2));
                rpras5.eq(index).val(hasil_rp5.toFixed(2));
                rpras6.eq(index).val(hasil_rp6.toFixed(2));
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
        $('input[id^="id_ind_prog"]').each(function(index) {
            kprog(index);
        });

        $("#btn-simpan").click(function(e) {
            
            $("#txt-simpan").html('Menyimpan');
            $("#icon-simpan").removeClass('fa fa-save');
            $("#icon-simpan").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            $("#icon-simpan").css("background", "url('{{ asset('public/assets/img/123.svg') }}')");
            $("#btn-simpan").addClass('disabled');
            
            
            var url = "{{ route('evaluasi_renstra.store') }}";
            $.ajaxSetup({
                headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            e.preventDefault();

            //prog form
            var id_ind_prog = $('input[id="id_ind_prog[]"]').map(function(){ return this.value; }).get();
            var ket_prog = $('textarea[id="ket_prog[]"]').map(function(){ return this.value; }).get();
            var fpenghambat_prog = $('textarea[id="fpenghambat_prog[]"]').map(function(){ return this.value; }).get();
            var fpendorong_prog = $('textarea[id="fpendorong_prog[]"]').map(function(){ return this.value; }).get();

            var ap_re = $('textarea[id="p_t6[]"]').map(function(){ return this.value; }).get();
            // console.log('ket='+ket_prog);
            // var ap_t6 = $(p_t6).map(function(){ return this.value; }).get();
            // var ap_re = $(p_re).map(function(){ return this.value; }).get();
            // var ap_t7 = $(p_t7).map(function(){ return this.value; }).get();
            var ap_t1 = $(p_t1).map(function(){ return this.value; }).get();
            var ap_t2 = $(p_t2).map(function(){ return this.value; }).get();
            var ap_t3 = $(p_t3).map(function(){ return this.value; }).get();
            var ap_t4 = $(p_t4).map(function(){ return this.value; }).get();
            var ap_t5 = $(p_t5).map(function(){ return this.value; }).get();
            var ap_t6 = $(p_t6).map(function(){ return this.value; }).get();
            // console.log(formData);
            var id_target = $('input[id="id_target[]"]').map(function(){ return this.value; }).get();
            // var ak5 = $(k5).map(function(){ return this.value; }).get();
            // var ak6 = $(k6).map(function(){ return this.value; }).get();
            // var ak7 = $(k7).map(function(){ return this.value; }).get();
            var akt1 = $(kt1).map(function(){ return this.value; }).get();
            var akt2 = $(kt2).map(function(){ return this.value; }).get();
            var akt3 = $(kt3).map(function(){ return this.value; }).get();
            var akt4 = $(kt4).map(function(){ return this.value; }).get();
            var akt5 = $(kt5).map(function(){ return this.value; }).get();
            var akt6 = $(kt6).map(function(){ return this.value; }).get();
            var ket_keg = $('textarea[id="ket_keg[]"]').map(function(){ return this.value; }).get();
            var fpenghambat_keg = $('textarea[id="fpenghambat_keg[]"]').map(function(){ return this.value; }).get();
            var fpendorong_keg = $('textarea[id="fpendorong_keg[]"]').map(function(){ return this.value; }).get();
            
            var id_renja = $('input[id="id_renja[]"]').map(function(){ return this.value; }).get();
            // var arp5 = $(rp5).map(function(){ return this.value; }).get();
            // var arp6 = $(rp6).map(function(){ return this.value; }).get();
            // var ak7 = $(k7).map(function(){ return this.value; }).get();
            var arpt1 = $(rpt1).map(function(){ return this.value; }).get();
            var arpt2 = $(rpt2).map(function(){ return this.value; }).get();
            var arpt3 = $(rpt3).map(function(){ return this.value; }).get();
            var arpt4 = $(rpt4).map(function(){ return this.value; }).get();
            var arpt5 = $(rpt5).map(function(){ return this.value; }).get();
            var arpt6 = $(rpt6).map(function(){ return this.value; }).get();
            // var arp9 = $(rp9).map(function(){ return this.value; }).get();
            // var arp10 = $(rp10).map(function(){ return this.value; }).get();
            // var arp11 = $(rp11).map(function(){ return this.value; }).get();
            
            var data_renja=$('#datarenja').val();
            var formData = {
                id_ind_prog: id_ind_prog,
                ket_prog: ket_prog,
                fpenghambat_prog: fpenghambat_prog,
                fpendorong_prog: fpendorong_prog,
                p_re: ap_re,
                p_t1: ap_t1,
                p_t2: ap_t2,
                p_t3: ap_t3,
                p_t4: ap_t4,
                p_t5: ap_t5,
                p_t6: ap_t6,
                id_target: id_target,
                kt1: akt1,
                kt2: akt2,
                kt3: akt3,
                kt4: akt4,
                kt5: akt5,
                kt6: akt6,
                ket_keg: ket_keg,
                fpenghambat_keg: fpenghambat_keg,
                fpendorong_keg: fpendorong_keg,
                id_renja: id_renja,
                rpt1: arpt1,
                rpt2: arpt2,
                rpt3: arpt3,
                rpt4: arpt4,
                rpt5: arpt5,
                rpt6: arpt6,
                data_renja: data_renja,
            }
            
            // console.log(formData);
            
            $.ajax({
                type    : "POST",
                url     : url,
                data    : formData,
                dataType: 'json',
                success : function (data) {
                    $('#wait').hide();
                    // console.log(data);
                    alert(data.msg);
                    $("#hasil").html(data);
                    
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');;
                    $("#btn-simpan").removeClass('disabled');
                },
                error: function (jqXHR, status, thrownError) {
                    alert('error, Refresh kembali halaman');
                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(responseText);
                    console.log('Error:', responseText.message);
                    $('#wait').hide();
                    $("#txt-simpan").html('Simpan');
                    $("#icon-simpan").addClass('fa fa-save');
                    $("#icon-simpan").html('');
                    $("#icon-simpan").removeAttr('style');;
                    $("#btn-simpan").removeClass('disabled');
                }
            });

        });

        // hitung program
        function kprog(index){
            var hp_t1="";
            var hp_t2="";
            var hp_t3="";
            var hp_t4="";
            var hp_t5="";
            var hp_t6="";

            // var vp_t6 = p_t6.eq(index).val();
            // var vp_re = p_re.eq(index).val();
            // var vp_t7 = p_t7.eq(index).val();
            var vtt1 = tt1.eq(index).val();
            var vtt2 = tt2.eq(index).val();
            var vtt3 = tt3.eq(index).val();
            var vtt4 = tt4.eq(index).val();
            var vtt5 = tt5.eq(index).val();
            var vtt6 = tt6.eq(index).val();
            
            var vp_t1 = p_t1.eq(index).val();
            var vp_t2 = p_t2.eq(index).val();
            var vp_t3 = p_t3.eq(index).val();
            var vp_t4 = p_t4.eq(index).val();
            var vp_t5 = p_t5.eq(index).val();
            var vp_t6 = p_t6.eq(index).val();
            
            // if(p_t6.eq(index).val() == '') {vp_t6=0;}
            // if(p_re.eq(index).val() == '') {vp_re=0;}
            // if(p_t7.eq(index).val() == '') {vp_t7=0;}
            if(tt1.eq(index).val() == '') {vtt1=0;}
            if(tt2.eq(index).val() == '') {vtt2=0;}
            if(tt3.eq(index).val() == '') {vtt3=0;}
            if(tt4.eq(index).val() == '') {vtt4=0;}
            if(tt5.eq(index).val() == '') {vtt5=0;}
            if(tt6.eq(index).val() == '') {vtt6=0;}

            if(p_t1.eq(index).val() == '') {vp_t1=0;}
            if(p_t2.eq(index).val() == '') {vp_t2=0;}
            if(p_t3.eq(index).val() == '') {vp_t3=0;}
            if(p_t4.eq(index).val() == '') {vp_t4=0;}
            if(p_t5.eq(index).val() == '') {vp_t5=0;}
            if(p_t6.eq(index).val() == '') {vp_t6=0;}

            // $('#p_12k-'+index).val(Number($('#p_t1-'+index).val())+Number($('#p_t2-'+index).val())+Number($('#p_t3-'+index).val())+Number($('#p_t4-'+index).val()));
            hp_t1=(Number(vp_t1)/Number(vtt1))*100;
            hp_t2=(Number(vp_t2)/Number(vtt2))*100;
            hp_t3=(Number(vp_t3)/Number(vtt3))*100;
            hp_t4=(Number(vp_t4)/Number(vtt4))*100;
            hp_t5=(Number(vp_t5)/Number(vtt5))*100;
            hp_t6=(Number(vp_t6)/Number(vtt6))*100;
            
            p_12k.eq(index).val(hp_t1.toFixed(2));
            p_13k.eq(index).val(hp_t2.toFixed(2));
            p_14k.eq(index).val(hp_t3.toFixed(2));
            p_15k.eq(index).val(hp_t4.toFixed(2));
            p_16k.eq(index).val(hp_t5.toFixed(2));
            p_17k.eq(index).val(hp_t6.toFixed(2));
        }

// });
</script>

@endsection