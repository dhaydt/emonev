@extends('layouts.template')
 
@section('title', 'CRUD BLOG')
@section('content')

<link href="{{ asset('public/template/color_admin/plugins/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
<script src="{{ asset('public/template/color_admin/plugins/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
<style type="text/css">
th,td { word-wrap: break-word; }
div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
}
.dataTables_filter{
    float: left;
}
</style>
@if (Auth::guard('web')->check())
<div class="panel panel-info overflow-hidden">
    <div class="panel-heading" style="padding:3px;">
        <h3 class="panel-title">
            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-tambah">
                <i class="fa fa-plus-circle pull-right"></i> 
                Tambah Kegiatan
            </a>
        </h3>
    </div>
    <div id="collapse-tambah" class="panel-collapse collapse bg-silver">
        <br>
        <div class="error"></div>
        <div class="form-horizontal"">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Periode:</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="periode" placeholder="Periode" value='{{$periode}}' disabled="disabled">
              <input type="hidden" class="form-control" id="id_instansi" placeholder="Id_instansi" value='{{$id_instansi}}' disabled="disabled">
              <input type="hidden" class="form-control" id="unitkey" placeholder="Unitkey" value='{{$unitkey}}' disabled="disabled">
              <input type="hidden" class="form-control" id="idprgrm" placeholder="idprgrm" value='{{$prog->idprgrm}}' disabled="disabled">
              <input type="hidden" class="form-control" id="data_renja" placeholder="data_renja" value='{{$data_renja}}' disabled="disabled">
            </div>
          </div>
          <link href="{{ asset('public/template/color_admin/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Nama Kegiatan:</label>
            <div class="col-sm-8"> 
                <select name="idkegunit" class="form-control" id="sel">
                    <option value="">Pilih Kegiatan</option>
                    @foreach($keg as $k)
                    <option value="{{$k->id}}">{{$k->id}} - {{$k->nmkegunit}}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Sasaran Pembangunan:</label>
            <div class="col-sm-8"> 
                <select name="sasaran_pembangunan" class="form-control sel2" id="sel2">
                    <option value="">Pilih Sasaran Pembangunan</option>
                    @foreach($sasaran_pembangunan as $sp)
                    <option value="{{$sp->id}}">{{$sp->id}} - {{$sp->sasaran}}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Sasaran:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="sasaran" placeholder="sasaran">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Prioritas:</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="id_prioritas" placeholder="prioritas">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Belanja P Now:</label>
            <div class="col-sm-3">
              <input type="text" class="form-control angka" id="bp" placeholder="Belanja P Now"  maxlength='18'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Belanja BJ Now:</label>
            <div class="col-sm-3">
              <input type="text" class="form-control angka" id="pagu" placeholder="Belanja BJ Now"  maxlength='18'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Belanja M Now:</label>
            <div class="col-sm-3">
              <input type="text" class="form-control angka" id="bm" placeholder="Belanja M Now"  maxlength='18'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Lokasi:</label>
            <div class="col-sm-8">
              <textarea class="form-control" id="lokasi" placeholder="Lokasi" ></textarea> 
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">RPJMD:</label>
            <div class="col-sm-8">
                <input type="radio" name="rpjmd" value='1' checked>Ada 
                <input type="radio" name="rpjmd" value='0'>Tidak
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">RKPD:</label>
            <div class="col-sm-8">
                <input type="radio" name="rkpd" value='1' checked>Ada 
                <input type="radio" name="rkpd" value='0'>Tidak
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">APBD:</label>
            <div class="col-sm-8">
                <input type="radio" name="apbd" value='1' checked>Ada 
                <input type="radio" name="apbd" value='0'>Tidak
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
              <input type="submit" @if(Auth::user()->level=='Super Admin') id="simpan_keg" @endif value="Simpan" class="btn btn-info btn-sm">
            </div>
          </div>
          <br>
        </div>
    </div>
</div>
@else
<div class="form-group">
            <label class="control-label col-sm-2" for="email">Periode:</label>
            <div class="col-sm-2">
              <input type="hidden" class="form-control" id="periode" placeholder="Periode" value='{{$periode}}' disabled="disabled">
              <input type="hidden" class="form-control" id="id_instansi" placeholder="Id_instansi" value='{{$id_instansi}}' disabled="disabled">
              <input type="hidden" class="form-control" id="unitkey" placeholder="Unitkey" value='{{$unitkey}}' disabled="disabled">
              <input type="hidden" class="form-control" id="idprgrm" placeholder="idprgrm" value='{{$prog->idprgrm}}' disabled="disabled">
            </div>
          </div>
@endif
<h4 align='center' style="margin-top: 0px;margin-bottom: 0px;">List Kegiatan - {{$opd->nm_instansi}} ({{$data_renja}})</h4>
<table class="table table-striped table-bordered table-hover" id="data-table">
    <thead>
    <tr>
        <th>No</th>
        @if (Auth::guard('web')->check())<th width="6%" align="center">Aksi</th>@endif
        <th width="30%">Nama Kegiatan</th>
        <th width="30%">Indikator</th>
        <!-- <th>Prioritas</th> -->
        <th>Pagu Indikatif</th>
        <!-- <th>Lokasi</th> -->
        <!-- <th>RPJMD</th> -->
        @if (Auth::guard('web')->check())
        <!-- <th>RKPD</th>
        <th>APBD</th>
        <th>Bappeda St</th> -->
        @endif
    </tr>
    </thead>
    <tbody >
    @php $no=0; @endphp
@foreach($renja as $vr)
    @php 
        $no++; 
        $dana=number_format($vr->belanja_p_now+$vr->belanja_bj_now+$vr->belanja_m_now,0);
        if($vr->rpjmd_st==1){$rpjmd="Ada";}else{$rpjmd="Tidak ada";}
        if($vr->rkpd_st==1){$rkpd="Ada";}else{$rkpd="Tidak ada";}
        if($vr->apbd_st==1){$apbd="Ada";}else{$apbd="Tidak ada";}

        $json_data=json_encode(array(
            'index'=>$no-1,
            'id_renja'=>$vr->id,
            'kdkegunit'=>$vr->kdkegunit,
            'id_prioritas'=>$vr->id_prioritas,
            'bp'=>$vr->belanja_p_now,
            'pagu_indikatif'=>$vr->belanja_bj_now,
            'bm'=>$vr->belanja_m_now,
            'lokasi'=>$vr->lokasi,
            'rpjmd_st'=>$vr->rpjmd_st,
            'rkpd_st'=>$vr->rkpd_st,
            'apbd_st'=>$vr->apbd_st,
            'bappeda'=>$vr->bappeda,
            'id_sasaran_prioritas'=>$vr->id_sasaran_prioritas,
            'sasaran'=>$vr->sasaran,
        ));
    @endphp
    <tr>
        <td>{{$no}}</td>
        @if (Auth::guard('web')->check())
        <td class="text-center">
            @if(Auth::user()->level=='Super Admin')
            <a ref="#" class="btn btn-xs btn-danger hapus" title='hapus kegiatan' value="{{$vr->id}}"><i class="fa fa-trash"></i></a>
            <a ref="#" class="btn btn-xs btn-warning edit" title='edit/show kegiatan' id="edit" value="{{$json_data}}" data-target="#edit-form-{{$no-1}}"><i class="fa fa-pencil"></i></a>
            @else
            <a ref="#" class="btn btn-xs btn-danger" title='hapus kegiatan' value="{{$vr->id}}"><i class="fa fa-trash"></i></a>
            <a ref="#" class="btn btn-xs btn-warning" title='edit/show kegiatan' id="edit" value="{{$json_data}}" data-target="#edit-form-{{$no-1}}"><i class="fa fa-pencil"></i></a>
            @endif
        </td>
        @endif
        <td>
            @if($vr!=null)
                {{$vr->nmkegunit}}
            @endif
            <div id="edit-form-{{$no-1}}" style="display: none;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
        </td>
        @php
        $jml_ind_keg = count($vr->indikator_kegiatan);
        if($jml_ind_keg<=0){$bg_ind="danger";$isi="kosong";}else{$bg_ind="";$isi=$vr->indikator_kegiatan;}
        @endphp
        <td class="{{$bg_ind}}">
            <table class="table table-bordered">
                <tr>
                    <td><textarea id="tind-{{$vr->id}}" cols='50%' class="form-control" placeholder="Tambah Indikator"></textarea></td>
                    <td>
                        <select id="pind-{{$vr->id}}">
                            <option value="0">Pilih</option>
                            @if (Auth::guard('web')->check())<option value="1">Sesuai RKPD</option>@endif
                            <option value="0">Tidak Sesuai RKPD</option>
                        </select>
                    </td>
                    <td>
                        @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check())
                        <a ref="#" class="btn btn-xs btn-primary tambah_ind" title="tambah indikator" value='{{$vr->id}}'><i class="fa fa-plus"></i></a>
                        @endif
                    </td>
                    <td></td>
                </tr>
            @foreach($vr->indikator_kegiatan as $vik)
                @if($vik->kdjkk=="02")
                    <tr>
                        <td><a href="" @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check()) class="update_ind" @endif data-name="tolokur" data-pk="{{$vik->id}}/{{$data_renja}}" data-placeholder="Edit Indikator" data-url="{{route('data-renja.update',$vik->id)}}" data-type="text">{{$vik->tolokur}}</a>
                        </td>
                        <td>
                            <a href="" @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check()) class="update_ind_st" @endif data-name="ind_st" data-pk="{{$vik->id}}/{{$data_renja}}" data-url="{{route('data-renja.update',$vik->id)}}" data-type="select" data-value="{{$vik->ind_st}}">
                            @if($vik->ind_st==1)
                                Sesuai RKPD
                            @else
                                Tidak Sesuai RKPD
                            @endif
                            </a>
                            <br>RAW output: {{$vik->sat}}
                        </td>
                        <td>
                        	@if (Auth::guard('web')->check())
                                @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check())
                        	<a ref="" class="btn btn-xs btn-danger hapus_ind" title="hapus indikator" value='{{$vik->id}}'><i class="fa fa-trash"></i></a>
                                @endif
                        	@elseif (Auth::guard('opd')->check() and $vik->ind_st==0)
                        	<a ref="" class="btn btn-xs btn-danger hapus_ind" title="hapus indikator" value='{{$vik->id}}'><i class="fa fa-trash"></i></a>
                        	@endif
                        </td>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <td><input type="text" id="tsatuan-{{$vik->id}}" placeholder="+ Satuan" size="8"></td>
                                    <td><input type="text" id="tk-{{$vik->id}}" class="angka2" maxlength="18" size="7" placeholder="+ K"></td>
                                    <td>
                                        @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check())
                                        <a ref="#" class="btn btn-xs btn-primary tambah_sat" value="{{$vik->id}}" title="tambah satuan dan target (K)"><i class="fa fa-plus"></i></a>
                                        @endif
                                    </td>
                                    <td><input type="hidden" id="sub_keg-{{$vik->id}}" placeholder="+ Sub Kegiatan" size="50"></td>
                                </tr>
                                @foreach($vik->det_indikator as $sat)
                                <tr>
                                    <td>
                                        <!-- {{$sat->target_sumber}} -->
                                        <a href="" @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check()) class="update_ind_det" @endif data-name="sat_det" data-pk="<?php echo $sat->id.',ind_det,'.$data_renja; ?>" data-placeholder="Edit Satuan" data-url="{{route('data-renja.update',$sat->id)}}" data-type="text">
                                            {{$sat->sat_det}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check()) class="update_ind_det" @endif data-name="target_det" data-pk="<?php echo $sat->id.',ind_det,'.$data_renja; ?>" data-placeholder="Edit Target (K)" data-url="{{route('data-renja.update',$sat->id)}}" data-type="text" data-inputclass="angka">
                                            @if($data_renja!="perubahan")
                                                {{$sat->target_det}}
                                            @else
                                                {{$sat->target_det_per}}
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check())
                                        <a ref="" class="btn btn-xs btn-danger hapus_ind_det" title="hapus satuan dan target (K)" value='{{$sat->id}}'><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="" @if(@Auth::user()->level=='Super Admin' or @Auth::guard('opd')->check()) class="update_ind_det" @endif data-name="sub_keg" data-pk="<?php echo $sat->id.',ind_det,'.$data_renja; ?>" data-placeholder="Edit Target (K)" data-url="{{route('data-renja.update',$sat->id)}}" data-type="text" data-inputclass="angka">
                                            @if($data_renja!="perubahan")
                                                {{$sat->sub_keg}}
                                            @else
                                                {{$sat->sub_keg_per}}
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endif
            @endforeach
            </table>
        </td>
        <!-- <td align="center">{{$vr->id_prioritas}}</td> -->
        <td class="text-right">{{$dana}}</td>
        <!-- <td>{{$vr->lokasi}}</td> -->
        <!-- <td>{{$rpjmd}}</td> -->
        @if (Auth::guard('web')->check())
        <!-- <td>{{$rkpd}}</td>
        <td>{{$apbd}}</td>
        <td>{{$vr->bappeda}}</td> -->
        @endif
    </tr>
@endforeach
    </tbody>
</table>

<script src="{{ asset('public/template/jquery.number.min.js') }}"></script>
<script src="{{ asset('public/template/color_admin/plugins/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
    
// $(document).ready(function(){  
    var periode=$("#periode").val();
    var id_instansi=$("#id_instansi").val();
    var unitkey=$("#unitkey").val();
    var idprgrm=$("#idprgrm").val();
    var data_renja=$("#data_renja").val();

    var layary= $(window).height();
    
    @if (Auth::guard('web')->check())
    var layar_k= 200;
    @else
    var layar_k= 150;
    @endif
    
    $('#wait').hide();
    $('.angka').number(true,0);
    $('.angka2').number(true,2);
    $(document).ready(function() {
         $('#sel').select2({ width: '100%' });
         var table = $('#data-table').DataTable( {
         scrollY:        layary-layar_k,
         scrollX:        true,
         scrollCollapse: true,
         info:false,
         ordering:false,
         paging:false,
         "dom": '<t>f',
         } );


    });

    $( "#simpan_keg" ).click(function(e) {
        var kdkegunit = $("#sel").val();
        var sasaran_pembangunan = $("#sel2").val();
        var id_prioritas = $("#id_prioritas").val();
        var pagu = $("#pagu").val();
        var lokasi = $("#lokasi").val();
        var rpjmd = $("input[name=rpjmd]:checked").val();
        var rkpd = $("input[name=rkpd]:checked").val();
        var apbd = $("input[name=apbd]:checked").val();
        var sasaran = $("#sasaran").val();

        $('#wait').show();

        var url = "{{url('modal-master-renja') }}/"+periode+'/'+data_renja+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_simpan = "{{ route('data-renja.store') }}";

        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        e.preventDefault();

        var formData = {
            periode: periode,
            id_instansi: id_instansi,
            idprgrm: idprgrm,
            unitkey: unitkey,
            kdkegunit: kdkegunit,
            id_prioritas: id_prioritas,
            bp: $("#bp").val(),
            pagu: pagu,
            bm: $("#bm").val(),
            lokasi: lokasi,
            rpjmd: rpjmd,
            rkpd: rkpd,
            apbd: apbd,
            data_renja: data_renja,
            sasaran_pembangunan: sasaran_pembangunan,
            sasaran: sasaran,
        }
        
        // console.log(formData);
        
        $.ajax({
            type    : "POST",
            url     : url_simpan,
            data    : formData,
            dataType: 'json',
            success : function (data) {
                // console.log(data);
                $('#modalMdContent').load(url);
                alert(data.msg);
            },
            error: function (jqXHR, status, thrownError) {
                // console.log('Error:', data);
                alert('error');
                        var responseText = jQuery.parseJSON(jqXHR.responseText);
                        console.log(responseText);
                        $('.error').text(responseText.message);
                        $('#wait').hide();
                // $('#modalMdContent').load(url);
            }
        });

        // console.log(url);
    });

    $(document).on('ajaxComplete ready', function () {
        $('.edit').off('click').on('click', function () {
            var json_data = $(this).attr('value');
            obj = JSON.parse(json_data);
            
            var form_edit="<table class='table'>";
            form_edit = form_edit+"<tr><td>Id Prioritas</td><td><input id='id_renja-"+obj.index+"' value='"+obj.id_renja+"' hidden><input id='id_prioritas-"+obj.index+"' value='"+obj.id_prioritas+"'></td></tr>";
            form_edit = form_edit+"<tr><td>ID Sasaran Pembangunan</td><td><input id='id_sasaran_prioritas-"+obj.index+"' value='"+obj.id_sasaran_prioritas+"'></td></tr>";
            form_edit = form_edit+"<tr><td>Sasaran</td><td><input id='sasaran-"+obj.index+"' value='"+obj.sasaran+"'></td></tr>";
            form_edit = form_edit+"<tr><td>Belanja P Now</td><td><input class='angka' id='bp-"+obj.index+"' value='"+obj.bp+"' maxlength='18'></td></tr>";

            form_edit = form_edit+"<tr><td>Belanja BJ Now</td><td><input class='angka' id='pagu_indikatif-"+obj.index+"' value='"+obj.pagu_indikatif+"' maxlength='18'></td></tr>";

            form_edit = form_edit+"<tr><td>Belanja M Now</td><td><input class='angka' id='bm-"+obj.index+"' value='"+obj.bm+"' maxlength='18'></td></tr>";

            form_edit = form_edit+"<tr><td>Lokasi</td><td><textarea id='lokasi-"+obj.index+"'>"+obj.lokasi+"</textarea></td></tr>";
            
            var sel_r1 ="";
            var sel_r2 ="";
            if(obj.rpjmd_st==1){sel_r1="checked";sel_r0="";}else{sel_r1="";sel_r0="checked";}
            form_edit = form_edit+"<tr><td>RPJMD</td><td><input type='radio' name='rpjmd-"+obj.index+"' value='1' "+sel_r1+">Ada <input type='radio' name='rpjmd-"+obj.index+"' value='0' "+sel_r0+">Tidak ada</td></tr>";

            sel_r1 ="";
            sel_r2 ="";
            if(obj.rkpd_st==1){sel_r1="checked";sel_r0="";}else{sel_r1="";sel_r0="checked";}
            form_edit = form_edit+"<tr><td>RKPD</td><td><input type='radio' name='rkpd-"+obj.index+"' value='1' "+sel_r1+">Ada <input type='radio' name='rkpd-"+obj.index+"' value='0' "+sel_r0+">Tidak ada</td></tr>";

            sel_r1 ="";
            sel_r2 ="";
            if(obj.apbd_st==1){sel_r1="checked";sel_r0="";}else{sel_r1="";sel_r0="checked";}
            form_edit = form_edit+"<tr><td>APBD</td><td><input type='radio' name='apbd-"+obj.index+"' value='1' "+sel_r1+">Ada <input type='radio' name='apbd-"+obj.index+"' value='0' "+sel_r0+">Tidak ada</td></tr>";
            form_edit = form_edit+"<tr><td>Bappeda St</td><td><input class='angka' id='bappeda-"+obj.index+"' value='"+obj.bappeda+"' maxlength='1'></td></tr>";
            form_edit = form_edit+"<tr><td></td><td><input type='submit' name='bedit-"+obj.index+"' value='Edit Kegiatan' class='btn btn-xs btn-warning' onclick='update_keg("+obj.index+")'></td></tr>";
            form_edit = form_edit+"</table>";
            $("#edit-form-"+obj.index).fadeToggle();
            $("#edit-form-"+obj.index).html(form_edit);

            $('.angka').number(true,0);
        });
        $('.hapus').off('click').on('click', function () {
            var r = confirm("Hapus data kegiatan (renja)?");
            if (r == false) {return false;}
            $('#wait').show();
            var url = "{{url('modal-master-renja') }}/"+periode+'/'+data_renja+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
            var url_delete="{{ url('data-renja')}}/"+$(this).attr('value');
            var data_delete = {
                _method: "DELETE",
                data_renja: data_renja,
            }
            $.ajaxSetup({
                headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type    : "POST",
                url     : url_delete,
                data    : data_delete,
                dataType: 'json',
                success : function (data) {
                    $('#modalMdContent').load(url);
                    alert(data.msg);
                },
                error: function (jqXHR, status, thrownError) {
                    alert('error');
                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(responseText);
                            $('.error').text(responseText.message);
                            $('#wait').hide();
                }
            });
        });

        $('.tambah_ind').off('click').on('click', function () {
            var id_renja = $(this).attr('value');
            var ind = $('#tind-'+id_renja).val();
            var pind = $('#pind-'+id_renja).val();
            $('#wait').show();
            var url = "{{url('modal-master-renja') }}/"+periode+'/'+data_renja+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
            var url_simpan = "{{ route('data-renja.store') }}";

            var formData = {
                id_renja: id_renja,
                periode: periode,
                ind: ind,
                pind: pind,
                data_renja: data_renja,
            }
            $.ajaxSetup({
                headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type    : "POST",
                url     : url_simpan,
                data    : formData,
                dataType: 'json',
                success : function (data) {
                    // console.log(data);
                    $('#modalMdContent').load(url);
                    alert(data.msg);
                },
                error: function (jqXHR, status, thrownError) {
                    alert('error');
                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(responseText);
                            $('.error').text(responseText.message);
                            $('#wait').hide();
                }
            });
        });
    });

    function update_keg(index){
        $('#wait').show();
        var url = "{{url('modal-master-renja') }}/"+periode+'/'+data_renja+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_edit="{{ url('data-renja')}}/"+$('#id_renja-'+index).val();

        // console.log(url_edit);
        var data_update = {
            _method: "PUT",
            id_renja: $('#id_renja-'+index).val(),
            id_prioritas: $('#id_prioritas-'+index).val(),
            id_sasaran_prioritas: $('#id_sasaran_prioritas-'+index).val(),
            sasaran: $('#sasaran-'+index).val(),
            bp: $('#bp-'+index).val(),
            pagu: $('#pagu_indikatif-'+index).val(),
            bm: $('#bm-'+index).val(),
            bappeda: $('#bappeda-'+index).val(),
            lokasi: $('#lokasi-'+index).val(),
            rpjmd: $('input[name=rpjmd-'+index+']:checked').val(),
            rkpd: $('input[name=rkpd-'+index+']:checked').val(),
            apbd: $('input[name=apbd-'+index+']:checked').val(),
            data_renja: data_renja,
        }
        // console.log(data_update);
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type    : "POST",
            url     : url_edit,
            data    : data_update,
            dataType: 'json',
            success : function (data) {
                $('#modalMdContent').load(url);
                alert(data.msg);
            },
            error: function (jqXHR, status, thrownError) {
                alert('error');
                        var responseText = jQuery.parseJSON(jqXHR.responseText);
                        console.log(responseText);
                        $('.error').text(responseText.message);
                        $('#wait').hide();
            }
        });

    }

    $.fn.editable.defaults.ajaxOptions = {type: "put"}

    $.ajaxSetup({
        headers: {
            // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // x-edittable
    $('.update_ind').editable({
               url: $(this).data('url'),
               pk: $(this).data('pk'),
               name: $(this).data('name'),
               success: function(response, newValue){
                $('#wait').hide();
                if(response.status=='error') return response.msg;
               }
    });

    $('.update_ind_st').editable({
               url: $(this).data('url'),
               pk: $(this).data('pk'),
               name: $(this).data('name'),
               source: [
                             {value: 1, text: 'Sesuai RKPD'},
                             {value: 0, text: 'Tidak Sesuai RKPD'}
                          ],
                sourceCache: true,
                display: function(value, sourceData) {
                   //display checklist as comma-separated values
                   var html = [],
                       checked = $.fn.editableutils.itemsByValue(value, sourceData);
                       
                   if(checked.length) {
                       $.each(checked, function(i, v) { html.push($.fn.editableutils.escape(v.text)); });
                       $(this).html(html.join(', '));
                   } else {
                       $(this).empty(); 
                   }
                },
               success: function(response, newValue){
                $('#wait').hide();
                if(response.status=='error') return response.msg;
               }
    });

    $('.hapus_ind').off('click').on('click', function () {
        var r = confirm("Hapus indikator?");
        if (r == false) {return false;}
        $('#wait').show();
        // alert($(this).attr('value'));
        var url = "{{url('modal-master-renja') }}/"+periode+'/'+data_renja+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_delete="{{ url('data-renja')}}/"+$(this).attr('value');
        var data_delete = {
            _method: "DELETE",
            tabel: "ind",
            data_renja: data_renja,
        }
        $.ajax({
            type    : "POST",
            url     : url_delete,
            data    : data_delete,
            dataType: 'json',
            success : function (data) {
                $('#modalMdContent').load(url);
                alert(data.msg);
            },
            error: function (jqXHR, status, thrownError) {
                alert('error');
                        var responseText = jQuery.parseJSON(jqXHR.responseText);
                        console.log(responseText);
                        $('.error').text(responseText.message);
                        $('#wait').hide();
            }
        });
    });

    $('.tambah_sat').off('click').on('click', function () {
        // alert($(this).attr('value'));
        var id_kegindikator = $(this).attr('value');
        var tsat = $('#tsatuan-'+id_kegindikator).val();
        var tk = $('#tk-'+id_kegindikator).val();
        var sub_keg = $('#sub_keg-'+id_kegindikator).val();
        $('#wait').show();
        var url = "{{url('modal-master-renja') }}/"+periode+'/'+data_renja+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_simpan = "{{ route('data-renja.store') }}";

        var formData = {
            periode: periode,
            id_instansi: id_instansi,
            id_kegindikator: id_kegindikator,
            tsat: tsat,
            tk: tk,
            sub_keg: sub_keg,
            data_renja: data_renja,
        }
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type    : "POST",
            url     : url_simpan,
            data    : formData,
            dataType: 'json',
            success : function (data) {
                // console.log(data);
                $('#modalMdContent').load(url);
                // console.log(data.store);
                alert(data.msg);
            },
            error: function (jqXHR, status, thrownError) {
                alert('error');
                        var responseText = jQuery.parseJSON(jqXHR.responseText);
                        console.log(responseText);
                        $('.error').text(responseText.message);
                        $('#wait').hide();
            }
        });
    });

    // x-edittable
    $('.update_ind_det').editable({
       url: $(this).data('url'),
       pk: $(this).data('pk'),
       name: $(this).data('name'),
       // tabel: "ind_det",
       success: function(response, newValue){
        $('#wait').hide();
        // console.log(response);
        // alert('data diubah');
        if(response.status=='error') return response.msg;
       }
    });

    $('.hapus_ind_det').off('click').on('click', function () {
        var r = confirm("Hapus data satuan dan target(K)?");
        if (r == false) {return false;}
        $('#wait').show();
        // alert($(this).attr('value'));
        var url = "{{url('modal-master-renja') }}/"+periode+'/'+data_renja+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_delete="{{ url('data-renja')}}/"+$(this).attr('value');
        var data_delete = {
            _method: "DELETE",
            tabel: "ind_det",
            data_renja: data_renja,
        }
        $.ajax({
            type    : "POST",
            url     : url_delete,
            data    : data_delete,
            dataType: 'json',
            success : function (data) {
                $('#modalMdContent').load(url);
                alert(data.msg);
            },
            error: function (jqXHR, status, thrownError) {
                alert('error');
                        var responseText = jQuery.parseJSON(jqXHR.responseText);
                        console.log(responseText);
                        $('.error').text(responseText.message);
                        $('#wait').hide();
            }
        });
    });
// });
</script>

@endsection