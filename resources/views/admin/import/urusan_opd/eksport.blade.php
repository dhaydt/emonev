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
			<th>unitkey</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)

		@php
		$pecah=explode(",",$v->arr_urusan);
		@endphp
			@foreach($pecah as $value)
			<tr>
				<th>{{$v->id_instansi}}</th>
				<th>{{$value}}</th>
			</tr>
			@endforeach

		@endforeach
	</tbody>
	@endif
</table>
</body>
</html>