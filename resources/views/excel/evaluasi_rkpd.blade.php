<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
		background-color:#000;
	}	
</style>


</head>
<body>
	@php
	if($jenis=="RKPD"){
		$nmj="RPJMD Provinsi";
		$jns="RKPD Provinsi";
	}
	@endphp
<table>
	<tr><th colspan='29'><b>FORMULIR E.19</b></th></tr>
	<tr><th colspan='29'><b>Evaluasi Terhadap Hasil RKPD</b></th></tr>
	<tr><th colspan='29'><b>Provinsi Sumatera Barat</b></th></tr>
	<tr><th colspan='29'><b>Periode Pelaksanaan : Triwulan {{$triwulan}} {{$periode}}</b></th></tr>	
</table>

<table>
	<tr><td></td></tr>
</table>

<table style="border: 1px solid #000;">
	<thead>
	<tr>
	    <th rowspan=2 align="center" style="vertical-align: top;" valign="top"><center>No</center></th>
	    <th rowspan=2 align="center" style="vertical-align: top;" valign="top"><center>Sasaran</center></th>
	    <th rowspan=2 align="center" style="vertical-align: top;" valign="top"><center>Kode</center></th>
	    <th rowspan=2 align="center" style="vertical-align: top;">Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Indikator Kinerja Program (<i>outcome</i>)/Kegiatan(<i>output</i>)</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Target {{$nmj}} pada Tahun 2016-2021 (akhir periode {{$nmj}})</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Realisasi Capaian Kinerja {{$nmj}} s/d {{$jns}} Tahun Lalu ({{$periode-1}})</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Target Kinerja dan Anggaran {{$jns}} Tahun Berjalan ({{$periode}}) yang dievaluasi</th>
	    <th colspan=8 align="center" style="vertical-align: top;">Realisasi Kinerja Pada Triwulan</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Realisasi Capaian Kinerja dan Anggaran {{$jns}} yang dievaluasi</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Tingkat Capaian Kinerja dan Realisasi Anggaran {{$jns}} Tahun {{$periode}} (%)</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Realisasi Kinerja Anggaran {{$nmj}} s/d Tahun {{$periode}}</th>
	    <th rowspan=2 colspan=2 align="center" style="vertical-align: top;">Tingkat Capaian Kinerja dan Realisasi Anggaran {{$nmj}} s/d Tahun {{$periode}} (%)</th>
	    <th rowspan=2 align="center" style="vertical-align: top;">Unit Perangkat Daerah Penanggung Jawab</th>
	</tr>
	<tr>
	    <th colspan=2 align="center" style="vertical-align: top;text-align:center;">I</th>
	    <th colspan=2 align="center" style="vertical-align: top;text-align:center;">II</th>
	    <th colspan=2 align="center" style="vertical-align: top;text-align:center;">III</th>
	    <th colspan=2 align="center" style="vertical-align: top;text-align:center;">IV</th>
	</tr>
	<tr>
	    <th rowspan=2 align="center">(1)</th>
	    <th rowspan=2 align="center">(2)</th>
	    <th rowspan=2 align="center">(3)</th>
	    <th rowspan=2 align="center">(4)</th>
	    <th rowspan=2 align="center">(5)</th>
	    <th rowspan=2></th>
	    <th colspan=2 align="center">(6)</th>
	    <th colspan=2 align="center">(7)</th>
	    <th colspan=2 align="center">(8)</th>
	    <th colspan=2 align="center">(9)</th>
	    <th colspan=2 align="center">(10)</th>
	    <th colspan=2 align="center">(11)</th>
	    <th colspan=2 align="center">(12)</th>
	    <th colspan=2 align="center">(13) = 9+10+11+12</th>
	    <th colspan=2 align="center">(14) = 13/8 * 100%</th>
	    <th colspan=2 align="center">(15) = 7+13</th>
	    <th colspan=2 align="center">(16) = 15/6 * 100%</th>
	    <th rowspan=2 align="center">(17)</th>
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
	</tr>
	</tbody>
</table>

</body>
</html>