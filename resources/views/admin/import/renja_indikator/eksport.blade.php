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
			<th>kdkegunit</th>
			<th>tolokur</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		@if($v->kdjkk=='02')
		<tr>
			<th>{{@$v->renja->id_instansi}}</th>
			<th>{{@$v->renja->kdkegunit}}</th>
			<th>{{$v->tolokur}}</th>
		</tr>
		@endif
		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>