@extends('layouts.template')

@section('content')

<style>
  #notif {
    cursor: pointer;
    position: fixed;
    right: 0px;
    z-index: 9999;
    bottom: 0px;
    margin-bottom: 22px;
    margin-right: 15px;
    min-width: 300px; 
    max-width: 800px;
}
</style>

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Settings Realisasi Triwulan</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Settings Realisasi Triwulan<small></small></h3>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12">
    
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title">Settings</h4>
        </div>
        <div class="panel-body">
			  <form action=''>
			  <div class="row">
				<div class="col-sm-2">
				  <select id='thn' name='thn' class='form-control' onchange='submit()'>
					<option value=''>Pilih Tahun</option>
					@foreach($periode as $p)
						<option value='{{$p->id}}' @if($thn==$p->id) selected @endif>{{$p->id}}</option>
					@endforeach
				  </select>
				</div>
			  </div>
			  </form>
			  <p/>
			  @if(!empty($thn))
			  <div class='row'>
				<div class='col-md-3'>
				  <form @if(Auth::user()->level=='Super Admin') action="{{route('settings_triwulan.update',$cek->id)}}" @endif method='post'>
						@csrf
						@method('PUT')
				  <table class='table table-bordered'>
					<thead>
					<tr>
						<th>Triwulan</th>
						<th>Status</th>
						<th>Data Renja</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td align='center'>I</td>
						<td>
							<input type='radio' name='tw1' value='0' @if($cek->tw1==0) checked @endif onclick='submit()'>Tidak Aktif &nbsp;
							<input type='radio' name='tw1' value='1' @if($cek->tw1==1) checked @endif onclick='submit()'>Aktif 
						</td>
						<td align='center'>
							<select name="tw1_src" class="form-control" onchange='submit()'>
								<option @if($cek->tw1_src=='awal') selected @endif>awal</option>
								<option @if($cek->tw1_src=='perubahan') selected @endif>perubahan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='center'>II</td>
						<td>
							<input type='radio' name='tw2' value='0' @if($cek->tw2==0) checked @endif onclick='submit()'>Tidak Aktif &nbsp;
							<input type='radio' name='tw2' value='1' @if($cek->tw2==1) checked @endif onclick='submit()'>Aktif 
						</td>
						<td align='center'>
							<select name="tw2_src" class="form-control" onchange='submit()'>
								<option @if($cek->tw2_src=='awal') selected @endif>awal</option>
								<option @if($cek->tw2_src=='perubahan') selected @endif>perubahan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='center'>III</td>
						<td>
							<input type='radio' name='tw3' value='0' @if($cek->tw3==0) checked @endif onclick='submit()'>Tidak Aktif &nbsp;
							<input type='radio' name='tw3' value='1' @if($cek->tw3==1) checked @endif onclick='submit()'>Aktif 
						</td>
						<td align='center'>
							<select name="tw3_src" class="form-control" onchange='submit()'>
								<option @if($cek->tw3_src=='awal') selected @endif>awal</option>
								<option @if($cek->tw3_src=='perubahan') selected @endif>perubahan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align='center'>IV</td>
						<td>
							<input type='radio' name='tw4' value='0' @if($cek->tw4==0) checked @endif onclick='submit()'>Tidak Aktif &nbsp;
							<input type='radio' name='tw4' value='1' @if($cek->tw4==1) checked @endif onclick='submit()'>Aktif 
						</td>
						<td align='center'>
							<select name="tw4_src" class="form-control" onchange='submit()'>
								<option @if($cek->tw4_src=='awal') selected @endif>awal</option>
								<option @if($cek->tw4_src=='perubahan') selected @endif>perubahan</option>
							</select>
						</td>
					</tr>
					</tbody>
				  </table>
				  </form>
				</div>
			  </div>
			  @endif
			
			@if ($message = Session::get('sukses'))
				<div id="notif" class="alert alert-success">
					{{$message}}
				</div>
			@endif

			<script>
					$('#notif').slideDown('slow').delay(3000).slideUp('slow');
			</script>

		</div>
</div>
</div>
</div>
@endsection