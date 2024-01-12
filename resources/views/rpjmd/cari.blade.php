@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                @foreach ($products as $product_item)
                    <!-- <td>{{ $product_item['id'] }}</td> -->
                @endforeach
                
                <table>
                @php
                for($a=0; $a < count($data); $a++)
                {
                    /**
                    print "<tr>";
                    // penomeran otomatis
                    print "<td>".$a."</td>";
                    // menayangkan 
                    print "<td>".$data[$a]['tahun']."</td>";
                    print "<td>".$data[$a]['jenis']."</td>";
                    print "<td>".$data[$a]['juara']."</td>";
                    print "<td>".$data[$a]['nama']."</td>";
                    print "<td>".$data[$a]['sekolah']."</td>";
                    print "<td>".$data[$a]['id']."</td>";
                    print "</tr>";
                    **/
                }
                @endphp
                </table>
                <div class="card-header">Evaluasi Terhadap Hasil RPJMD</div>
                <div class=""><center>Formulir E.17</center></div>
                <div class=""><center>Evaluasi Terhadap Hasil RPJMD</center></div>
                <div class=""><center>Provinsi Sumatera Barat</center></div>
                <div class=""><center>Periode Pelaksanaan: Tahun {{$tahun1}} - Tahun {{$tahun2}}</center></div>
                <p align='center'>
                <a href="" class="btn btn-danger btn-sm">Export To PDF</a>
                <a href="" class="btn btn-success btn-sm">Export To Excel</a>
                </p>
                <div class="card-body">
                <table class="table table-bordered table-hover table-stripped text-center" style="font-size:11px;" width="100%">
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>Sasaran</th>
                        <th rowspan=2>Program Prioritas</th>
                        <th rowspan=2>Indi-kator Kinerja</th>
                        <th rowspan=2>Data Capaian Pada Awal Tahun Perencanaan</th>
                        <th rowspan=2 colspan=2>Target Pada Akhir Tahun Perencanaan</th>
                        <th colspan=10>Target RPJMD Provinsi Pada RKPD Provinsi Tahun ke-</th>
                        <th colspan=10>Capaian Target RPJMD Provinsi Melalui Pelaksanaan RKPD Tahun ke-</th>
                        <th colspan=10>Tingkat Capaian Target RPJMD Provinsi Hasil Pelaksanaan RKPD Provinsi Tahun ke-<p>(%)</p></th>
                        <th colspan=2 rowspan=2>Capaian Pada Akhir Tahun Perencanaan</th>
                        <th colspan=2 rowspan=2>Rasio Capaian Akhir (%)</th>
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
                        <th colspan=2>(22)</th>
                        <th colspan=2>(23)</th>
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
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan=41 class="text-left">Faktor Pendorong Keberhasilan Pencapaian:</td>
                    </tr>
                    <tr>
                        <td colspan=41 class="text-left">Faktor Penghambat Pencapaian Kinerja:</td>
                    </tr>
                    </tr>
                        <td colspan=41 class="text-left">Tindak Lanjut yang diperlukan dalam RKPD Provinsi Berikutnya:</td>
                    <tr>
                    </tr>                    
                        <td colspan=41 class="text-left">Tindak Lanjut yang diperlukan dalam RPJMD Provinsi Berikutnya:</td>
                    </tr>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
