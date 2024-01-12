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
    <li>Settings Rule</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Settings Rules<small></small></h3>
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
			  <div class="row">
				<div class="col-sm-12">
					<div class="panel-group" id="accordion">
						@php $no=0; $tot_pagu=0; $tot_real=0; @endphp
						@foreach($opd as $o)
						@php $no++; $tot_opd_pagu=0; $tot_opd_real=0; @endphp
						<div class="panel panel-info overflow-hidden">
		                    <div class="panel-heading" style="padding:3px;">
		                        <h3 class="panel-title">
		                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$o->id}}">
		                                #{{$no}} - {{$o->nm_instansi}}

		                                <i class="fa fa-plus-circle pull-right"></i> 
		                            </a>
		                        </h3>
	                    	</div>
	                    	<div id="collapse{{$o->id}}" class="panel-collapse collapse bg-silver">
	                    		<h5 class="text text-inverse bg-success" style="margin:0px;">Mohon dipilih <b>Sudah Selesai</b> jika sudah selesai menginputkan Realisasi Triwulan Renja. <span><b>Pilihan sudah selesai akan aktif apabila keterisian data sudah mencapai <span style="color:red;">100%</span></b></span></h5>
	                    		<table class="table table-striped table-hover table-bordered p-3">
                                    <tr>
                                        <th>#</th>
                                        <th>Aktivitas</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Hapus</th>
									</tr>
									<tbody id="tbody">
										@php $no1=1; @endphp
										@foreach($rules as $ru)
											@if($o->id == $ru->idopd)
												<tr>
													<td>{{$no1++}}</td>
													<td>
														@if($ru->ind == 1)
															Indikator 
														@endif
														@if($ru->path == 'rkpd_prog')
															Program
														@elseif($ru->path == 'rkpd_kegiatan')
															Kegiatan
														@elseif($ru->path == 'rkpd_subkegiatan')
															Sub Kegiatan
														@endif
													</td>
													<td class="text-center"><input type="checkbox" name="edit" id="edit" href="{{$ru->id}}" @php if($ru->edit == 1) {echo "checked href1='0'";}else{echo "href1='1'";}  @endphp></td>
													<td class="text-center"><input type="checkbox" name="hapus" id="hapus" href="{{$ru->id}}" @php if($ru->hapus == 1) {echo "checked href1='0'";}else{echo "href1='1'";}  @endphp></td>
												</tr>
											@endif
										@endforeach
									</tbody>
								</table>
	                    	</div>
	                    </div>
	                    @endforeach
					</div>
				</div>
			  </div>
			  <p/>
			
			@if ($message = Session::get('sukses'))
				<div id="notif" class="alert alert-success">
					{{$message}}
				</div>
			@endif

			<script>
					$('#notif').slideDown('slow').delay(3000).slideUp('slow');

					$(document).ready(function(){
						$("#tbody #edit").click(function(){
							var id = $(this).attr("href");
							var isi = $(this).attr("href1");

							$.ajax({
								type: "get",
								url: "/2022/setedit?id="+id+"&isi="+isi,
								success: function(data){
									return;
								}
							});

							if(isi == 0){
								$(this).attr("href1", 1);
							}else{
								$(this).attr("href1", 0);
							}
						});


						$("#tbody #hapus").click(function(){
							var id = $(this).attr("href");
							var isi = $(this).attr("href1");

							$.ajax({
								type: "get",
								url: "/2022/sethapus?id="+id+"&isi="+isi,
								success: function(data){
									return;
								}
							});

							if(isi == 0){
								$(this).attr("href1", 1);
							}else{
								$(this).attr("href1", 0);
							}
						});
					});
			</script>

		</div>
</div>
</div>
</div>
@endsection