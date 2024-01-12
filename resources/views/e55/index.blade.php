@extends('layouts.template')

@section('content')
<div class="bs-example4" style="padding:15px;" data-example-id="contextual-table">            
   <ol class="breadcrumb">
        <li><i class="lnr lnr-home"></i> Home</li>
        <li>Evaluasi Renja</li>
        <li class="active">Preview</li>

        <div class="pull-right"><b>Preview Formulir E.55</b></div>
    </ol>               
                <form method="GET" action="{{route('evaluasi-renja')}}" class="form-inline">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                Periode Pelaksanaan: 
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="periode">
                                    @php
                                    $thn=date('Y');
                                    @endphp
                                    @for($y=2018;$y<=$thn;$y++)
                                     <option>{{$y}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <!--Indikator: -->
                                <input class="form-control mr-sm-1" type="hidden" name="indikator" placeholder="Indikator">
                                <button class="btn btn-primary btn-sm" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                    

                </form>


                <div class=""><center>Evaluasi Hasil Terhadap RENJA Perangkat Daerah Lingkup Provinsi</center></div>
                <div class=""><center>RENJA Perangkat Daerah Provinsi Sumatera Barat</center></div>
                <div class=""><center>Periode Pelaksanaan: {{$periode}}</center></div>
                <div class="container-fluid">Indikator dan Target Kinerja Perangkat Daerah Provinsi yang Mengacu pada Sasaran RKPD Provinsi:</div>
                <div class="container-fluid">{{$indikator}}</div>
                <p align='center'>
                    <center>
                    <div class="btn-group">
                        <a class="btn btn-default text-white"><i class="fa fa-search"></i> Preview</a>
                        <a class="btn btn-default text-white"><i class="fa fa-book "></i> Export To PDF</a>
                        <a class="btn btn-default text-white"><i class="fa fa-file-text"></i> Export To Excel</a>
                    </div>
                    </center>
                </p><br>
                
                <style type="text/css">
                .wrapper1, .wrapper2{width: 100%; border: none 0px RED;
                    overflow-x: scroll; overflow-y:hidden;}
                    .div1 {width:120%; height: 20px; }
                    .div2 {width:120%;
                    overflow: auto;}
                </style>
                
                <div class="wrapper1">
                    <div class="div1">
                    </div>
                </div>
                <div class="wrapper2">
                <div class="div2" style="overflow: auto">
                <table class="table table-bordered table-hover table-stripped text-center" style="font-size:12px;">
                    <tr>
                        <th rowspan=2 class="text-center">No</th>
                        <th rowspan=2 colspan=3 class="text-center">Kode</th>
                        <th rowspan=2 class="text-center">Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
                        <th rowspan=2 class="text-center">Indikator Kinerja Program (<i>outcome</i>)/Kegiatan(<i>output</i>)</th>
                        <th rowspan=4 class="text-center">Satuan</th>                        
                        <th rowspan=2 colspan=2 class="text-center">Target Renstra Perangkat Daerah Provinsi pada Tahun 2016-2020 (akhir periode Renstra)</th>
                        <th rowspan=2 colspan=2 class="text-center">Realisasi Capaian Kinerja Renstra Perangkat Daerah Provinsi s/d Renja Perangkat Daerah Tahun Lalu ({{$periode-1}})</th>
                        <th rowspan=2 colspan=2 class="text-center">Target Kinerja dan Anggaran Renja Perangkat Daerah Provinsi Tahun Berjalan ({{$periode}}) yang dievaluasi</th>
                        <th colspan=8 class="text-center">Realisasi Kinerja Pada Triwulan</th>
                        <th rowspan=2 colspan=2 class="text-center">Realisasi Capaian Kinerja dan Anggaran Renja Perangkat Daerah Provinsi yang dievaluasi</th>
                        <th rowspan=2 colspan=2 class="text-center">Tingkat Capaian Kinerja dan Realisasi Anggaran Renja PD Tahun n-1(%)</th>
                        <th rowspan=2 colspan=2 class="text-center">Realisasi Kinerja Anggaran Renstra Perangkat Daerah Provinsi s/d Tahun {{$periode}} (akhir Tahun Pelaksanaan Renja Perangkat Daerah Provinsi Tahun {{$periode}})</th>
                        <th rowspan=2 colspan=2 class="text-center">Tingkat Capaian Kinerja dan Realisasi Anggaran Renstra Perangkat Daerah Provinsi s/d Tahun (%)</th>
                        <th rowspan=2 class="text-center">Unit Perangkat Daerah Penanggung Jawab</th>
                        <th rowspan=2 class="text-center">Lokasi/Ket</th>
                    </tr>
                    <tr>
                        <th colspan=2 class="text-center">I</th>
                        <th colspan=2 class="text-center">II</th>
                        <th colspan=2 class="text-center">III</th>
                        <th colspan=2 class="text-center">IV</th>
                    </tr>
                    <tr>
                        <th rowspan=2 class="text-center">(1)</th>
                        <th rowspan=2 class="text-center" colspan=3>(2)</th>
                        <th rowspan=2 class="text-center">(3)</th>
                        <th rowspan=2 class="text-center">(4)</th>
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
                    @php $no=1;@endphp
                    <!--non urusan-->
                    <tr class="bg-danger">
                        <td><b>{{$no}}</b></td>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td class="text-left"><b>{{$nonurusan}}</b>
                        </td>
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
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($datanonurusan as $valprog1)
                    <tr class="bg-warning">
                        <td></td>
                        <td></td>
                        <td>{{$valprog1->idprgrm}}</td>
                        <td></td>
                        <td class="text-left">
                            <b>Program <br>
                             {{$valprog1->nmprgrm}}
                         </b>
                        </td>
                        <td>
                            @foreach($valprog1->arrinprog as $valinprog)
                                {{$valinprog->inprog}}<br>
                            @endforeach
                            <!--{{count((array)$valprog1->arrinprog)}}-->
                        </td>
                        <td>
                            @foreach($valprog1->arrinprog as $valinprog)
                                {{$valinprog->satinprog}}<br>
                            @endforeach
                        </td>
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
                        <td></td>
                    </tr>

                    @foreach($valprog1->arrkeg as $valkeg1)
                        
                        @if(count((array)$valkeg1->arrinkeg)<=1)
                            @php $r=1; @endphp
                        @else
                            @php $r=count((array)$valkeg1->arrinkeg); @endphp
                        @endif
                    <tr>
                        <td rowspan="{{$r}}"></td>
                        <td rowspan="{{$r}}"></td>
                        <td rowspan="{{$r}}"></td>
                        <td rowspan="{{$r}}">{{$valkeg1->kdkegunit}}</td>
                        <td rowspan="{{$r}}" class="text-left">
                            {{$valkeg1->nmkegunit}}
                        </td>
                        @php $noin=0; @endphp
                        @foreach($valkeg1->arrinkeg as $valinkeg)
                            @php $noin++; @endphp
                            @if(!count((array)$valkeg1->arrinkeg)<=1 and !$noin>1)
                            </tr>
                            <tr>
                            @endif
                                <td>
                                    {{$valinkeg->inkeg}}<br>
                                </td>
                                <td>{{$valinkeg->satinkeg}}</td>
                                <td>{{$valinkeg->v5_k}}</td>
                                <td>{{number_format($valinkeg->v5,2,",",".")}}</td>
                                <td>{{$valinkeg->v6_k}}</td>
                                <td>{{number_format($valinkeg->v6,2,",",".")}}</td>
                                <td>{{$valinkeg->v7_k}}</td>
                                <td>{{number_format($valinkeg->v7,2,",",".")}}</td>
                                <td>{{$valinkeg->t1_k}}</td>
                                <td>{{number_format($valinkeg->t1,2,",",".")}}</td>
                                <td>{{$valinkeg->t2_k}}</td>
                                <td>{{number_format($valinkeg->t2,2,",",".")}}</td>
                                <td>{{$valinkeg->t3_k}}</td>
                                <td>{{number_format($valinkeg->t3,2,",",".")}}</td>
                                <td>{{$valinkeg->t4_k}}</td>
                                <td>{{number_format($valinkeg->t4,2,",",".")}}</td>
                                <td>{{$valinkeg->v12_k}}</td>
                                <td>{{number_format($valinkeg->v12,2,",",".")}}</td>
                                <td>{{$valinkeg->v13_k}}</td>
                                <td>{{number_format($valinkeg->v13,2,",",".")}}</td>
                                <td>{{$valinkeg->v14_k}}</td>
                                <td>{{number_format($valinkeg->v14,2,",",".")}}</td>
                                <td>{{$valinkeg->v15_k}}</td>
                                <td>{{number_format($valinkeg->v15,2,",",".")}}</td>
                                <td>{{$valinkeg->pjawab}}</td>
                                <td>{{$valinkeg->ket}}</td>
                            </tr>

                        @endforeach

                    @endforeach

                    @endforeach
                    <tr height='25'>
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!--urusan-->
                    @foreach ($dataurusan as $val)
                    @php $no++;@endphp
                    <!--
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$val->id_urusan}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-left"><b>{{$val->jenis}}</b></td>
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
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    -->
                    <tr class="bg-danger">
                        <td><b>{{$no}}</b></td>
                        <td>{{$val->id_urusan}}</td>
                        <td></td>
                        <td></td>
                        <td class="text-left"><b>{{$val->urusan}}</b>
                        </td>
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
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($val->arrprogkeg as $valprog)
                    <tr class="bg-warning">
                        <td></td>
                        <td></td>
                        <td>{{$valprog->idprgrm}}</td>
                        <td></td>
                        <td class="text-left">
                            <b>Program <br>
                             {{$valprog->nmprgrm}}
                         </b>
                        </td>
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
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    @foreach($valprog->arrkeg as $valkeg)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$valkeg->kdkegunit}}</td>
                        <td class="text-left">
                            {{$valkeg->nmkegunit}}
                        </td>
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
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach

                    @endforeach

                    <tr height='25'>
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach

                    <tr class="bg-info">
                        <td colspan=13 class="text-right">Rata-Rata Capaian Kinerja (%)</td>
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
                        <td colspan=8></td>
                    </tr>
                    <tr class="bg-info">
                        <td colspan=13 class="text-right">Predikat Kinerja</td>
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
                        <td colspan=8></td>
                    </tr>
                    <tr  class="bg-info">
                        <td colspan=41 class="text-left">Faktor Pendorong Keberhasilan Kinerja:</td>
                    </tr>
                    <tr class="bg-info">
                        <td colspan=41 class="text-left">Faktor Penghambat Pencapaian Kinerja:</td>
                    </tr>
                    <tr class="bg-info">
                        <td colspan=41 class="text-left">Tindak Lanjut yang Diperlukan dalam Triwulan berikutnya *):</td>
                    </tr>
                    <tr class="bg-info">                    
                        <td colspan=41 class="text-left">Tindak Lanjut yang diperlukan dalam Renja Perangkat Daerah Provinsi Berikutnya *):</td>
                    </tr>
                </table>

                <script type="text/javascript">
                    $(function(){
                    $(".wrapper1").scroll(function(){
                        $(".wrapper2")
                            .scrollLeft($(".wrapper1").scrollLeft());
                    });
                    $(".wrapper2").scroll(function(){
                        $(".wrapper1")
                            .scrollLeft($(".wrapper2").scrollLeft());
                    });
                });
                </script>

            </div>
        </div>
</div>

@endsection
