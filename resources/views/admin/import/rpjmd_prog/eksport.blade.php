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
			<th>idprgrm</th>
			<th>unitkey (non urusan=0_)</th>
			<th>nmprgrm</th>
			<th>id_instansi</th>
			<th>id_status(aktif=1;tidak=2)</th>
			<th>prioritas(PD;PN)</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		<tr>
			<th>{{$v->idprgrm}}</th>
			<th>{{$v->unitkey}}</th>
			<th>{{$v->nmprgrm}}</th>
			<th>{{$v->id_instansi}}</th>
			<th>{{$v->id_status}}</th>
			<th>{{$v->prioritas}}</th>
		</tr>
		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>