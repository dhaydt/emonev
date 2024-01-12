@extends('layouts.template')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Data RKPD {{$data_renja}}</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Data RKPD @if($periode!="") {{$periode}} {{$data_renja}} @endif<small></small></h3>
<!-- end page-header -->
<link href="{{ asset('public/template/color_admin/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<div class="row">
    <div class="col-md-12">
    
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title">List Data RKPD {{$data_renja}}</h4>
        </div>
        <div class="panel-body">

        
        <form class="form-inline" action="" method="get">
            <div class="form-group m-r-10">
                <div><b>[Periode RKPD]</b> : {{ $periode }} <span style="color:red;font-size: 20px"><b>{{$data_renja}}</b></span></div>
                <div><b>[OPD]</b> : {{ $data_opd->nm_instansi }}</div>
                <div><b>[PROGRAM]</b> : 
                    {{$data_program->nmprgrm}}
                </div>
            </div>
        </form>
        <p><a class="btn btn-danger btn-sm " href="./data-rkpd?periode={{$periode}}&data_renja={{$data_renja}}&act=rkpd_prog&opd={{$opd}}"><i class="fa fa-arrow-left"></i> Kembali</a> 
            @if(@Auth::user()->level=='Super Admin')
            | <a ref="#" class="btn btn-info btn-sm modal_1"><i class="fa fa-plus"></i> Tambah Kegiatan</a>
            @endif
        </p>
        @if($periode!="")
    

    @if ($message = Session::get('sukses'))
        <div id="notif" class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif
    @if ($message = Session::get('fail'))
        <div id="notif" class="alert alert-danger">
            <p>{{$message}}</p>
        </div>
    @endif
    
    <ul>
    @foreach($errors->all() as $error)
        <li class="alert alert-danger">{{$error}}</li>
    @endforeach
    </ul>

    <table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">
            Kode
        </th>
        <th rowspan="2">Kegiatan</th>
        <th @if($data_renja=="perubahan") colspan="2" @endif >Pagu</th>
        <th rowspan="2">Indikator</th>
        <th rowspan="2">Lihat Sub Kegiatan</th>
    </tr>
    <tr>
        <th>Awal</th>
        @if($data_renja=="perubahan") 
        <th>Perubahan</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @php $no=0; @endphp
    @foreach($rkpd_keg as $p)
    @php $no++; @endphp
    <tr>
        <td>{{$no}}</td>
        <td>{{$p->idkeg}}
            @if(@Auth::user()->level=='Super Admin')
            <div class="dropdown">
              <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-cog"></i>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @if(@Auth::user()->level=='Super Admin')
                <li><button id="{{$p->id}}" kd='{{$p->idkeg}}' keg_awal='{{$p->keg_awal}}' keg_perubahan='{{$p->keg_perubahan}}' class="modal_1_edit">Edit</button></li>
                @endif
                <form @if(@Auth::user()->level=='Super Admin') action="{{route('data-rkpd.destroy', $p->id)}}" @endif method="post" >
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="data_renja" value="{{$data_renja}}">
                    <input type="hidden" name="act" value="{{$act}}">
                    <input type="hidden" name="tabel" value="rkpd_keg">
                    <!-- <button class="" onclick="return confirm('yakin data ini dihapus?')">Hapus </button> -->

                    <li><button onclick="return confirm('Yakin data dihapus..?')">Hapus</button></li>
                </form>
              </ul>
            </div>
            @endif
        </td>
        <td>
            @php
            if($p->nmkeg!=""){
                $nomenklatur_keg=$p->nmkeg;
            }else{
                $nomenklatur_keg=@$p->master_kegiatan->nmkegunit;
            }
            @endphp
                {{@$nomenklatur_keg}}
        </td>
        <td align="right">{{number_format(@$p->pagu($opd,$periode)->jpagu_awal,0)}}</td>
        @if($data_renja=="perubahan") 
        <td align="right">{{number_format(@$p->pagu($opd,$periode)->jpagu_perubahan,0)}}</td>
        @endif
        <td>
            @if(@Auth::user()->level=='Super Admin')
            <a ref="#" class="btn btn-info btn-xs modal_indikator" idkeg='{{$p->idkeg}}' nmkegunit='{{$p->master_kegiatan->nmkegunit}}'><i class="fa fa-plus"></i> Tambah Indikator</a>
            @endif
            @foreach($rules as $r)
                @if($r->ind == 1)
                    @if($r->tambah == 1)
                        <a ref="#" class="btn btn-info btn-xs modal_indikator" idkeg='{{$p->idkeg}}' nmkegunit='{{$p->master_kegiatan->nmkegunit}}'><i class="fa fa-plus"></i> Tambah Indikator</a>
                    @endif
                @endif
            @endforeach
            <table class="table table-bordered">
                <tr>
                    <td>No</td>
                    <td>Indikator Awal</td>
                    <td>Raw Satuan Awal</td>
                    <td>Satuan Awal</td>
                    <td>Target Awal</td>
                    <td>Indikator Perubahan</td>
                    <td>Raw Satuan Perubahan</td>
                    <td>Satuan Perubahan</td>
                    <td>Target Perubahan</td>
                    <td>Aksi</td>
                </tr>
                @php $noin=0; @endphp
                @foreach($p->rkpd_keg($data_renja) as $in)
                @php $noin++; @endphp
                <tr>
                	<td>{{$noin}}</td>
                	<td>{{$in->indikator_awal}}</td>
                	<td>{{$in->raw_sat_awal}}</td>
                	<td>{{$in->sat_awal}}</td>
                	<td>{{$in->target_awal}}</td>
                	<td>{{$in->indikator_perubahan}}</td>
                	<td>{{$in->raw_sat_perubahan}}</td>
                	<td>{{$in->sat_perubahan}}</td>
                	<td>{{$in->target_perubahan}}</td>
                	<td>
                		<div class="dropdown">
                		  <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                		    <i class="fa fa-cog"></i>
                		    <span class="caret"></span>
                		  </button>
                		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                		    @if(@Auth::user()->level=='Super Admin')
                		    <li><button id="{{$in->id}}" kd='{{$p->idkeg}}' nmkegunit='{{$p->master_kegiatan->nmkegunit}}' keg_ind_awal='{{$in->keg_ind_awal}}' indikator_awal='{{$in->indikator_awal}}' raw_sat_awal='{{$in->raw_sat_awal}}' sat_awal='{{$in->sat_awal}}' target_awal='{{$in->target_awal}}' indikator_perubahan='{{$in->indikator_perubahan}}' raw_sat_perubahan='{{$in->raw_sat_perubahan}}' sat_perubahan='{{$in->sat_perubahan}}' target_perubahan='{{$in->target_perubahan}}' keg_ind_perubahan='{{$in->keg_ind_perubahan}}' class="modal_1_edit_indikator">Edit</button></li>
                            <form @if(@Auth::user()->level=='Super Admin') action="{{route('data-rkpd.destroy', $in->id)}}" @endif method="post" >
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="data_renja" value="{{$data_renja}}">
                                <input type="hidden" name="act" value="{{$act}}">
                                <input type="hidden" name="tabel" value="rkpd_keg_ind">
                                <!-- <button class="" onclick="return confirm('yakin data ini dihapus?')">Hapus </button> -->

                                <li><button onclick="return confirm('Yakin data dihapus..?')">Hapus</button></li>
                            </form>
                            @else
                                @foreach($rules as $r)
                                    @if($r->ind == 1)
                                        @if($r->edit == 1)
                                            <li><button id="{{$in->id}}" kd='{{$p->idkeg}}' nmkegunit='{{$p->master_kegiatan->nmkegunit}}' keg_ind_awal='{{$in->keg_ind_awal}}' indikator_awal='{{$in->indikator_awal}}' raw_sat_awal='{{$in->raw_sat_awal}}' sat_awal='{{$in->sat_awal}}' target_awal='{{$in->target_awal}}' indikator_perubahan='{{$in->indikator_perubahan}}' raw_sat_perubahan='{{$in->raw_sat_perubahan}}' sat_perubahan='{{$in->sat_perubahan}}' target_perubahan='{{$in->target_perubahan}}' keg_ind_perubahan='{{$in->keg_ind_perubahan}}' class="modal_1_edit_indikator">Edit</button></li>
                                        @endif
                                        @if($r->hapus == 1)
                                            <form action="{{route('data-rkpd.destroy', $in->id)}}" method="post" >
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="data_renja" value="{{$data_renja}}">
                                                <input type="hidden" name="act" value="{{$act}}">
                                                <input type="hidden" name="tabel" value="rkpd_prog_ind">
                                                <!-- <button class="" onclick="return confirm('yakin data ini dihapus?')">Hapus </button> -->

                                                <li><button onclick="return confirm('Yakin data dihapus..?')">Hapus</button></li>
                                            </form>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                		  </ul>
                		</div>
                	</td>
                </tr>
                @endforeach
            </table>
        </td>
        <td>
            <a href="{{url('./data-rkpd?periode='.$periode.'&data_renja='.$data_renja.'&act=rkpd_subkegiatan&opd='.$p->idopd.'&idkeg='.$p->idkeg)}}" class="btn btn-xs btn-info"> Lihat Sub Kegiatan <i class="fa fa-arrow-right"></i></a></td>
    </tr>
    @endforeach
    </tbody>
    </table>
    
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog" style="width: 70%;height: auto;margin: auto; margin-top: 5%">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Kegiatan</h4>
          </div>
          <div class="modal-body">
                <div><b>[Periode RKPD]</b> : {{ $periode }} <span style="color:red;font-size: 20px"><b>{{$data_renja}}</b></span></div>
                <div><b>[OPD]</b> : {{ $data_opd->nm_instansi }}</div>
                <div><b>[PROGRAM]</b> : {{ $data_program->nmprgrm }}</div>
                <hr/>
                <form class="form-horizontal" method="post" action="{{route('data-rkpd.store')}}">
                    @csrf
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Kegiatan:</label>
                    <div class="col-sm-8"> 
                        <select name="idkeg" class="form-control" id="sel">
                            <option value="">Pilih Kegiatan</option>
                            @foreach($kegiatan as $k)
                            <option value="{{$k->id}}">[{{$k->id}}] {{$k->nmkegunit}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2">Data RKPD:</label>
                    <div class="col-sm-5">
                      <input type="checkbox" name="keg_awal" value="1" @if($data_renja=="awal") selected @endif>
                      <label> RKPD Awal </label><br>
                      <input type="checkbox" name="keg_perubahan" value="1"  @if($data_renja=="perubahan") selected @endif>
                      <label> RKPD Perubahan </label><br>
                    </div>
                  </div>
                  <input type="hidden" name="periode" value="{{$periode}}">
                  <input type="hidden" name="data_renja" value="{{$data_renja}}">
                  <input type="hidden" name="act" value="{{$act}}">
                  <input type="hidden" name="opd" value="{{$opd}}">
                      <input type="hidden" name="idprog" value="{{$idprog}}">
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="tbl_prog" class="btn btn-primary tambah">Simpan</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </form>
          </div>
<!--           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> -->
        </div>

      </div>
    </div>

        <div id="myModal_indikator" class="modal fade" role="dialog">
          <div class="modal-dialog" style="width: 70%;height: auto;margin: auto;">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Indikator Kegiatan</h4>
              </div>
              <div class="modal-body">
                    <div><b>[Periode RKPD]</b> : {{ $periode }} <span style="color:red;font-size: 20px"><b>{{$data_renja}}</b></span></div>
                    <div><b>[OPD]</b> : {{ $data_opd->nm_instansi }}</div>
                    <div><b>[PROGRAM]</b> : <span class="program-title"></span></div>
                    <hr/>
                    <form class="form-horizontal" method="post" action="{{route('data-rkpd.store')}}">
                        @csrf
                      
                      <div class="form-group">
                        <label class="control-label col-sm-2">Data RKPD:</label>
                        <div class="col-sm-5">
                          <input type="checkbox" name="keg_ind_awal" value="1" @if($data_renja=="awal") checked @endif>
                          <label> RKPD Awal </label><br>
                          <input type="checkbox" name="keg_ind_perubahan" value="1" @if($data_renja=="perubahan") checked @endif>
                          <label> RKPD Perubahan </label><br>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2">Indikator Awal:</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" name="indikator_awal" placeholder="Indikator Awal"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2">Raw Satuan Awal:</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" name="raw_sat_awal" id="raw-ind-awal" placeholder="Raw satuan awal" readonly></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2">Target Awal:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="target-ind-awal" name="target_awal" placeholder="target awal">
                        </div>
                        <label class="control-label col-sm-2">Satuan Awal:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="sat-ind-awal" name="sat_awal" placeholder="satuan awal">
                        </div>
                        
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-2">Indikator Perubahan:</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" name="indikator_perubahan" placeholder="Indikator Perubahan"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2">Raw Satuan Perubahan:</label>
                        <div class="col-sm-5">
                            <textarea class="form-control" id="raw-ind-per" name="raw_sat_perubahan" placeholder="Raw satuan perubahan" readonly></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2">Target perubahan:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="target-ind-per" name="target_perubahan" placeholder="target perubahan">
                        </div>
                        <label class="control-label col-sm-2">Satuan perubahan:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="sat-ind-per" name="sat_perubahan" placeholder="satuan perubahan">
                        </div>
                      </div>

                      <input type="hidden" name="periode" value="{{$periode}}">
                      <input type="hidden" name="data_renja" value="{{$data_renja}}">
                      <input type="hidden" name="act" value="{{$act}}">
                      <input type="hidden" name="opd" value="{{$opd}}">
                      <input type="hidden" name="idprog" value="{{$idprog}}">
                      <input type="hidden" name="idkeg" id="idkeg">
                      <input type="hidden" name="id_indikator" id="id_indikator">
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="tbl_prog" value="Simpan Indikator" class="btn btn-primary tambah_ind">Simpan</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </form>
              </div>
    <!--           <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> -->
            </div>

          </div>
        </div>

    <script src="{{ asset('public/template/color_admin/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#sel').select2({ width: '100%' });
    </script>
    <script src="{{ asset('public/template/jquery.number.min.js') }}"></script>
    <script type="text/javascript">
        $('.modal_1').click(function(){
            $("#myModal").modal('show');
            $(".modal-title").text('Tambah Kegiatan');
            $(".tambah").text('Simpan');
            $(".tambah").val('Simpan_kegiatan');

            $("#sel").val('').trigger('change');
            $("#id").val('');

            @if($data_renja=="perubahan")
            $("input[name='keg_awal']").prop('checked', false);
            $("input[name='keg_perubahan']").prop('checked', true);
            @else
            $("input[name='keg_awal']").prop('checked', true);
            $("input[name='keg_perubahan']").prop('checked', false);
            @endif
        });
        $('.modal_1_edit').click(function(){
            $("#myModal").modal('show');
            $(".modal-title").text('Edit Kegiatan');
            $(".tambah").text('Edit');
            $(".tambah").val('Edit_kegiatan');
            $("#sel").val($(this).attr('kd')).trigger('change');
            $("#id").val($(this).attr('id'));

            if($(this).attr('keg_awal')=="1"){
                $("input[name='keg_awal']").prop('checked', true);
            }else{
                $("input[name='keg_awal']").prop('checked', false);
            }
            if($(this).attr('keg_perubahan')=="1"){
                $("input[name='keg_perubahan']").prop('checked', true);
            }else{
                $("input[name='keg_perubahan']").prop('checked', false);
            }
            // $("input[name='keg_perubahan']").prop('checked', true);
        });

        $('.angka').number(true,0);

        $('.modal_indikator').click(function(){
            $('#myModal_indikator').modal('show');
            $(".tambah_ind").text('Simpan Indikator');
            $(".tambah_ind").val('Simpan Indikator_kegiatan');
            $('.program-title').text($(this).attr('nmkegunit'));
            $(".modal-title").text('Tambah Indikator Kegiatan');
            $("#idkeg").val($(this).attr('idkeg'));

            $("textarea[name='indikator_awal']").val("");
            $("textarea[name='raw_sat_awal']").val("");
            $("input[name='sat_awal']").val("");
            $("input[name='target_awal']").val("");

            $("textarea[name='indikator_perubahan']").val("");
            $("textarea[name='raw_sat_perubahan']").val("");
            $("input[name='sat_perubahan']").val("");
            $("input[name='target_perubahan']").val("");

            @if($data_renja=="perubahan")
            $("input[name='keg_ind_awal']").prop('checked', false);
            $("input[name='keg_ind_perubahan']").prop('checked', true);
            @else
            $("input[name='keg_ind_awal']").prop('checked', true);
            $("input[name='keg_ind_perubahan']").prop('checked', false);
            @endif

        });

        $('.modal_1_edit_indikator').click(function(){
        	$('#myModal_indikator').modal('show');
        	$(".tambah_ind").text('Edit Indikator');
        	$(".tambah_ind").val('Edit Indikator_kegiatan');

        	$('.program-title').text($(this).attr('nmkegunit'));
        	$(".modal-title").text('Edit Indikator Kegiatan');
        	$("#idkeg").val($(this).attr('kd'));
        	$("#id_indikator").val($(this).attr('id'));
        	$("textarea[name='indikator_awal']").val($(this).attr('indikator_awal'));
        	$("textarea[name='raw_sat_awal']").val($(this).attr('raw_sat_awal'));
        	$("input[name='sat_awal']").val($(this).attr('sat_awal'));
        	$("input[name='target_awal']").val($(this).attr('target_awal'));

        	$("textarea[name='indikator_perubahan']").val($(this).attr('indikator_perubahan'));
        	$("textarea[name='raw_sat_perubahan']").val($(this).attr('raw_sat_perubahan'));
        	$("input[name='sat_perubahan']").val($(this).attr('sat_perubahan'));
        	$("input[name='target_perubahan']").val($(this).attr('target_perubahan'));
        	

        	if($(this).attr('keg_ind_awal')=="1"){
        	    $("input[name='keg_ind_awal']").prop('checked', true);
        	}else{
        	    $("input[name='keg_ind_awal']").prop('checked', false);
        	}
        	if($(this).attr('keg_ind_perubahan')=="1"){
        	    $("input[name='keg_ind_perubahan']").prop('checked', true);
        	}else{
        	    $("input[name='keg_ind_perubahan']").prop('checked', false);
        	}
        });

        $("#target-ind-awal").on("paste change", function(){
            var target = $(this).val();
            var satuan = $("#sat-ind-awal").val();
            var raw = $("#raw-ind-awal");
            var hasil = target+"?"+satuan;
            raw.val(hasil);
        });
        $("#sat-ind-awal").on("paste change", function(){
            var target = $("#target-ind-awal").val();
            var satuan = $(this).val();
            var raw = $("#raw-ind-awal");
            var hasil = target+"?"+satuan;
            raw.val(hasil);
        });
        $("#target-ind-per").on("paste change", function(){
            var target = $(this).val();
            var satuan = $("#sat-ind-per").val();
            var raw = $("#raw-ind-per");
            var hasil = target+"?"+satuan;
            raw.val(hasil);
        });
        $("#sat-ind-per").on("paste change", function(){
            var target = $("#target-ind-per").val();
            var satuan = $(this).val();
            var raw = $("#raw-ind-per");
            var hasil = target+"?"+satuan;
            raw.val(hasil);
        });
    </script>

        @endif

        </div>
    </div>
    </div>
</div>

<!--Modal-->
<style type="text/css">
    .modal-dialog {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .modal-content {
      height: auto;
      min-height: 100%;
      border-radius: 0;
    }
</style>

<script type="text/javascript">
    $('#wait_periode').hide();
    $("#periode").change(function() {
        $('#wait_periode').show();
    });
    $(document).ajaxStart(function(){
        $('#wait').show();
    });

</script>
@endsection