@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Formulir E.54</div>
                <div class=""><center>Formulir E.54</center></div>
                <div class=""><center>Evaluasi terhadap Hasil Renstra Perangkat Daerah Lingkup Provinsi</center></div>
                <div class=""><center>RENSTRA Perangkat Kabupaten/Kota {{$daerah}} Provinsi Sumatera Barat</center></div>
                <div class=""><center>Periode Pelaksanaan: {{$periode}}</center></div>
                <div class="container-fluid">Indikator dan Target Kinerja Perangkat Daerah Provinsi yang Mengacu pada Sasaran RKPD Provinsi:</div>
                <div class="container-fluid">{{$indikator}}</div>
                <p align='center'>
                <a href="" class="btn btn-danger btn-sm">Export To PDF</a>
                <a href="" class="btn btn-success btn-sm">Export To Excel</a>
                </p>
                <div class="card-body">
                <table class="table table-bordered table-hover table-stripped text-center" style="font-size:11px;" width="100%">
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>Sasaran</th>
                        <th rowspan=2>Program/Kegiatan</th>
                        <th rowspan=2>Indikator Kinerja</th>
                        <th rowspan=2>Data Capaian Pada Awal Tahun Perencanaan</th>
                        <th rowspan=2 colspan=2>Target Capaian pada Akhir Tahun Perencanaan</th>
                        <th colspan=10>Target Renstra Perangkat Daerah Tahun Ke-</th>
                        <th colspan=10>Realisasi Capaian Tahun Ke-</th>
                        <th colspan=10>Rasio Capaian pada Tahun Ke-</th>
                        <th rowspan=2>Unit Penanggung Jawab</th>
                    </tr>
                    <tr>
                        <th colspan=2>1</th>
                        <th colspan=2>2</th>
                        <th colspan=2>3</th>
                        <th colspan=2>4</th>
                        <th colspan=2>5</th>
                        <th colspan=2>1</th>
                        <th colspan=2>2</th>
                        <th colspan=2>3</th>
                        <th colspan=2>4</th>
                        <th colspan=2>5</th>
                        <th colspan=2>1</th>
                        <th colspan=2>2</th>
                        <th colspan=2>3</th>
                        <th colspan=2>4</th>
                        <th colspan=2>5</th>
                    </tr>
                    <tr>
                        <th rowspan=2>(1)</th>
                        <th rowspan=2>(2)</th>
                        <th rowspan=2>(3)</th>
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
                        <th colspan=2>(14)</th>
                        <th colspan=2>(15)</th>
                        <th colspan=2>(16)</th>
                        <th colspan=2>(17)</th>
                        <th colspan=2>(18)</th>
                        <th colspan=2>(19)</th>
                        <th colspan=2>(20)</th>
                        <th colspan=2>(21)</th>
                        <th rowspan=2>(22)</th>
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
                        <td colspan=27 class="text-right">Rata-Rata Capaian Kinerja (%)</td>
                        <td></td>
                        <td></td>
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
                        <td colspan=27 class="text-right">Predikat Kinerja</td>
                        <td></td>
                        <td></td>
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
                        <td colspan=41 class="text-left">Faktor Pendorong Pencapaian Kinerja:</td>
                    </tr>
                    <tr>
                        <td colspan=41 class="text-left">Faktor Penghambat:</td>
                    </tr>
                    </tr>
                        <td colspan=41 class="text-left">Usulan Tindak Lanjut pada Renja Perangkat Daerah Provinsi Berikutnya:</td>
                    <tr>
                    </tr>                    
                        <td colspan=41 class="text-left">Usulan Tindak Lanjut pada Renstra Perangkat Daerah Provinsi Berikutnya:</td>
                    </tr>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
