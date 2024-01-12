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

<table style="border: 1px solid #000;" border=1>
	<thead>
		<tr>
			<th>id_instansi</th>
			<th>unitkey (non urusan=0_)</th>
			<th>idprgrm</th>
			<th>kdkegunit</th>
			<th>nmkegunit</th>
			<th>id_prioritas (1-10)</th>
			<th>belanja_p_now</th>
			<th>belanja_bj_now</th>
			<th>belanja_m_now</th>
			<th>lokasi</th>
			<th>sasaran</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		<tr>
			<th>{{$v->id_instansi}}</th>
			<th>{{$v->urusan_key}}</th>
			<th>{{$v->idprgrm}}</th>
			<th>{{$v->kdkegunit}}</th>
			<th>{{$v->nmkegunit}}</th>
			<th>{{$v->id_prioritas}}</th>
			<th>{{$v->belanja_p_now}}</th>
			<th>{{$v->belanja_bj_now}}</th>
			<th>{{$v->belanja_m_now}}</th>
			<th>{{$v->lokasi}}</th>
			<th>{{$v->sasaran}}</th>
		</tr>
		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>