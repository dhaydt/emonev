@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Evaluasi Terhadap Hasil RKPD</div>
                <div class=""><center>Formulir E.19</center></div>
                <div class=""><center>Evaluasi Terhadap Hasil RKPD</center></div>
                <div class=""><center>Provinsi Sumatera Barat</center></div>
                <div class=""><center>Tahun: {{$tahun1}}</center></div>
                <p align='center'>
                <a href="" class="btn btn-danger btn-sm">Export To PDF</a>
                <a href="" class="btn btn-success btn-sm">Export To Excel</a>
                </p>
                <div class="card-body">
                <table class="table table-bordered table-hover table-stripped text-center" style="font-size:11px;" width="100%">
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>Sasaran</th>
                        <th rowspan=2 colspan=4>Kode</th>
                        <th rowspan=2>Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
                        <th rowspan=2>Indikator Kinerja Program(<i>outcome</i>)/Kegiatan(<i>output</i>)</th>
                        <th rowspan=2 colspan=2>Target RPJMD Provinsi pada Tahun {{$tahun1}} (Akhir Periode RPJMD)</th>
                        <th rowspan=2 colspan=2>Realisasi Capaian Kinierja RPJMD Provinsi sampai dengan RKPD Provinsi Tahun Lalu (n-2)</th>
                        <th rowspan=2 colspan=2>Target Kinerja dan Anggaran RKPD Provinsi Tahun Berjalan (tahun n-1) yang Dievaluasi</th>
                        <th colspan=8>Realisasi Kinerja Pada Triwulan</th>
                        <th colspan=2 rowspan=2>Realisasi Capaian Kinierja dan Anggaran RKPD Provinsi yang Dievaluasi</th>
                        <th colspan=2 rowspan=2>Realisasi Kinierja Anggaran RPJMD Provinsi s/d Tahun {{$tahun1}} (Akhir Tahun PelaksanaanRKPD Tahun {{$tahun1}})</th>
                        <th colspan=2 rowspan=2>Tingakat Capaian Kinerja dan Realisasi Anggaran RPJMD Provinsi s/d Tahun {{$tahun1}} (%)</th>
                        <th rowspan=2>Perangkat Daerah Penanggung Jawab</th>
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
                        <th rowspan=2 colspan=4>(3)</th>
                        <th rowspan=2>(4)</th>
                        <th rowspan=2>(5)</th>
                        <th colspan=2>(6)</th>
                        <th colspan=2>(7)</th>
                        <th colspan=2>(8)</th>
                        <th colspan=2>(9)</th>
                        <th colspan=2>(10)</th>
                        <th colspan=2>(11)</th>
                        <th colspan=2>(12)</th>
                        <th colspan=2>(13)</th>
                        <th colspan=2>(14) = 7+13</th>
                        <th colspan=2>(15) = 14/6 * 100%</th>
                        <th rowspan=2>(16)</th>
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
                    <tr>
                        <td colspan=14 class="text-right">Rata-Rata Capaian Kinerja (%)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan=5></td>
                    </tr>
                    <tr>
                        <td colspan=14 class="text-right">Predikat Kinerja</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan=5></td>
                    </tr>
                    <tr>
                        <td colspan=41 class="text-left">Faktor Pendorong Keberhasilan Kinerja:</td>
                    </tr>
                    <tr>
                        <td colspan=41 class="text-left">Faktor Penghambat Pencapaian Kinerja:</td>
                    </tr>
                    </tr>
                        <td colspan=41 class="text-left">Tindak Lanjut yang diperlukan dalam Triwulan Berikutnya:</td>
                    <tr>
                    </tr>                    
                        <td colspan=41 class="text-left">Tindak Lanjut yang diperlukan dalam RKPD Berikutnya:</td>
                    </tr>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
