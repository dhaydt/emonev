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
			<th>id_instansi</th>
			<th>indikator</th>
			<th>satuan</th>
			<th>target th 1</th>
			<th>target th 2</th>
			<th>target th 3</th>
			<th>target th 4</th>
			<th>target th 5</th>
			<th>target th 6</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		<tr>
			<th>{{$v->idprgrm}}</th>
			<th>{{$v->unitkey}}</th>
			<th>{{$v->id_instansi}}</th>
			<th>{{$v->indikator}}</th>
			<th>{{$v->satuan}}</th>
			<th>{{$v->t1}}</th>
			<th>{{$v->t2}}</th>
			<th>{{$v->t3}}</th>
			<th>{{$v->t4}}</th>
			<th>{{$v->t5}}</th>
			<th>{{$v->t6}}</th>
		</tr>
		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>