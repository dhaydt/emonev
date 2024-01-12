@extends('layouts.template')
@section('title', 'CRUD BLOG')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Persandingan APBD & RKPD</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Data Persandingan APBD & RKPD 2019<small></small></h3>
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
            <h4 class="panel-title">Data APBD yang tidak ada didalam RKPD Tahun 2019</h4>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped table-bordered">
            	<tr>
            		<th>No</th>
            		<th>IDAPBD</th>
            		<th>Idprgrm</th>
            		<th>Program</th>
            		<th>Kdkegunit</th>
            		<th>Kegiatan</th>
            		<th>Unitkey</th>
            		<th>Pagu</th>
            		<!-- <th>Id instansi</th> -->
            		<th>OPD</th>
            		<th>RKPD</th>
            	</tr>
            	@php $no=0; @endphp
            	@foreach($apbd as $key=>$va)
		            	@if($va->rkpd_kegiatan()=="" and $va->rkpd==0 and !preg_match("/(DAK)/", $va->nmkeg_) and !preg_match("/(DBH-DR)/", $va->nmkeg_) and !preg_match("/(DBHDR)/", $va->nmkeg_) and $va->idprgrm!=1 and $va->idprgrm!=2 and $va->idprgrm!=3 and $va->idprgrm!=4 and $va->idprgrm!=5 and $va->idprgrm!=6)
		            	
		            	@php 
		            	$no++; 
		            	if($va->rkpd==0){
						//	$bg="style=background-color:red;color:white;";
							$bg="";
						}else{
							$bg="";
						}
		            	@endphp
		            	<tr >
		            		<td {{$bg}}>{{$no}} {{$va->rkpd_kegiatan()}}</td>
		            		<td>{{$va->id}} </td>
		            		<td>{{$va->idprgrm}} </td>
		            		<td>
		            			<!-- {{$va->idprgrm_}} /  -->
		            			{{$va->nmprog_}}
		            		</td>
		            		<td>{{$va->kdkegunit}} </td>
		            		<td>
		            			<!-- {{$va->kdkegunit_}} /  -->
		            			{{$va->nmkeg_}}
		            		</td>
		            		<td>{{$va->unitkey}}</td>
		            		<td>{{number_format($va->pagu,0)}}</td>
		            		<!-- <td>{{$va->id_instansi}}</td> -->
		            		<!-- <td>{{$va->opd}} @if($va->data_opd!=""){{$va->data_opd->nm_instansi}}@endif</td> -->
		            		<td>{{$va->id_instansi}} - {{$va->opd}}</td>
		            		<td>
		            			<!-- {{$va->rkpd}} -->
		            			@php
		            			    if($va->rkpd==1){$sel="checked=checked";}else{$sel="";}
		            			@endphp
		            			@if(@Auth::user()->level=='Super Admin')
		            			<input type="checkbox" name='sdgscek' idi="{{$va->id}}" {{$sel}} class="sdgscek">
		            			@endif
		            		</td>
		            	</tr>
		            	

		            	@else
		            	
		            	@endif
            	@endforeach
            </table>
        </div>
    </div>
    </div>
</div>

<script type="text/javascript">
	$.ajaxSetup({
	    headers: {
	        // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	    $(".sdgscek").click(function() {
	        $('#wait').show();
	        
	        var id=$(this).attr('idi');
	        if ($(this).is(":checked")){
	            // it is checked
	            var vfield=1;
	        }else{
	            var vfield=0;
	        }
	        var url="{{ route('apbd.store') }}";
	        var formData = {
	            id: id,
	            vfield: vfield,
	        }
	        // alert(url);
	        console.log(formData);
	        $.ajax({
	            type    : "POST",
	            url     : url,
	            data    : formData,
	            dataType: 'json',
	            success : function (data) {
	                alert(data.msg);
	                console.log(data.store);
	                $('#wait').hide();
	            },
	            error: function (jqXHR, status, thrownError) {
	                alert('error');
	                console.log(thrownError);
	                        var responseText = jQuery.parseJSON(jqXHR.responseText);
	                        console.log(responseText);
	                        $('#wait').hide();
	            }
	        });
	        
	    });
</script>
@endsection