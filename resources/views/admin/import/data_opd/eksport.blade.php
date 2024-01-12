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

@if($table=="data_opd")
<table style="border: 1px solid #000;" border=1>
	<thead>
		<tr>
			<th>id</th>
			<th>unit_key</th>
			<th>kdunit</th>
			<th>kdlevel</th>
			<th>tipe</th>
			<th>nm_instansi</th>
			<th>nip</th>
			<th>kepala</th>
			<th>singkatan</th>
			<th>akrounit</th>
			<th>telp</th>
			<th>alamat</th>
			<th>pimpinan</th>
			<th>non_urusan(ada=1;tidak=0)</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		<tr>
			<th>{{$v->id}}</th>
			<th>{{$v->unit_key}}</th>
			<th>{{$v->kdunit}}</th>
			<th>{{$v->kdlevel}}</th>
			<th>{{$v->tipe}}</th>
			<th>{{$v->nm_instansi}}</th>
			<th>{{$v->nip}}</th>
			<th>{{$v->kepala}}</th>
			<th>{{$v->singkatan}}</th>
			<th>{{$v->akrounit}}</th>
			<th>{{$v->telp}}</th>
			<th>{{$v->alamat}}</th>
			<th>{{$v->pimpinan}}</th>
			<th>{{$v->non_urusan}}</th>
		</tr>
		@endforeach
	</tbody>
	@endif
</table>
@endif
</body>
</html>