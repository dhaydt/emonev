@extends('layouts.template')

@section('content')

@php
	$satuan='Keg';
@endphp
<div class="bs-example4" style="padding:15px;" data-example-id="contextual-table">            
   <ol class="breadcrumb">
        <li><i class="lnr lnr-home"></i> Home</li>
        <li>Evaluasi Renja</li>
        <li class="active">Input</li>

        <div class="pull-right"><b>Input Evaluasi Renja</b></div>
    </ol>
   						 @if ($message = Session::get('fail'))
							<div class="alert alert-danger" style="padding:0px;">
								<p>{{$message}}</p>
							</div>
						@endif

						<ul>
						@foreach($errors->all() as $error)
							<li class="alert alert-danger">{{$error}}</li>
						@endforeach
						</ul>
					<form method="POST" action="{{route('simpan-erenja')}}" >
						@csrf
					    <input type="hidden" name="periode" class="form-control" value='{{$periode}}'>
					    <input type="hidden" name="id_instansi" class="form-control" value='{{$id_instansi}}'>
					    <input type="hidden" name="idprgrm" class="form-control" value='{{$idprgrm}}'>
					    <input type="hidden" name="kdkegunit" class="form-control" value='{{$kdkegunit}}'>
					    <input type="hidden" name="idindikatorkeg" class="form-control" value='{{$idindikatorkeg}}'>
					  
					  <div class="form-group">
					    <label for="urusan"><b>Urusan</b></label>
					  	<div class="row">
					  		<div class="col-md-6">
							    <input type="text" class="form-control" name="urusan" placeholder="urusan" value="" readonly>			  
					  		</div>
							<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="urusan"><b>Program</b></label>
					  	<div class="row">
					  		<div class="col-md-9">
								<input type="text" class="form-control" name="program" placeholder="program"  value="" readonly>
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>
					  
					  <div class="form-group">
					    <label for="program"><b>Kegiatan</b></label>
					    <input type="text" class="form-control" name="kegiatan" placeholder="kegiatan" value="" readonly>
					  </div>
					  
					  <div class="form-group">
					    <label for="program"><b>Indikator</b></label>
					    <input type="text" class="form-control" name="indikator" placeholder="indikator" value="" readonly>
					  </div>

					  <div class="form-group">
					    <label for="urusan"><b>Target Renstra SKPD pada tahun 2016 s/d 2020 (periode Renstra SKPD)</b></label>
					  	<div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="trenstrak" id="trenstrak" value="5" placeholder="K" readonly>
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" name="trenstra" id="trenstra" value="252000000" placeholder="Rp" readonly>
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program"><b>Realisasi Capaian Kinerja Renstra SKPD s/d Renja SKPD Tahun Lalu ({{$periode-1}})</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="rrenstrak" id="rrenstrak" value="2" placeholder="K" readonly>
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" name="rrenstra" id="rrenstra" value="68661900" placeholder="Rp" readonly>
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program" class="font-weight-bold"><b>Target Kinerja dan Anggaran Renja SKPD Tahun Berjalan {{$periode}} yang dievaluasi</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="tkinerjak" id="tkinerjak" value="1" placeholder="K" readonly>
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" name="tkinerja" id="tkinerja" value=" 40000000" placeholder="Rp" readonly>
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					<fieldset>
					  <div class="form-group">
					    <label for="program"><b>Realisasi Kinerja Pada Triwulan I</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="t1k" id="t1k" value="" placeholder="K">
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" id="t1" value="" placeholder="Rp">
								<input type="hidden" class="form-control" name="t1" id="t11" value="" placeholder="Rp">
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program"><b>Realisasi Kinerja Pada Triwulan II</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="t2k" id="t2k" value="" placeholder="K">
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" id="t2" value="" placeholder="Rp">
								<input type="hidden" class="form-control" name="t2" id="t22" value="" placeholder="Rp">
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program"><b>Realisasi Kinerja Pada Triwulan III</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="t3k" id="t3k" value="" placeholder="K">
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" id="t3" value="" placeholder="Rp">
								<input type="hidden" class="form-control" name="t3" id="t33" value="" placeholder="Rp">
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program"><b>Realisasi Kinerja Pada Triwulan IV</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="t4k" id="t4k" value="" placeholder="K">
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" id="t4" value="" placeholder="Rp">
								<input type="hidden" class="form-control" name="t4" id="t44" value="" placeholder="Rp" >
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program"><b>Realisasi Capaian Kinerja dan Anggaran Renja SKPD yang dievaluasi</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="r1k" id="r1k" value="" placeholder="K" readonly>
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" id="r1" value="" placeholder="Rp" readonly="readonly">
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program"><b>Tingkat Capaian Kinerja dan Realisasi Anggaran Renja yang dievaluasi (%)</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="tck" id="tck" value="" placeholder="K" readonly>
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" id="tc1" value="" placeholder="Rp" readonly="readonly">
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program"><b>Realisasi Kinerja dan Anggaran Renstra SKPD s/d Akhir Tahun 2013</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="r2k" id="r2k" value="" placeholder="K" readonly>
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" id="r2" value="" placeholder="Rp" readonly="readonly">
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="program"><b>Tingkat Capaian Kinerja dan Realisasi Anggaran Renstra SKPD s/d Tahun 2013 (%)</b></label>
					    <div class="row">
					  		<div class="col-md-2">
								K
					  		</div>
					  		<div class="col-md-4">
								Rp
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-1">
								<input type="text" class="form-control" name="tc2k" id="tc2k" value="" placeholder="K" readonly>
					  		</div>
					  		<div class="col-md-1">
								<p>{{$satuan}}</p>
					  		</div>
					  		<div class="col-md-4">
								<input type="text" class="form-control" id="tc2" value="" placeholder="Rp" readonly="readonly">
					  		</div>
					  		<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="urusan"><b>SKPD Penanggung Jawab</b></label>
					  	<div class="row">
					  		<div class="col-md-6">
							    <input type="text" class="form-control" name="pjawab" placeholder="SKPD Penanggung Jawab" value="">
							    <!--{{ $errors->first('pjawab') }}-->
					  		</div>
							<div class="clearfix"> </div>
					  	</div>
					  </div>

					  <div class="form-group">
					    <label for="exampleFormControlTextarea1"><b>Keterangan</b></label>
					    <textarea class="form-control" name="ket" rows="3"></textarea>
					  </div>

					  <div class="form-group">
					    <input type="submit" class="btn-primary btn" value='Simpan'>
					  </div>
					</form>			
</div>

<script type="text/javascript">
	$(window).load(function(){
		$("#trenstra").number(true, 0);
		$("#rrenstra").number(true, 0);
		$("#tkinerja").number(true, 0);
		
		$("#t1").number(true, 0);
		$("#t2").number(true, 0);
		$("#t3").number(true, 0);
		$("#t4").number(true, 0);

		//set val
		$("#t1").val(0);
		$("#t2").val(0);
		$("#t3").val(0);
		$("#t4").val(0);

		$("#t1k").val(0);
		$("#t2k").val(0);
		$("#t3k").val(0);
		$("#t4k").val(0);
		
		$("#r1").number(true, 0);
		$("#tc1").number(true, 0);
		$("#r2").number(true, 0);
		$("#tc2").number(true, 0);
    });

	function hitung(){
		var t1k = parseInt($("#t1k").val());
		var t2k = parseInt($("#t2k").val());
		var t3k = parseInt($("#t3k").val());
		var t4k = parseInt($("#t4k").val());

		var t1 = parseInt($("#t1").val());
		var t2 = parseInt($("#t2").val());
		var t3 = parseInt($("#t3").val());
		var t4 = parseInt($("#t4").val());
		
		var v5k = parseInt($("#trenstrak").val());
		var v5 = parseInt($("#trenstra").val());
		var v6k = parseInt($("#rrenstrak").val());
		var v6 = parseInt($("#rrenstra").val());
		var v7k = parseInt($("#tkinerjak").val());
		var v7 = parseInt($("#tkinerja").val());
		var v12k = t1k+t2k+t3k+t4k;
		var v12 = t1+t2+t3+t4;

		$("#r1k").val(v12k);
		$("#r1").val(v12);

		$("#tck").val(v12k/v7k*100);
		$("#tc1").val(v12/v7*100);

		var v14k=v6k+v12k;
		var v14=v6+v12;

		$("#r2k").val(v14k);
		$("#r2").val(v14);	

		$("#tc2k").val(v14k/v5k*100);
		$("#tc2").val(v14/v5*100);
	}
	//triwulan 1
	$("#t1k").keyup(function() {
		hitung();
	});
	$("#t1").keyup(function() {
		$("#t11").val($("#t1").val());
		hitung();
	});
	
	//triwulan 2
	$("#t2k").keyup(function() {
		hitung();
	});
	$("#t2").keyup(function() {
		$("#t22").val($("#t2").val());
		hitung();
	});
	
	//triwulan3
	$("#t3k").keyup(function() {
		hitung();
	});
	$("#t3").keyup(function() {
		$("#t33").val($("#t3").val());
		hitung();
	});
	
	//triwulan4
	$("#t4k").keyup(function() {
		hitung();
	});
	$("#t4").keyup(function() {
		$("#t44").val($("#t4").val());
		hitung();
	});

</script>
@endsection
