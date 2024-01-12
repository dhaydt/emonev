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

@if($table=="dafunit")
<table style="border: 1px solid #000;" border=1>
	<thead>
		<tr>
			<th>id</th>
			<th>parent_id</th>
			<th>id_status</th>
			<th>order_no</th>
			<th>kdlevel</th>
			<th>unitkey</th>
			<th>kdunit</th>
			<th>nm_unit</th>
			<th>type</th>
		</tr>
	</thead>
	@if($jns=="true")
	<tbody>
		@foreach($data as $v)
		<tr>
			<th>{{$v->id}}</th>
			<th>{{$v->parent_id}}</th>
			<th>{{$v->id_status}}</th>
			<th>{{$v->order_no}}</th>
			<th>{{$v->kdlevel}}</th>
			<th>{{$v->unitkey}}</th>
			<th>{{$v->kdunit}}</th>
			<th>{{$v->nm_unit}}</th>
			<th>{{$v->type}}</th>
		</tr>
		@endforeach
	</tbody>
	@endif
</table>
@endif
</body>
</html>