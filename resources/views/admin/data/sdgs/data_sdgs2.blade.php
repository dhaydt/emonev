@if($download==1)
@php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=data-sdgs.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
@endphp
@endif

@if( Auth::guard('web')->check() and $download!=1)
    @section('title', 'CRUD BLOG')
    @section('content')
@else
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>SIMONEV Dokumen Perencanaan Daerah)</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ asset('public/assets/img/logo.png') }}">

    
    <link href="{{ asset('public/template/color_admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('public/template/color_admin/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
</head>
<body>
@endif
<h3 class="page-header">Data SDGs 2019 @if($download!=1) | <a href="?download=1">Download Excel</a> @endif</h3>

@if( Auth::guard('web')->check() and $download!=1)
<div class="row">
    <div class="col-md-12">
    
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title">Data Realisasi SDGs 2019</h4>
        </div>
        <div class="panel-body">
@endif      
<table border=1 class="table table-bordered table-hover table-striped">
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama Program/Kegiatan</th>
        <th rowspan="2">Indikator</th>
        <th rowspan="2">Satuan</th>
        <th colspan="2" class="text-center">Target 2019</th>
        <th colspan="2" class="text-center">Realisasi 2019 (Sampai triwulan II)</th>
        <th rowspan='2' class="text-center">OPD</th>
    </tr>
    <tr>
        <th class="text-center">K</th>
        <th class="text-center">Rp</th>
        <th class="text-center">K</th>
        <th class="text-center">Rp</th>
    </tr>
    @php
    $noprogram=0;
    @endphp
    @foreach($rpjmd_prog as $keyp=>$prog)
    @php
        $ceksdgs=$sdgs->where('idprgrm',$prog->idprgrm)->where('id_instansi',$prog->id_instansi)->first();
        if($ceksdgs!="" and $ceksdgs->sdgscek==1){
        $noprogram++;
        $noprog=$noprogram;
        $opd=$prog->opd_program();
        $nmprog="Program ".$prog->master_program->nmprgrm;

        @endphp
        @foreach($prog->indikator_program() as $indprogk=>$indprog)
        
        @php
        if($indprogk>0){
            $nmprog="";
            $noprog="";
            $noprog="";
            $opd="";
        }
        

        $realisasi_tprog="";
        if($indprog->realisasi_tprog!=""){
            $realisasi_tprog=$indprog->realisasi_tprog->p_t1+$indprog->realisasi_tprog->p_t2+$indprog->realisasi_tprog->p_t3+$indprog->realisasi_tprog->p_t4;
        }
        @endphp
    <tr>
        <td style="background-color: skyblue">{{$noprog}}</td>
        <td style="background-color: skyblue">{{$nmprog}}</td>
        <td style="background-color: skyblue">{{$indprog->indikator}}</td>
        <td style="background-color: skyblue">{{$indprog->satuan}}</td>
        <td style="background-color: skyblue" class="text-center">{{$indprog->t4}}</td>
        <td style="background-color: skyblue" class="text-right">@if($indprogk<1)<span id='tot_pt{{$noprogram}}'></span>@endif</td>
        <td style="background-color: skyblue" class="text-center">{{$realisasi_tprog}}</td>
        <td style="background-color: skyblue" class="text-right">@if($indprogk<1)<span id='tot_pr{{$noprogram}}'></span>@endif</td>
        <td style="background-color: skyblue">{{$opd}}</td>
    </tr>
              
        @endforeach
        @php
        // start kegiatan
        $baris_akhir=14;
        $no_keg=0;
        $kegiatan=$renja->where('idprgrm',$prog->idprgrm)->where('id_instansi',$prog->id_instansi);
        $no=0;
        $baris_keg_mulai=$baris_akhir;
        $tdana=0;
        $trealisasi=0;
        foreach ($kegiatan as $kk => $vr) {
          $no++;
          $no_keg++;
          $kdkeg=$noprogram.".".$no;
          $nmkeg=null;
          $nmsasaran=null;
          if($vr->master_kegiatan!=null){
            $nmkeg=$vr->master_kegiatan->nmkegunit;
          }
          if($vr->sasaran_pembangunan!=null){
           $nmsasaran=$vr->sasaran_pembangunan->sasaran;
          }
          $dana=$vr->belanja_p_now+$vr->belanja_bj_now+$vr->belanja_m_now;
          $tdana=$tdana+$dana;
          $jml_ind_keg = count($vr->indikator_kegiatan_target());
          
            $rp5="";
            $rp6="";
            $rpt1="";
            $rpt2="";
            $rpt3="";
            $rpt4="";
            if($vr->realisasi_renja != ""){
                $rp5 = $vr->realisasi_renja->rp5+0;
                $rp6 = $vr->realisasi_renja->rp6+0;
                $rpt1 = $vr->realisasi_renja->rpt1+0;
                $rpt2 = $vr->realisasi_renja->rpt2+0;
                $rpt3 = $vr->realisasi_renja->rpt3+0;
                $rpt4 = $vr->realisasi_renja->rpt4+0;
            }

            $isi=$vr->indikator_kegiatan_target();
            $tolokur="";$tolokur2="";
            for($k=0;$k<$jml_ind_keg;$k++){
            if($k>0){
              $nmkeg="";$dana="";$no_keg=0;
              $rp5="";$rp6="";
              $rpt1="";$rpt2="";$rpt3="";$rpt4="";
              $kdkeg="";
            }
            $target_det=$isi[$k]['target_det'];
            $tolokur=$isi[$k]['tolokur'];
            if($tolokur==$tolokur2){$tolokur="";}else{$tolokur=$isi[$k]['tolokur'];$tolokur2=$isi[$k]['tolokur'];}
              $rtarget=$isi[$k]['kt1']+$isi[$k]['kt2']+$isi[$k]['kt3']+$isi[$k]['kt4'];
              
              if($rpt1!=""){
                $realisasi=$rpt1+$rpt2+$rpt3+$rpt4;
                $trealisasi=$trealisasi+$realisasi;
              }else{
                $realisasi="";
              }

              echo"<tr>
                <td>".$kdkeg."</td>
                <td>$nmkeg</td>
                <td>".$isi[$k]['tolokur']."</td>
                <td>".$isi[$k]['sat_det']."</td>
                <td align='center'>".$target_det."</td>
                <td align='right'>".$dana."</td>
                <td align='center'>$rtarget</td>
                <td align='right'>$realisasi</td>
                <td>".$vr->singkatan_opd()."</td>
              </tr>";
    
            $baris_akhir++;
            }
            
        }
        // end kegiatan
        @endphp
        <script type="text/javascript">
          $("#tot_pt{{$noprogram}}").text({{$tdana}});
          $("#tot_pr{{$noprogram}}").text({{$trealisasi}});
        </script>
        @php
        }
        @endphp
    @endforeach
</table>

@if(Auth::guard('web')->check() and $download!=1)
            </div>
        </div>
        </div>
    </div>
    @endsection
@else
</body>
</html>
@endif