@php
if($dok=="Excel"){
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Evaluasi Renja_".str_replace(',',' ',$opd->nm_instansi)."_Triwulan".$triwulan."_".$periode.".xls");
}
@endphp
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
		/*background-color:#000;*/
		font-family: "Arial Narrow";
		font-size: 10px;
	}	
	
</style>


</head>
<body>
	@php
	if($jenis=="RKPD"){
		$nmj="RPJMD Provinsi";
		$jns="RKPD Provinsi";
	}else{
		$nmj="Renstra Perangkat Daerah";
		$jns="Renja Perangkat Daerah";
	}
	@endphp

	@php 
    //$novr=1; 

    if($triwulan=="IV"){
    	$triwulan_ke=4;
	}elseif($triwulan=="III"){
    	$triwulan_ke=3;
	}elseif($triwulan=="II"){
    	$triwulan_ke=2;
	}elseif($triwulan=="I"){
    	$triwulan_ke=1;
	}

    $renstra1_dis="disabled=disabled";
    $renstra2_dis="disabled=disabled";
    //$t1_dis="disabled=disabled";
    //$t2_dis="disabled=disabled";
    $t1_dis="";
    $t2_dis="";
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

<table width="100%">
	<tr><th colspan='29'><b>FORMULIR T-C.19</b></th></tr>
	@if($jenis=="RKPD")
	<tr><th colspan='29'><b>Evaluasi Terhadap Hasil RKPD</b></th></tr>
	<tr><th colspan='29'><b>Kota Bukittinggi</b></th></tr>
	@else	
	<tr><th colspan='29'><b>Evaluasi Hasil Pelaksanaan Perencanaan Daerah sampai dengan Tahun Berjalan</b></th></tr>	
	<tr><th colspan='29'><b>{{$opd->nm_instansi}}</b></th></tr>
	@endif	
	<tr><th colspan='29'><b>Periode Pelaksanaan : {{$periode}}</b></th></tr>	
</table>

<table>
	<tr><td></td></tr>
</table>


<table border='1' style="border-collapse: collapse;">
	<thead>
	<tr>
	    <th rowspan=2 align="center" style="vertical-align: top;" valign="top"><center>No</center></th>
	    <th rowspan=2 align="center" style="vertical-align: top;" valign="top"><center>Kode</center></th>
	    <th rowspan=2 align="center" style="vertical-align: top;">Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Indikator Kinerja Program (<i>outcome</i>)/Kegiatan(<i>output</i>)</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Capaian Kinerja RPJMD Pada Tahun 2026 (Akhir Periode RPJMD)</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Realisasi Capaian Kinerja RKPD s/d Tahun Lalu<br>(n-2)<br>({{$periode-1}})</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Target Kinerja dan Anggaran RKPD Tahun Berjalan yang dievaluasi (tahun n-1)<br>{{$periode}}</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Realisasi Capaian Kinerja dan Anggaran RKPD yang dievaluasi (Tahun n-1)<br>{{$periode-1}}</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Tingkat Capaian Kinerja dan Realisasi Anggaran RKPD (%)</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Realisasi Kinerja Anggaran RKPD s/d Tahun n-1<br>{{$periode-1}}</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD s/d Tahun n-1 (%)<br>{{$periode}}</th>
	    <th rowspan=2 align="center" style="vertical-align: top;">Perangkat Daerah Penanggung Jawab</th>
	    <th rowspan=2 align="center" style="vertical-align: top;">Ket</th>
	</tr>
	<tr>
	</tr>
	<tr>
	    <th rowspan=2 align="center">(1)</th>
	    <th rowspan=2 align="center">(2)</th>
	    <th rowspan=2 align="center">(3)</th>
	    <th rowspan=2 colspan="2" align="center">(4)</th>
	    <th colspan=2 align="center">(5)</th>
	    <th colspan=2 align="center">(6)</th>
	    <th colspan=2 align="center">(7)</th>
	    <th colspan=2 align="center">(8)</th>
	    <th colspan=2 align="center">(9) = 8/7 * 100%</th>
	    <th colspan=2 align="center">(10) = 6+8</th>
	    <th colspan=2 align="center">(11) = 10/5 * 100%</th>
	    <th rowspan=2 align="center">(12)</th>
	    <th rowspan=2 align="center">(13)</th>
	</tr>
	<tr>
	    <th align="center">K</th>
	    <th align="center">Rp</th>
	    <th align="center">K</th>
	    <th align="center">Rp</th>
	    <th align="center">K</th>
	    <th align="center">Rp</th>
	    <th align="center">K</th>
	    <th align="center">Rp</th>
	    <th align="center">K</th>
	    <th align="center">Rp</th>
	    <th align="center">K</th>
	    <th align="center">Rp</th>
	    <th align="center">K</th>
	    <th align="center">Rp</th>
	</tr>
	</thead>
	<tbody>

	@php
	if($data_renja=="perubahan") 
		$pagu_opd=@$opd->pagu($periode)->jpagu_perubahan;
	else{
		$pagu_opd=@$opd->pagu($periode)->jpagu_awal;
	}
	$opd_trp5=@$opd->rp_real_opd($periode,$data_renja)->trp5;
	$opd_trp6=@$opd->rp_real_opd($periode,$data_renja)->trp6;

	$opd_t1=@$opd->rp_real_opd($periode,$data_renja)->t1;
	if($triwulan_ke>=2){
		$opd_t2=@$opd->rp_real_opd($periode,$data_renja)->t2;
	}else{$opd_t2=null;}
	if($triwulan_ke>=3){
		$opd_t3=@$opd->rp_real_opd($periode,$data_renja)->t3;
	}else{$opd_t3=null;}
	if($triwulan_ke>=4){
		$opd_t4=@$opd->rp_real_opd($periode,$data_renja)->t4;
	}else{$opd_t4=null;}

	$opd_t=@$opd_t1+@$opd_t2+@$opd_t3+@$opd_t4;
	$opd_t13=@($opd_t/$pagu_opd)*100;
	$opd_t14=@($opd_t+$opd_trp6);
	$opd_t15=@($opd_t14/$opd_trp5)*100;
	@endphp
	<tr style="background-color: #57FF00;font-weight: bold;">
	    <td></td>
	    <td></td>
	    <td>{{$opd->nm_instansi}}</td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td align="right">{{number_format($opd_trp5,0,',','.')}}</td>
	    <td></td>
	    <td align="right">{{number_format($opd_trp6,0,',','.')}}</td>
	    <td></td>
	    <td align="right">{{number_format($pagu_opd,0,',','.')}}</td>
	    <td></td>
	    <td align="right">{{number_format($opd_t,0,',','.')}}</td>
	    <td></td>
	    <td align="center">{{number_format($opd_t13,2,',','.')}}</td>
	    <td></td>
	    <td align="right">{{number_format($opd_t14,0,',','.')}}</td>
	    <td></td>
	    <td align="center">{{number_format($opd_t15,2,',','.')}}</td>
	    <td></td>
	    <td></td>
	</tr>

@php
$pecah=explode(",",$urusan_opd->arr_urusan); 
$no2=0;
@endphp

@foreach($pecah as $value)
	@php 
   $du = $dafunit->where('unitkey','=',$value);

   $turusan="";
   @endphp

   <!-- Urusan -->
	@foreach($du as $vd)
		@php $turusan_baru=$vd->parent->nm_unit; @endphp
	    @if($turusan!=$turusan_baru)
	    @php 
		    $turusan=$turusan_baru; 

		    if($data_renja=="perubahan") 
		         $pagu_t_urusan=@$vd->parent->pagu_turusan($opd->id,$periode)->jpagu_perubahan;
		    else{
		         $pagu_t_urusan=@$vd->parent->pagu_turusan($opd->id,$periode)->jpagu_awal;
		    }

		    $t_urusan_trp5=@$vd->parent->rp_real_t_urusan($periode,$data_renja,$opd->id)->trp5;
		    $t_urusan_trp6=@$vd->parent->rp_real_t_urusan($periode,$data_renja,$opd->id)->trp6;

		    $t_urusan_t1=@$vd->parent->rp_real_t_urusan($periode,$data_renja,$opd->id)->t1;
		    if($triwulan_ke>=2){
		    	$t_urusan_t2=@$vd->parent->rp_real_t_urusan($periode,$data_renja,$opd->id)->t2;
		    }else{$t_urusan_t2=null;}
		    if($triwulan_ke>=3){
		    	$t_urusan_t3=@$vd->parent->rp_real_t_urusan($periode,$data_renja,$opd->id)->t3;
		    }else{$t_urusan_t3=null;}
		    if($triwulan_ke>=4){
		    	$t_urusan_t4=@$vd->parent->rp_real_t_urusan($periode,$data_renja,$opd->id)->t4;
		    }else{$t_urusan_t4=null;}

		    
		    $t_urusan_t=@$t_urusan_t1+@$t_urusan_t2+@$t_urusan_t3+@$t_urusan_t4;
		    $t_urusan_t13=@($t_urusan_t/$pagu_t_urusan)*100;
		    $t_urusan_t14=@($t_urusan_t+$t_urusan_trp6);
		    $t_urusan_t15=@($t_urusan_t14/$t_urusan_trp5)*100;
	    @endphp
	    <tr style="background-color: yellow;font-weight: bold;">
	        <td></td>
	        <td>@if(substr($value,0,1) == 'X') {{ substr($opd->unit_key,0,1) }} @else {{substr($value,0,1)}} @endif</td>
	        <td>{{$turusan_baru}}</td>
	        <td></td>
	        <td></td>
	        <td></td>
	        <td align="right">{{number_format($t_urusan_trp5,0,',','.')}}</td>
	        <td></td>
	        <td align="right">{{number_format($t_urusan_trp6,0,',','.')}}</td>
	        <td></td>
	        <td align="right">{{number_format($pagu_t_urusan,0,',','.')}}</td>
	        <td></td>
	        <td align="right">{{number_format($t_urusan_t,0,',','.')}}</td>
	        <td></td>
	        <td align="center">{{number_format($t_urusan_t13,2,',','.')}}</td>
	        <td></td>
	        <td align="right">{{number_format($t_urusan_t14,0,',','.')}}</td>
	        <td></td>
	        <td align="center">{{number_format($t_urusan_t15,2,',','.')}}</td>
	        <td></td>
	        <td></td>
	    </tr>
	    @endif
	    @php
	    if($data_renja=="perubahan") 
	    	$pagu_b_urusan=@$vd->pagu($opd->id,$periode)->jpagu_perubahan;
	    else{
	    	$pagu_b_urusan=@$vd->pagu($opd->id,$periode)->jpagu_awal;
	    }

	    $b_urusan_trp5=@$vd->rp_real_b_urusan($periode,$data_renja,$opd->id)->trp5;
	    $b_urusan_trp6=@$vd->rp_real_b_urusan($periode,$data_renja,$opd->id)->trp6;

	    $b_urusan_t1=@$vd->rp_real_b_urusan($periode,$data_renja,$opd->id)->t1;
	    if($triwulan_ke>=2){
	    	$b_urusan_t2=@$vd->rp_real_b_urusan($periode,$data_renja,$opd->id)->t2;
	    }else{$b_urusan_t2=null;}
	    if($triwulan_ke>=3){
		    $b_urusan_t3=@$vd->rp_real_b_urusan($periode,$data_renja,$opd->id)->t3;
	    }else{$b_urusan_t3=null;}
	    if($triwulan_ke>=4){
	    	$b_urusan_t4=@$vd->rp_real_b_urusan($periode,$data_renja,$opd->id)->t4;
	    }else{$b_urusan_t4=null;}


	    $b_urusan_t=@$b_urusan_t1+@$b_urusan_t2+@$b_urusan_t3+@$b_urusan_t4;
	    $b_urusan_t13=@($b_urusan_t/$pagu_b_urusan)*100;
	    $b_urusan_t14=@($b_urusan_t+$b_urusan_trp6);
	    $b_urusan_t15=@($b_urusan_t14/$b_urusan_trp5)*100;
	    @endphp
    <tr style="background-color: #E8A600;font-weight: bold;">
        <td></td>
        <td>@if($value == 'X.XX') {{ $opd->unit_key }} @else {{$value}} @endif</td>
        <td>{{$vd->nm_unit}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">{{number_format($b_urusan_trp5,0,',','.')}}</td>
        <td></td>
        <td align="right">{{number_format($b_urusan_trp6,0,',','.')}}</td>
        <td></td>
        <td align="right">{{number_format($pagu_b_urusan,0,',','.')}}</td>
        <td></td>
        <td align="right">{{number_format($b_urusan_t,0,',','.')}}</td>
        <td></td>
        <td align="center">{{number_format($b_urusan_t13,2,',','.')}}</td>
        <td></td>
        <td align="right">{{number_format($b_urusan_t14,0,',','.')}}</td>
        <td></td>
        <td align="center">{{number_format($b_urusan_t15,2,',','.')}}</td>
        <td></td>
        <td></td>
    </tr>

    <!-- Program -->
    @foreach($rpjmd_prog->where('unitkey','=',$vd->kdunit) as $prog)
    
    <tr>
        <td style="background-color: #0CDDE8"></td>
        <td style="background-color: #0CDDE8"><b>@if(substr($prog->master_program->id,0,4) == 'X.XX') {{ $opd->unit_key }}.{{ substr($prog->master_program->id,5,2) }} @else {{$prog->master_program->id}} @endif</b></td>
        @php
        if($prog->nmprog!=""){
            $nomenklatur_prog=$prog->nmprog;
        }else{
            $nomenklatur_prog=$prog->master_program->nmprgrm;
        }
        @endphp
        <td style="background-color: #0CDDE8"><b>{{$nomenklatur_prog}}</b></td>
        @php 
            $jml_ind_prog = count($prog->rkpd_prog($data_renja)); 
            $no_pink=0;
        @endphp
        
        @foreach($prog->rkpd_prog($data_renja) as $pi)
            @php               
                if($data_renja!="perubahan"){
                    $sat_prog="";
                    
                    $v7k=$pi->target_awal;
                    
                    $piindikator=$pi->indikator_awal;
                    $pisatuan=$pi->sat_awal;
                }else{
                    $sat_prog="";

                    $v7k=$pi->target_perubahan;

                    $piindikator=$pi->indikator_perubahan;
                    $pisatuan=$pi->sat_perubahan;
                }
                $simpan_p="";

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
                if($pi->realisasi_tprog!=""){
                    $tkrpjmd=$pi->realisasi_tprog->p_ak;
                    //$tkrpjmd="";
                    $pre=$pi->realisasi_tprog->p_re;
                    
                    $pt1=$pi->realisasi_tprog->p_t1;
                    if($triwulan_ke>=2){
                    	$pt2=$pi->realisasi_tprog->p_t2;
                    }else{$pt2=null;}
                    if($triwulan_ke>=3){
	                    $pt3=$pi->realisasi_tprog->p_t3;
                    }else{$pt3=null;}
                    if($triwulan_ke>=4){
                    	$pt4=$pi->realisasi_tprog->p_t4;
                    }else{$pt4=null;}
                    
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
                

                    $p_t6=$tkrpjmd;
                    $prog_re=$pre;
                    $p_t7=$v7k;

                    $p_t1=$pt1;
                    $p_t2=$pt2;
                    $p_t3=$pt3;
                    $p_t4=$pt4;

                    $p_12k=(float)$p_t1+(float)$p_t2+(float)$p_t3+(float)$p_t4;
                    $p_13k=number_format(@($p_12k/$p_t7)*100,2,',','.');
                    $p_14k=$p_12k+(float)$prog_re;
                    $p_15k=number_format(@($p_14k/$p_t6)*100,2,',','.');

                    $ket_prog="{$ketp}";
                    $fpenghambat_prog="";
                    $fpendorong_prog="";



                    $prog_trp5=@$prog->rp_real_prog($periode,$data_renja)->trp5;
                    $prog_trp6=@$prog->rp_real_prog($periode,$data_renja)->trp6;

                    if($data_renja=="perubahan") 
                    	$pagu_prog=@$prog->pagu($opd->id,$periode)->jpagu_perubahan;
                    else{
                    	$pagu_prog=@$prog->pagu($opd->id,$periode)->jpagu_awal;
                    }

                    $prog_t1=@$prog->rp_real_prog($periode,$data_renja)->t1;
                    
                    if($triwulan_ke>=2){
                    	$prog_t2=@$prog->rp_real_prog($periode,$data_renja)->t2;
                    }else{$prog_t2=null;}
                    if($triwulan_ke>=3){
	                    $prog_t3=@$prog->rp_real_prog($periode,$data_renja)->t3;
                    }else{$prog_t3=null;}
                    if($triwulan_ke>=4){
                    	$prog_t4=@$prog->rp_real_prog($periode,$data_renja)->t4;
                    }else{$prog_t4=null;}

                    $prog_t=@$prog_t1+@$prog_t2+@$prog_t3+@$prog_t4;
                    $prog_t13=@($prog_t/$pagu_prog)*100;
                    $prog_t14=@($prog_t+$prog_trp6);
                    $prog_t15=@($prog_t14/$prog_trp5)*100;
                    
            
            $no_pink++;
            @endphp

            @if($jml_ind_prog>1)
                @if($no_pink<=1)
                <td style="background-color: #0CDDE8">{{$piindikator}}</td>
                <td style="background-color: #0CDDE8">{{$pisatuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                <td align='center' style="background-color: #0CDDE8" >@php echo $p_t6; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($prog_trp5,0,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $prog_re; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($prog_trp6,0,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_t7; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($pagu_prog,0,',','.')}}</td>


                <td align='center' style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($prog_t,0,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                <td align='center' style="background-color: #0CDDE8">{{number_format($prog_t13,2,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($prog_t14,0,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                <td align='center' style="background-color: #0CDDE8">{{number_format($prog_t15,2,',','.')}}</td>
                <td style="background-color: #0CDDE8"></td>
                <td style="background-color: #0CDDE8">@php echo $ket_prog; @endphp</td>
                </tr>
                @else
                </tr>
                <tr>
                <td style="background-color: #0CDDE8"></td>
                <td style="background-color: #0CDDE8"></td>
                <td style="background-color: #0CDDE8"></td>
                <td style="background-color: #0CDDE8">{{$piindikator}}</td>
                <td style="background-color: #0CDDE8">{{$pisatuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                <td align='center' style="background-color: #0CDDE8" >@php echo $p_t6; @endphp</td>
                <td style="background-color: #0CDDE8"></td>
                <td align='center' style="background-color: #0CDDE8">@php echo $prog_re; @endphp</td>
                <td style="background-color: #0CDDE8"></td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_t7; @endphp</td>
                <td style="background-color: #0CDDE8"></td>

                <td align='center' style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                <td style="background-color: #0CDDE8"></td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                <td style="background-color: #0CDDE8"></td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                <td style="background-color: #0CDDE8"></td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                <td style="background-color: #0CDDE8"></td>
                <td style="background-color: #0CDDE8"></td>
                <td style="background-color: #0CDDE8">@php echo $ket_prog; @endphp</td>
                </tr>
                @endif

            @else
                
                <td style="background-color: #0CDDE8">{{$piindikator}}</td>
                <td style="background-color: #0CDDE8">{{$pisatuan}} @php echo $sat_prog; echo $simpan_p; @endphp</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_t6; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($prog_trp5,0,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8"><?php echo $prog_re; ?></td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($prog_trp6,0,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_t7; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($pagu_prog,0,',','.')}}</td>

                <td align='center' style="background-color: #0CDDE8">@php echo $p_12k; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($prog_t,0,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_13k; @endphp</td>
                <td align='center' style="background-color: #0CDDE8">{{number_format($prog_t13,2,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_14k; @endphp</td>
                <td align='right' style="background-color: #0CDDE8">{{number_format($prog_t14,0,',','.')}}</td>
                <td align='center' style="background-color: #0CDDE8">@php echo $p_15k; @endphp</td>
                <td align='center' style="background-color: #0CDDE8">{{number_format($prog_t15,2,',','.')}}</td>
                <td style="background-color: #0CDDE8"></td>
                <td style="background-color: #0CDDE8">@php echo $ket_prog; @endphp</td> 
                </tr>
            @endif

        @endforeach

        <!-- Kegiatan -->
        @php 
        $index=-1;$index_rp=-1; 
        $novr=1;
        @endphp
        <!-- kegiatan 1 -->
        @foreach($rkpd_keg->where('idprog',$prog->idprog) as $rkpdkeg)
            <tr>
                <td style="background-color: silver"></td>
                <td style="background-color: silver"><b>@if(substr($rkpdkeg->master_kegiatan->id,0,4) == 'X.XX') {{ $opd->unit_key }}.{{ substr($rkpdkeg->master_kegiatan->id,5,6) }} @else {{$rkpdkeg->master_kegiatan->id}} @endif</b></td>
                @php
                if($rkpdkeg->nmkeg!=""){
                    $nomenklatur_keg=$rkpdkeg->nmkeg;
                }else{
                    $nomenklatur_keg=$rkpdkeg->master_kegiatan->nmkegunit;
                }
                @endphp
                <td style="background-color: silver"><b>{{$nomenklatur_keg}}</b></td>
            	
            	@php 
            	                $jml_ind_kegiatan = count($rkpdkeg->rkpd_keg($data_renja)); 
            	                $no_pinkegiatan=0;
            	            @endphp
            	            @foreach($rkpdkeg->rkpd_keg($data_renja) as $pi)
            	                @php 
            	                    
            	                    if($data_renja!="perubahan"){
            	                        $sat_kegiatan="";
            	                        
            	                        $v7k=$pi->target_awal;
            	                        
            	                        $piindikator=$pi->indikator_awal;
            	                        $pisatuan=$pi->sat_awal;
            	                    }else{
            	                        $sat_kegiatan="";

            	                        $v7k=$pi->target_perubahan;

            	                        $piindikator=$pi->indikator_perubahan;
            	                        $pisatuan=$pi->sat_perubahan;
            	                    }
            	                    $simpan_kegiatan="";

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
            	                        
            	                        $pt1=$pi->realisasi_tkegiatan->k_t1;
                                        if($triwulan_ke>=2){
                                        	$pt2=$pi->realisasi_tkegiatan->k_t2;
                                        }else{$pt2=null;}
                                        if($triwulan_ke>=3){
                    	                    $pt3=$pi->realisasi_tkegiatan->k_t3;
                                        }else{$pt3=null;}
                                        if($triwulan_ke>=4){
                    	                    $pt4=$pi->realisasi_tkegiatan->k_t4;
                                        }else{$pt4=null;}


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
            	                    
            	                        $k_t6=(float)$tkrpjmd;
            	                        $rkpdkeg_re=(float)$pre;
            	                        $k_t7=(float)$v7k;

            	                        $k_t1=(float)$pt1;
            	                        $k_t2=(float)$pt2;
            	                        $k_t3=(float)$pt3;
            	                        $k_t4=(float)$pt4;

            	                        $k_12k=$k_t1+$k_t2+$k_t3+$k_t4;
            	                        $k_13k=number_format(@($k_12k/$k_t7)*100,2,',','.');
            	                        $k_14k=$k_12k+$rkpdkeg_re;
            	                        $k_15k=number_format(@($k_14k/$k_t6)*100,2,',','.');

            	                        $ket_kegiatan="{$ketp}";
            	                        
            	                		if($data_renja=="perubahan"){
            	                			$pagu_kegiatan=@$rkpdkeg->pagu($opd->id,$periode)->jpagu_perubahan;
            	                		}else{
            	                			$pagu_kegiatan=@$rkpdkeg->pagu($opd->id,$periode)->jpagu_awal;
            	                		}

            	                		$keg_trp5=@$rkpdkeg->rp_real_keg($periode,$data_renja)->trp5;
            	                		$keg_trp6=@$rkpdkeg->rp_real_keg($periode,$data_renja)->trp6;
            	                		
            	                		$keg_t1=@$rkpdkeg->rp_real_keg($periode,$data_renja)->t1;
            		                    if($triwulan_ke>=2){
            		                    	$keg_t2=@$rkpdkeg->rp_real_keg($periode,$data_renja)->t2;
            		                    }else{$keg_t2=null;}
            		                    if($triwulan_ke>=3){
            		                    	$keg_t3=@$rkpdkeg->rp_real_keg($periode,$data_renja)->t3;
            		                    }else{$keg_t3=null;}
            		                    if($triwulan_ke>=4){
            		                    	$keg_t4=@$rkpdkeg->rp_real_keg($periode,$data_renja)->t4;
            		                    }else{$keg_t4=null;}

            	                		$keg_t=$keg_t1+$keg_t2+$keg_t3+$keg_t4;
            	                		$keg_t13=@($keg_t/$pagu_kegiatan)*100;
            	                		$keg_t14=@($keg_t+$keg_trp6);
            	                		$keg_t15=@($keg_t14/$keg_trp5)*100;

            	                $no_pinkegiatan++;
            	                @endphp

            	                @if($jml_ind_kegiatan>1)
            	                    @if($no_pinkegiatan<=1)
            	                    <td style="background-color: silver">{{$piindikator}}</td>
            	                    <td style="background-color: silver">{{$pisatuan}} @php echo $sat_kegiatan; echo $simpan_kegiatan; @endphp</td>
            	                    <td align="center" style="background-color: silver"  class="text-right">@php echo $k_t6; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($keg_trp5,0,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $rkpdkeg_re; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($keg_trp6,0,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $k_t7; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($pagu_kegiatan,0,',','.')}}</td>


            	                    <td align="center" style="background-color: silver">@php echo $k_12k; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($keg_t,0,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $k_13k; @endphp</td>
            	                    <td align="center" style="background-color: silver">{{number_format($keg_t13,2,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $k_14k; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($keg_t14,0,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $k_15k; @endphp</td>
            	                    <td align="center" style="background-color: silver">{{number_format($keg_t15,2,',','.')}}</td>
            	                    <td style="background-color: silver"></td>
            	                    <td style="background-color: silver">@php echo $ket_kegiatan; @endphp</td>

            	                    </tr>
            	                    @else
            	                    </tr>
            	                    <tr>
            	                    <td style="background-color: silver"></td>
            	                    <td style="background-color: silver"></td>
            	                    <td style="background-color: silver"></td>
            	                    <td style="background-color: silver">{{$piindikator}}</td>
            	                    <td style="background-color: silver">{{$pisatuan}} @php echo $sat_kegiatan; echo $simpan_kegiatan; @endphp</td>
            	                    <td align="center" style="background-color: silver"  class="text-right">@php echo $k_t6; @endphp</td>
            	                    <td style="background-color: silver"></td>
            	                    <td align="center" style="background-color: silver">@php echo $rkpdkeg_re; @endphp</td>
            	                    <td style="background-color: silver"></td>
            	                    <td align="center" style="background-color: silver">@php echo $k_t7; @endphp</td>
            	                    <td style="background-color: silver"></td>

            	                    <td align="center" style="background-color: silver">@php echo $k_12k; @endphp</td>
            	                    <td style="background-color: silver"></td>
            	                    <td align="center" style="background-color: silver">@php echo $k_13k; @endphp</td>
            	                    <td style="background-color: silver"></td>
            	                    <td align="center" style="background-color: silver">@php echo $k_14k; @endphp</td>
            	                    <td style="background-color: silver"></td>
            	                    <td align="center" style="background-color: silver">@php echo $k_15k; @endphp</td>
            	                    <td style="background-color: silver"></td>
            	                    <td style="background-color: silver"></td>
            	                    <td style="background-color: silver">@php echo $ket_kegiatan; @endphp</td>
            	                    </tr>
            	                    @endif

            	                @else
            	                    
            	                    <td style="background-color: silver">{{$piindikator}}</td>
            	                    <td style="background-color: silver">{{$pisatuan}} @php echo $sat_kegiatan; echo $simpan_kegiatan; @endphp</td>
            	                    <td align="center" style="background-color: silver" class="text-right">@php echo $k_t6; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($keg_trp5,0,',','.')}}</td>
            	                    <td align="center" style="background-color: silver"><?php echo $rkpdkeg_re; ?></td>
            	                    <td align="right" style="background-color: silver">{{number_format($keg_trp6,0,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $k_t7; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($pagu_kegiatan,0,',','.')}}</td>

            	                    <td align="center" style="background-color: silver">@php echo $k_12k; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($keg_t,0,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $k_13k; @endphp</td>
            	                    <td align="center" style="background-color: silver">{{number_format($keg_t13,2,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $k_14k; @endphp</td>
            	                    <td align="right" style="background-color: silver">{{number_format($keg_t14,0,',','.')}}</td>
            	                    <td align="center" style="background-color: silver">@php echo $k_15k; @endphp</td>
            	                    <td align="center" style="background-color: silver">{{number_format($keg_t15,2,',','.')}}</td>
            	                    <td style="background-color: silver"></td>
            	                    <td style="background-color: silver">@php echo $ket_kegiatan; @endphp</td>
            	                    </tr>
            	                @endif

            	            @endforeach
                
                <!-- Sub Kegiatan -->
         		@php
         		$rata_capaian_k=0;
         		$rata_capaian=0;
         		$predikat_k="-";
         		$predikat="-";
         		@endphp
                @foreach($rkpdkeg->rkpd_subkeg($data_renja) as $vr)
                    @php 
                        $jml_ind_keg = count($vr->rkpd_subkeg($data_renja));
                        $no_ink=0;

                        $rp5=null;
                        $rp6=null;
                        $rpt1=null;
                        $rpt2=null;
                        $rpt3=null;
                        $rpt4=null;
                        if($vr->realisasi_renja($data_renja) != ""){
                            $rp5 = $vr->realisasi_renja($data_renja)->rp5;
                            $rp6 = $vr->realisasi_renja($data_renja)->rp6;
                            
                            $rpt1 = $vr->realisasi_renja($data_renja)->rpt1;
                            if($triwulan_ke>=2){
                            	$rpt2 = $vr->realisasi_renja($data_renja)->rpt2;
                            }else{$rpt2=null;}
                            if($triwulan_ke>=3){
                            	$rpt3 = $vr->realisasi_renja($data_renja)->rpt3;
                            }else{$rpt3=null;}
                            if($triwulan_ke>=4){
                            	$rpt4 = $vr->realisasi_renja($data_renja)->rpt4;
                            }else{$rpt4=null;}

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
                        <td>@if(substr($vr->master_subkegiatan->id,0,4) == 'X.XX') {{ $opd->unit_key }}.{{ substr($vr->master_subkegiatan->id,5,9) }} @else {{$vr->master_subkegiatan->id}} @endif</td>
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
                            
                            $ket_keg="{$ketk}";
                            
                        @endphp
                        @if($jml_ind_keg>1)
                            @if($no_ink<=1)
                            <!-- id : {{$vik->id}} {{$vik->id_target}} -->
                            @php $index++;$index_rp++; @endphp
                            <td>{{$tolokur}}</td>
                            <td>{{$vik->sat_det}}</td>
                            
                            <td align="center">{{$vik->k5}}</td>
                            <td align="right">{{number_format($rp5,0,',','.')}} </td>
                            
                            <td align="center">{{$vik->k6}}</td>
                            <td align="right">{{number_format($rp6,0,',','.')}} </td>

                            <td align="center">{{$target_det}}</td>
                            <td align="right">{{number_format($dana,0,',','.')}}</td>
                            

                            <td align="center">
                            	@if($triwulan_ke==1)
                            		{{$vik->kt1}}
                            	@elseif($triwulan_ke==2)
                            		{{$vik->kt1+$vik->kt2}}
                            	@elseif($triwulan_ke==3)
                            		{{$vik->kt1+$vik->kt2+$vik->kt3}}
                            	@elseif($triwulan_ke==4)
                            		{{$vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4}}
                            	@endif
                            </td>
                            <td align="right">{{number_format($rpt1+$rpt2+$rpt3+$rpt4,0,',','.')}} </td>
                            
                            <td align="center">
                            	@if($triwulan_ke==1)
                            		{{number_format(@(($vik->kt1)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==2)
                            		{{number_format(@(($vik->kt1+$vik->kt2)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==3)
                            		{{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==4)
                            		{{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4)/$target_det)*100,2,',','.')}}
                            	@endif

                            </td>
                            <td align="center">{{number_format(@(($rpt1+$rpt2+$rpt3+$rpt4)/$dana)*100,2,',','.')}} </td>
                            
                            <td align="center">
                            	@if($triwulan_ke==1)
                            		{{$vik->kt1+$vik->k6}}
                            	@elseif($triwulan_ke==2)
                            		{{$vik->kt1+$vik->kt2+$vik->k6}}
                            	@elseif($triwulan_ke==3)
                            		{{$vik->kt1+$vik->kt2+$vik->kt3+$vik->k6}}
                            	@elseif($triwulan_ke==4)
	                            	{{$vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6}}
                            	@endif
                            </td>
                            <td align="right">{{number_format($rpt1+$rpt2+$rpt3+$rpt4+$rp6,0,',','.')}}</td>

                            <td align='center'>
                            	@if($triwulan_ke==1)
                            		{{number_format(@(($vik->kt1+$vik->k6)/$vik->k5)*100,2,',','.')}}
                            	@elseif($triwulan_ke==2)
                            		{{number_format(@(($vik->kt1+$vik->kt2+$vik->k6)/$vik->k5)*100,2,',','.')}}
                            	@elseif($triwulan_ke==3)
                            		{{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->k6)/$vik->k5)*100,2,',','.')}}
                            	@elseif($triwulan_ke==4)
	                            	{{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6)/$vik->k5)*100,2,',','.')}}
                            	@endif
                            </td>
                            <td align="center">{{number_format(@(($rpt1+$rpt2+$rpt3+$rpt4+$rp6)/$rp5)*100,2,',','.')}} </td>

                            <td>{{@$vr->singkatan_opd()}}</td>
                            <td>@php echo $ket_keg; @endphp</td>
                            </tr>

		                            @php
		                            	if($triwulan_ke==1){
		                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->k6)/$vik->k5)*100);
		                            	}elseif($triwulan_ke==2){
		                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->k6)/$vik->k5)*100);
		                            	}elseif($triwulan_ke==3){
		                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->k6)/$vik->k5)*100);
		                            	}elseif($triwulan_ke==4){
			                            	$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6)/$vik->k5)*100);
		                            	}
		                            	
		                            	$rata_capaian=$rata_capaian+(@(($rpt1+$rpt2+$rpt3+$rpt4+$rp6)/$rp5)*100);
		                            @endphp
                            @else
                            @php $index++; @endphp
                            </tr>
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$tolokur}}</td>
                            <td>{{$vik->sat_det}}</td>
                            <td align="center">{{$vik->k5}}</td>
                            <td></td>
                            <td align="center">{{$vik->k6}}</td>
                            <td></td>
                            <td align="center">{{$target_det}}</td>
                            <td></td>

                            <td align="center">
                            	@if($triwulan_ke==1)
                            		{{$vik->kt1}}
                            	@elseif($triwulan_ke==2)
                            		{{$vik->kt1+$vik->kt2}}
                            	@elseif($triwulan_ke==3)
                            		{{$vik->kt1+$vik->kt2+$vik->kt3}}
                            	@elseif($triwulan_ke==4)
                            		{{$vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4}}
                            	@endif
                            </td>
                            <td></td>
                            <td align="center">
                            	@if($triwulan_ke==1)
                            		{{number_format(@(($vik->kt1)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==2)
                            		{{number_format(@(($vik->kt1+$vik->kt2)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==3)
                            		{{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==4)
                            		{{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4)/$target_det)*100,2,',','.')}}
                            	@endif
                            </td>
                            <td></td>
                            <td align="center">
                            	@if($triwulan_ke==1)
                            		{{$vik->kt1+$vik->k6}}
                            	@elseif($triwulan_ke==2)
                            		{{$vik->kt1+$vik->kt2+$vik->k6}}
                            	@elseif($triwulan_ke==3)
                            		{{$vik->kt1+$vik->kt2+$vik->kt3+$vik->k6}}
                            	@elseif($triwulan_ke==4)
	                            	{{$vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6}}
                            	@endif
                            </td>
                            <td></td>
                            <td align='center'>
                            	@if($triwulan_ke==1)
                            		{{number_format(@(($vik->kt1+$vik->k6)/$vik->k5)*100,2,',','.')}}
                            	@elseif($triwulan_ke==2)
                            		{{number_format(@(($vik->kt1+$vik->kt2+$vik->k6)/$vik->k5)*100,2,',','.')}}
                            	@elseif($triwulan_ke==3)
                            		{{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->k6)/$vik->k5)*100,2,',','.')}}
                            	@elseif($triwulan_ke==4)
	                            	{{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6)/$vik->k5)*100,2,',','.')}}
                            	@endif
                            </td>
                            <td></td>
                            <td>{{$vr->singkatan_opd()}}</td>
                            <td>@php echo $ket_keg; @endphp</td>

                            </tr>

                            	@php
	                            	if($triwulan_ke==1){
	                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->k6)/$vik->k5)*100);
	                            	}elseif($triwulan_ke==2){
	                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->k6)/$vik->k5)*100);
	                            	}elseif($triwulan_ke==3){
	                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->k6)/$vik->k5)*100);
	                            	}elseif($triwulan_ke==4){
		                            	$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6)/$vik->k5)*100);
	                            	}
                            	@endphp
                            @endif

                        @else
                        
                            @php 
                                //$index++;$index_rp++; 
                                $index++; 
                            @endphp
                        @if($no_ink<=1)
                            @php 
                                $index_rp++;
                            @endphp
                        @endif
                            @if($no_ink>1)
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                            <td>{{$tolokur}} </td>
                            <td>{{$vik->sat_det}}</td>
                            
                            <td align="center">{{$vik->k5}}</td>
                            <td align="right">
                                 @if($no_ink<=1)
                                 {{number_format($rp5,0,',','.')}}
                                @endif
                            </td>
                            
                            <td align="center">{{$vik->k6}}</td>
                            <td align="right">
                                @if($no_ink<=1)
                                {{number_format($rp6,0,',','.')}}
                                @endif
                            </td>
                            
                            <td align="center">{{$target_det}}</td>
                            <td align="right">
                                @if($no_ink<=1)
                                {{number_format($dana,0,',','.')}}
                                @endif
                            </td>

                            <td align="center">
                            	@if($triwulan_ke==1)
                            	     {{$vik->kt1}}
                            	@elseif($triwulan_ke==2)
                            	     {{$vik->kt1+$vik->kt2}}
                            	@elseif($triwulan_ke==3)
                            	     {{$vik->kt1+$vik->kt2+$vik->kt3}}
                            	@elseif($triwulan_ke==4)
                            	     {{$vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4}}
                            	@endif
                            </td>
                            <td align="right">
                                @if($no_ink<=1)
                                {{number_format($rpt1+$rpt2+$rpt3+$rpt4,0,',','.')}}
                                @endif
                            </td>
                            <td align="center">
                            	@if($triwulan_ke==1)
                            	     {{number_format(@(($vik->kt1)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==2)
                            	     {{number_format(@(($vik->kt1+$vik->kt2)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==3)
                            	     {{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3)/$target_det)*100,2,',','.')}}
                            	@elseif($triwulan_ke==4)
                            	     {{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4)/$target_det)*100,2,',','.')}}
                            	@endif
                            </td>
                            <td align="center">
                                @if($no_ink<=1)
                                {{number_format(@(($rpt1+$rpt2+$rpt3+$rpt4)/$dana)*100,2,',','.')}}
                                @endif
                                
                            </td>
                            <td align="center">
                            	@if($triwulan_ke==1)
                            	     {{$vik->kt1+$vik->k6}}
                            	@elseif($triwulan_ke==2)
                            	     {{$vik->kt1+$vik->kt2+$vik->k6}}
                            	@elseif($triwulan_ke==3)
                            	     {{$vik->kt1+$vik->kt2+$vik->kt3+$vik->k6}}
                            	@elseif($triwulan_ke==4)
                            	     {{$vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6}}
                            	@endif
                            </td>
                            <td align="right">
                                @if($no_ink<=1)
                                {{number_format($rpt1+$rpt2+$rpt3+$rpt4+$rp6,0,',','.')}}
                                @endif
                            </td>
                            <td align='center'>
	                            @if($triwulan_ke==1)
	                                 {{number_format(@(($vik->kt1+$vik->k6)/$vik->k5)*100,2,',','.')}}
	                            @elseif($triwulan_ke==2)
	                                 {{number_format(@(($vik->kt1+$vik->kt2+$vik->k6)/$vik->k5)*100,2,',','.')}}
	                            @elseif($triwulan_ke==3)
	                                 {{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->k6)/$vik->k5)*100,2,',','.')}}
	                            @elseif($triwulan_ke==4)
	                                 {{number_format(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6)/$vik->k5)*100,2,',','.')}}
	                            @endif
                            </td>
                            <td align="center">
                                @if($no_ink<=1)
                                {{number_format(@(($rpt1+$rpt2+$rpt3+$rpt4+$rp6)/$rp5)*100,2,',','.')}}
                                @endif
                                
                            </td>
                            <td>{{$vr->singkatan_opd()}}</td>
                            <td>@php echo $ket_keg; @endphp</td>

                            </tr>

                            @php
	                            	if($triwulan_ke==1){
	                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->k6)/$vik->k5)*100);
	                            	}elseif($triwulan_ke==2){
	                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->k6)/$vik->k5)*100);
	                            	}elseif($triwulan_ke==3){
	                            		$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->k6)/$vik->k5)*100);
	                            	}elseif($triwulan_ke==4){
		                            	$rata_capaian_k=$rata_capaian_k+(@(($vik->kt1+$vik->kt2+$vik->kt3+$vik->kt4+$vik->k6)/$vik->k5)*100);
	                            	}

                            		$rata_capaian=$rata_capaian+(@(($rpt1+$rpt2+$rpt3+$rpt4+$rp6)/$rp5)*100);
                            	
                            @endphp
                        @endif
                        
                        @endif

                        @endforeach

                @endforeach
                	@php
	                	$trata_capaian_k=$rata_capaian_k/($index+1);
	                	$trata_capaian=$rata_capaian/($index_rp+1);

	                	if(is_infinite($trata_capaian_k)){
	                		$predikat_k="-";
	                	}elseif($trata_capaian_k>90){
	                		$predikat_k="ST";
	                	}elseif($trata_capaian_k>=76){
	                		$predikat_k="T";
	                	}elseif($trata_capaian_k>=66){
	                		$predikat_k="S";
	                	}elseif($trata_capaian_k>=51){
	                		$predikat_k="R";
	                	}elseif($trata_capaian_k>=0){
	                		$predikat_k="SR";
	                	}else{
	                		$predikat="-";
	                	}

	                	if(is_infinite($trata_capaian)){
	                		$predikat="-";
	                	}elseif($trata_capaian>90){
	                		$predikat="ST";
	                	}elseif($trata_capaian>=76){
	                		$predikat="T";
	                	}elseif($trata_capaian>=66){
	                		$predikat="S";
	                	}elseif($trata_capaian>=51){
	                		$predikat="R";
	                	}elseif($trata_capaian>=0){
	                		$predikat="SR";
	                	}else{
	                		$predikat="-";
	                	}
                	@endphp
                	<tr>
                		<td colspan="17">Rata-rata Capaian Kinerja ()</td>
                		<td align="center">{{number_format($trata_capaian_k,2,',','.')}}</td>
                		<td align="center">{{number_format($trata_capaian,2,',','.')}}</td>
                		<td></td>
                		<td></td>
                	</tr>
                	<tr>
                		<td colspan="17">Predikat Kinerja</td>
                		<td align="center">{{$predikat_k}}</td>
                		<td align="center">{{$predikat}}</td>
                		<td></td>
                		<td></td>
                	</tr>
                @endforeach
        <!-- End Kegiatan -->
    @endforeach
	<!-- End Program -->

    @endforeach
    <!-- end urusan -->
@endforeach
</tbody>
</table>

<br>
<br>
<table width="100%">
	<tr>
		<td width="75%" colspan="17"></td>
		<td width="25%" align="center">Dievaluasi</td>
	</tr>
	<tr>
		<td width="75%" colspan="17"></td>
		<td width="25%" align="center">Bukittinggi, ..................</td>
	</tr>
	<tr>
		<td width="75%" colspan="17"></td>
		<td width="25%" align="center"><b>Badan Perencanaa Pembangunan Penelitian dan Pengembangan Daerah</b></td>
	</tr>
	<tr>
		<td width="75%" colspan="17"></td>
		<td width="25%" align="center"><b>Kota Bukittinggi</b></td>
	</tr>
	<tr>
		<td width="75%" colspan="17"></td>
		<td width="25%" align="center"><b>Kepala</b></td>
	</tr><tr>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td width="75%" colspan="17"></td>
		<td width="25%" align="center" style="padding-top: 5rem;"><b><u>ROBBY NOVALDI, SE., M.Ec.Dev</u></b></td>
	</tr>
	<tr>
		<td width="75%" colspan="17"></td>
		<td width="25%" align="center"><b>NIP. 198111242002121002</b></td>
	</tr>
</table>
</body>
</html>