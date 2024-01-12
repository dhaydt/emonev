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
			<th>id</th>
			<th>idprgrm</th>
			<th>kdperspektif</th>
			<th>nmkegunit</th>
			<th>levelkeg</th>
			<th>type</th>
			<th>kode</th>
			<th>id_status (aktif=1;tidak=2)</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		<tr>
			<th>{{$v->id}}</th>
			<th>{{$v->idprgrm}}</th>
			<th>{{$v->kdperspektif}}</th>
			<th>{{$v->nmkegunit}}</th>
			<th>{{$v->levelkeg}}</th>
			<th>{{$v->type}}</th>
			<th>{{$v->kode}}</th>
			<th>{{$v->id_status}}</th>
		</tr>
		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>