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
			<th>periode</th>
			<th>id_instansi</th>
			<th>kdkegunit</th>
			<th>satuan</th>
			<th>target</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		<tr>
			<th>{{$v->periode}}</th>
			<th>{{$v->id_instansi}}</th>
			<th>{{$v->kdkegunit}}</th>
			<th>{{$v->sat_det}}</th>
			<th>{{$v->target_det}}</th>
		</tr>
		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>