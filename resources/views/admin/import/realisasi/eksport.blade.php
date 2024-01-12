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
			<th>rpt1</th>
			<th>rpt2</th>
			<th>rpt3</th>
			<th>rpt4</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
			@if($v->periode_renja!="" and $v->id_instansi_renja!="" and $v->kdkegunit_renja!="")
			<tr>
				<th>{{$v->periode_renja}}</th>
				<th>{{$v->id_instansi_renja}}</th>
				<th>{{$v->kdkegunit_renja}}</th>
				<th>{{$v->rpt1}}</th>
				<th>{{$v->rpt2}}</th>
				<th>{{$v->rpt3}}</th>
				<th>{{$v->rpt4}}</th>
			</tr>
			@endif
		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>