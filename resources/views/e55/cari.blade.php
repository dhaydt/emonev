@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Formulir E.55</div>
                <div class='navbar-nav ml-auto' style="padding:5px;">
                <form method="GET" action="{{route('carie55')}}" class="form-inline">
                    Periode Pelaksanaan: 
                    <input class="form-control mr-sm-1" type="text" name="periode" placeholder="Periode Pelaksanaan">
                    
                    Indikator: 
                    <input class="form-control mr-sm-1" type="text" name="indikator" placeholder="Indikator">
                    <button class="btn btn-info" type="submit">Search</button>
                </form>
                </div>

                <div class=""><center>Formulir E.55</center></div>
                <div class=""><center>Evaluasi Hasil Terhadap RENJA Perangkat Daerah Lingkup Provinsi</center></div>
                <div class=""><center>RENJA Perangkat Daerah Provinsi Sumatera Barat</center></div>
                <div class=""><center>Periode Pelaksanaan: {{$periode}}</center></div>
                <div class="container-fluid">Indikator dan Target Kinerja Perangkat Daerah Provinsi yang Mengacu pada Sasaran RKPD Provinsi:</div>
                <div class="container-fluid">{{$indikator}}</div>
                <p align='center'>
                <a href="" class="btn btn-danger btn-sm">Export To PDF</a>
                <a href="" class="btn btn-success btn-sm">Export To Excel</a>
                </p>
                <div class="card-body">
                <div style="overflow:auto;">
                <table class="table table-bordered table-hover table-stripped text-center" style="font-size:11px;" width="100%">
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>Kode</th>
                        <th rowspan=2>Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
                        <th rowspan=2>Indikator Kinerja Program (<i>outcome</i>)/Kegiatan(<i>output</i>)</th>
                        <th rowspan=4>Satuan</th>                        
                        <th rowspan=2 colspan=2>Target Renstra Perangkat Daerah Provinsi pada Tahun {{$periode}} (akhir periode Renstra)</th>
                        <th rowspan=2 colspan=2>Realisasi Capaian Kinerja Renstra Perangkat Daerah Provinsi s/d Renja Perangkat Daerah Tahun Lalu (n-2)</th>
                        <th rowspan=2 colspan=2>Target Kinerja dan Anggaran Renja Perangkat Daerah Provinsi Tahun Berjalan (Tahun n-1) yang dievaluasi</th>
                        <th colspan=8>Realisasi Kinerja Pada Triwulan</th>
                        <th rowspan=2 colspan=2>Realisasi Capaian Kinerja dan Anggaran Renja Perangkat Daerah Provinsi yang dievaluasi</th>
                        <th rowspan=2 colspan=2>Tingkat Capaian Kinerja dan Realisasi Anggaran Renja PD Tahun n-1(%)</th>
                        <th rowspan=2 colspan=2>Realisasi Kinerja Anggaran Renstra Perangkat Daerah Provinsi s/d Tahun {{$periode}} (akhir Tahun Pelaksanaan Renja Perangkat Daerah Provinsi Tahun {{$periode}})</th>
                        <th rowspan=2 colspan=2>Tingkat Capaian Kinerja dan Realisasi Anggaran Renstra Perangkat Daerah Provinsi s/d Tahun (%)</th>
                        <th rowspan=2>Unit Perangkat Daerah Penanggung Jawab</th>
                        <th rowspan=2>Lokasi/Ket</th>
                    </tr>
                    <tr>
                        <th colspan=2>I</th>
                        <th colspan=2>II</th>
                        <th colspan=2>III</th>
                        <th colspan=2>IV</th>
                    </tr>
                    <tr>
                        <th rowspan=2>(1)</th>
                        <th rowspan=2>(2)</th>
                        <th rowspan=2>(3)</th>
                        <th rowspan=2>(4)</th>
                        <th colspan=2>(5)</th>
                        <th colspan=2>(6)</th>
                        <th colspan=2>(7)</th>
                        <th colspan=2>(8)</th>
                        <th colspan=2>(9)</th>
                        <th colspan=2>(10)</th>
                        <th colspan=2>(11)</th>
                        <th colspan=2>(12) = 8+9+10+11</th>
                        <th colspan=2>(13) = 12/7 * 100%</th>
                        <th colspan=2>(14) = 6+12</th>
                        <th colspan=2>(15) = 14/5 * 100%</th>
                        <th rowspan=2>(16)</th>
                        <th rowspan=2>(17)</th>
                    </tr>
                    <tr>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                        <th>K</th>
                        <th>Rp</th>
                    </tr>

                    @foreach ($urusan as $val)
                        @if($val->id_instansi==$user->id_instansi)
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-left">Urusan<br> {{$val->jenis}}</td>
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-left">Bidang Urusan <br>{{$val->urusan}}
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-left">
                            Program <br>
                            @php $no1=0; @endphp
                            @foreach($program as $ip)
                                @if($ip->id_urusan==$val->id_urusan)
                                    @php $no1++; @endphp <b>{{$no1}}. </b> {{$ip->nmprgrm}}<br>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @php $no1=0; @endphp
                            @foreach($program as $ip)
                                @if($ip->id_urusan==$val->id_urusan)
                                    @php $no1++; @endphp <b>{{$no1}}. </b> {{$ip->indikator}}<br>
                                @endif
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
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-left">Kegiatan </td>
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
                    <tr>
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
                        @endif
                    @endforeach

                    <tr>
                        <td colspan=11 class="text-right">Rata-Rata Capaian Kinerja (%)</td>
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
                    <tr>
                        <td colspan=11 class="text-right">Predikat Kinerja</td>
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
                    <tr>
                        <td colspan=41 class="text-left">Faktor Pendorong Keberhasilan Kinerja:</td>
                    </tr>
                    <tr>
                        <td colspan=41 class="text-left">Faktor Penghambat Pencapaian Kinerja:</td>
                    </tr>
                    </tr>
                        <td colspan=41 class="text-left">Tindak Lanjut yang Diperlukan dalam Triwulan berikutnya *):</td>
                    <tr>
                    </tr>                    
                        <td colspan=41 class="text-left">Tindak Lanjut yang diperlukan dalam Renja Perangkat Daerah Provinsi Berikutnya *):</td>
                    </tr>
                </table>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
