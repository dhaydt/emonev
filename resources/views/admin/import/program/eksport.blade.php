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
			<th>nmprgrm</th>
			<th>nomor</th>
			<th>id_status (aktif=1;tidak;2)</th>
			<th>non_urusan (ya=1;tidak=0)</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		<tr>
			<th>{{$v->id}}</th>
			<th>{{$v->nmprgrm}}</th>
			<th>{{$v->nomor}}</th>
			<th>{{$v->id_status}}</th>
			<th>{{$v->non_urusan}}</th>
		</tr>
		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>