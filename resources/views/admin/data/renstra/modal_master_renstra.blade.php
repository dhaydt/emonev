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

<div class="panel panel-info overflow-hidden">
    
    <div class="panel-heading" style="padding:3px;margin-top: 5px">
        <h3 class="panel-title">
            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion-modal" href="#collapse-tambah">
                <i class="fa fa-plus-circle pull-right"></i> 
                <i class="fa fa-pencil"></i> Tambah Kegiatan Renstra
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
            <label class="control-label col-sm-2" for="email">Prioritas:</label>
            <div class="col-sm-1">
              <!-- <input type="text" class="form-control" id="id_prioritas" placeholder="prioritas"> -->
              <select id="id_prioritas" name="id_prioritas" class="form-control">
                  <option value="">Pilih Prioritas</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Sasaran:</label>
            <div class="col-sm-3">
              <textarea class="form-control" id="sasaran" placeholder="Sasaran"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Data Capaian Pada Awal Thn. Perencanaan:</label>
            <div class="col-sm-3">
              <textarea class="form-control" id="data_awl" placeholder="Data Capaian Pada Awal Thn. Perencanaan"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Target Renstra Thn. Ke-1 (2016) (Rp):</label>
            <div class="col-sm-2">
              <input type="text" class="form-control angka" id="trp_1" placeholder="Target Renstra Thn. Ke-1 (Rp)"  maxlength='18'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Target Renstra Thn. Ke-2 (2017) (Rp):</label>
            <div class="col-sm-2">
              <input type="text" class="form-control angka" id="trp_2" placeholder="Target Renstra Thn. Ke-2 (Rp)"  maxlength='18'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Target Renstra Thn. Ke-3 (2018) (Rp):</label>
            <div class="col-sm-2">
              <input type="text" class="form-control angka" id="trp_3" placeholder="Target Renstra Thn. Ke-3 (Rp)"  maxlength='18'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Target Renstra Thn. Ke-4 (2019) (Rp):</label>
            <div class="col-sm-2">
              <input type="text" class="form-control angka" id="trp_4" placeholder="Target Renstra Thn. Ke-4 (Rp)"  maxlength='18'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Target Renstra Thn. Ke-5 (2020) (Rp):</label>
            <div class="col-sm-2">
              <input type="text" class="form-control angka" id="trp_5" placeholder="Target Renstra Thn. Ke-5 (Rp)"  maxlength='18'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Target Capaian pada Akhir Thn. Perencanaan (2021) (Rp):</label>
            <div class="col-sm-2">
              <input type="text" class="form-control angka" id="trp_6" placeholder="Target Capaian pada Akhir Thn. Perencanaan (Rp)"  maxlength='18'>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
              <input type="submit" id="simpan_keg" value="Simpan" class="btn btn-info btn-sm">
            </div>
          </div>
          <br>
        </div>
    </div>
</div>

<h4 align='center' style="margin-top: 0px;margin-bottom: 0px;">List Kegiatan Renstra - {{$opd->nm_instansi}}</h4>
<table class="table table-striped table-bordered table-hover" id="data-table">
    <thead>
    <tr>
        <th>No</th>
        @if (Auth::guard('web')->check())<th width="6%" align="center">Aksi</th>@endif
        <th width="30%">Nama Kegiatan</th>
        <th width="30%">Indikator</th>
        <!-- <th>Prioritas</th> -->
        <!-- <th>Lokasi</th> -->
        <!-- <th>RPJMD</th> -->
        <th>Data Capaian Awal</th>
        <th>Target (Rp) Th 1 (2016)</th>
        <th>Target (Rp) Th 2 (2017)</th>
        <th>Target (Rp) Th 3 (2018)</th>
        <th>Target (Rp) Th 4 (2019)</th>
        <th>Target (Rp) Th 5 (2020)</th>
        <th>Target (Rp) Th 6 (2021)</th>
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
            'data_awl'=>$vr->data_awl,
            'sasaran'=>$vr->sasaran,
            'trp_1'=>$vr->trp_1,
            'trp_2'=>$vr->trp_2,
            'trp_3'=>$vr->trp_3,
            'trp_4'=>$vr->trp_4,
            'trp_5'=>$vr->trp_5,
            'trp_6'=>$vr->trp_6,
        ));
    @endphp
    <tr>
        <td>{{$no}}</td>
        <td class="text-center">
            <a ref="#" class="btn btn-xs btn-danger hapus" title='hapus kegiatan' value="{{$vr->id}}"><i class="fa fa-trash"></i></a>
            <a ref="#" class="btn btn-xs btn-warning edit" title='edit/show kegiatan' id="edit" value="{{$json_data}}" data-target="#edit-form-{{$no-1}}"><i class="fa fa-pencil"></i></a>
        </td>
        <td>
            @if($vr->master_kegiatan!=null)
                {{$vr->master_kegiatan->nmkegunit}}
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
                    <td><a ref="#" class="btn btn-xs btn-primary tambah_ind" title="tambah indikator" value='{{$vr->id}}'><i class="fa fa-plus"></i></a></td>
                    <td></td>
                </tr>
            @foreach($vr->indikator_kegiatan as $vik)
                @if($vik->kdjkk=="02")
                    <tr>
                        <td><a href="" class="update_ind" data-name="tolokur" data-pk="{{$vik->id}}" data-placeholder="Edit Indikator" data-url="{{route('renstra.update',$vik->id)}}" data-type="text">{{$vik->tolokur}}</a>
                        </td>
                        <td>
                            <a ref="" class="btn btn-xs btn-danger hapus_ind" title="hapus indikator" value='{{$vik->id}}'><i class="fa fa-trash"></i></a>
                            
                        </td>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Satuan</td>
                                    <td>K (th 1) 2016</td>
                                    <td>K (th 2) 2017</td>
                                    <td>K (th 3) 2018</td>
                                    <td>K (th 4) 2019</td>
                                    <td>K (th 5) 2020</td>
                                    <td>K (th 6) 2021</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="tsatuan-{{$vik->id}}" placeholder="+ Satuan" size="8"></td>
                                    <td><input type="text" id="tk-{{$vik->id}}" class="angka2" maxlength="18" size="7" placeholder="+ K"></td>
                                    <td><input type="text" id="tk2-{{$vik->id}}" class="angka2" maxlength="18" size="7" placeholder="+ K"></td>
                                    <td><input type="text" id="tk3-{{$vik->id}}" class="angka2" maxlength="18" size="7" placeholder="+ K"></td>
                                    <td><input type="text" id="tk4-{{$vik->id}}" class="angka2" maxlength="18" size="7" placeholder="+ K"></td>
                                    <td><input type="text" id="tk5-{{$vik->id}}" class="angka2" maxlength="18" size="7" placeholder="+ K"></td>
                                    <td><input type="text" id="tk6-{{$vik->id}}" class="angka2" maxlength="18" size="7" placeholder="+ K"></td>
                                    <td><a ref="#" class="btn btn-xs btn-primary tambah_sat" value="{{$vik->id}}" title="tambah satuan dan target (K)"><i class="fa fa-plus"></i></a></td>
                                </tr>
                                @foreach($vik->det_indikator as $sat)
                                <tr>
                                    <td>
                                        <!-- {{$sat->target_sumber}} -->
                                        <a href="" class="update_ind_det" data-name="sat_det" data-pk="<?php echo $sat->id.',ind_det'; ?>" data-placeholder="Edit Satuan" data-url="{{route('renstra.update',$sat->id)}}" data-type="text">
                                            {{$sat->sat_det}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" class="update_ind_det" data-name="target_det" data-pk="<?php echo $sat->id.',ind_det'; ?>" data-placeholder="Edit Target (K)" data-url="{{route('renstra.update',$sat->id)}}" data-type="text" data-inputclass="angka">
                                            {{$sat->target_det}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" class="update_ind_det" data-name="target2_det" data-pk="<?php echo $sat->id.',ind_det'; ?>" data-placeholder="Edit Target (K)" data-url="{{route('renstra.update',$sat->id)}}" data-type="text" data-inputclass="angka">
                                            {{$sat->target2_det}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" class="update_ind_det" data-name="target3_det" data-pk="<?php echo $sat->id.',ind_det'; ?>" data-placeholder="Edit Target (K)" data-url="{{route('renstra.update',$sat->id)}}" data-type="text" data-inputclass="angka">
                                            {{$sat->target3_det}}
                                        </a>
                                    </td>
                                    <td>    
                                        <a href="" class="update_ind_det" data-name="target4_det" data-pk="<?php echo $sat->id.',ind_det'; ?>" data-placeholder="Edit Target (K)" data-url="{{route('renstra.update',$sat->id)}}" data-type="text" data-inputclass="angka">
                                            {{$sat->target4_det}}
                                        </a>
                                    </td>
                                    <td>    
                                        <a href="" class="update_ind_det" data-name="target5_det" data-pk="<?php echo $sat->id.',ind_det'; ?>" data-placeholder="Edit Target (K)" data-url="{{route('renstra.update',$sat->id)}}" data-type="text" data-inputclass="angka">
                                            {{$sat->target5_det}}
                                        </a>
                                    </td>
                                    <td>    
                                        <a href="" class="update_ind_det" data-name="target6_det" data-pk="<?php echo $sat->id.',ind_det'; ?>" data-placeholder="Edit Target (K)" data-url="{{route('renstra.update',$sat->id)}}" data-type="text" data-inputclass="angka">
                                            {{$sat->target6_det}}
                                        </a>
                                    </td>
                                    <td>
                                        <a ref="" class="btn btn-xs btn-danger hapus_ind_det" title="hapus satuan dan target (K)" value='{{$sat->id}}'><i class="fa fa-trash"></i></a>
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
        
        <td>{{$vr->data_awl}}</td>
        <td>{{number_format($vr->trp_1,0)}}</td>
        <td>{{number_format($vr->trp_2,0)}}</td>
        <td>{{number_format($vr->trp_3,0)}}</td>
        <td>{{number_format($vr->trp_4,0)}}</td>
        <td>{{number_format($vr->trp_5,0)}}</td>
        <td>{{number_format($vr->trp_6,0)}}</td>
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
         $('#sel').select2({ dropdownParent: $("#modalMd"),width: '100%' });
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
        var sasaran = $("#sasaran").val();
        var id_prioritas = $("#id_prioritas").val();
        var data_awl = $("#data_awl").val();
        var trp_1 = $("#trp_1").val();
        var trp_2 = $("#trp_2").val();
        var trp_3 = $("#trp_3").val();
        var trp_4 = $("#trp_4").val();
        var trp_5 = $("#trp_5").val();
        var trp_6 = $("#trp_6").val();

        $('#wait').show();

        var url = "{{url('modal-master-renstra') }}/"+periode+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_simpan = "{{ route('renstra.store') }}";

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
            sasaran: sasaran,
            data_awl: data_awl,
            trp_1: trp_1,
            trp_2: trp_2,
            trp_3: trp_3,
            trp_4: trp_4,
            trp_5: trp_5,
            trp_6: trp_6,
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

            form_edit = form_edit+"<tr><td>Data Capaian Awal</td><td><textarea id='data_awl-"+obj.index+"'>"+obj.data_awl+"</textarea></td></tr>";

            form_edit = form_edit+"<tr><td>Sasaran</td><td><textarea id='sasaran-"+obj.index+"'>"+obj.sasaran+"</textarea></td></tr>";

            form_edit = form_edit+"<tr><td>Target Th 1 (2016)</td><td><input class='angka' id='trp_1-"+obj.index+"' value='"+obj.trp_1+"' maxlength='18'></td></tr>";

            form_edit = form_edit+"<tr><td>Target Th 2 (2017)</td><td><input class='angka' id='trp_2-"+obj.index+"' value='"+obj.trp_2+"' maxlength='18'></td></tr>";

            form_edit = form_edit+"<tr><td>Target Th 3 (2018)</td><td><input class='angka' id='trp_3-"+obj.index+"' value='"+obj.trp_3+"' maxlength='18'></td></tr>";

            form_edit = form_edit+"<tr><td>Target Th 4 (2019)</td><td><input class='angka' id='trp_4-"+obj.index+"' value='"+obj.trp_4+"' maxlength='18'></td></tr>";

            form_edit = form_edit+"<tr><td>Target Th 5 (2020)</td><td><input class='angka' id='trp_5-"+obj.index+"' value='"+obj.trp_5+"' maxlength='18'></td></tr>";

            form_edit = form_edit+"<tr><td>Target Th 6 (2021)</td><td><input class='angka' id='trp_6-"+obj.index+"' value='"+obj.trp_6+"' maxlength='18'></td></tr>";

            
            form_edit = form_edit+"<tr><td></td><td><input type='submit' name='bedit-"+obj.index+"' value='Edit Kegiatan' class='btn btn-xs btn-warning' onclick='update_keg("+obj.index+")'></td></tr>";
            form_edit = form_edit+"</table>";
            $("#edit-form-"+obj.index).fadeToggle();
            $("#edit-form-"+obj.index).html(form_edit);

            $('.angka').number(true,0);
        });
        $('.hapus').off('click').on('click', function () {
            var r = confirm("Hapus data kegiatan (renstra)?");
            if (r == false) {return false;}
            $('#wait').show();
            var url = "{{url('modal-master-renstra') }}/"+periode+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
            var url_delete="{{ url('renstra')}}/"+$(this).attr('value');
            var data_delete = {
                _method: "DELETE",
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
            var url = "{{url('modal-master-renstra') }}/"+periode+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
            var url_simpan = "{{ route('renstra.store') }}";

            var formData = {
                id_renja: id_renja,
                ind: ind,
                pind: pind,
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
        var url = "{{url('modal-master-renstra') }}/"+periode+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_edit="{{ url('renstra')}}/"+$('#id_renja-'+index).val();

        // console.log(url_edit);
        var data_update = {
            _method: "PUT",
            id_renja: $('#id_renja-'+index).val(),
            id_prioritas: $('#id_prioritas-'+index).val(),
            data_awl: $('#data_awl-'+index).val(),
            sasaran: $('#sasaran-'+index).val(),
            trp_1: $('#trp_1-'+index).val(),
            trp_2: $('#trp_2-'+index).val(),
            trp_3: $('#trp_3-'+index).val(),
            trp_4: $('#trp_4-'+index).val(),
            trp_5: $('#trp_5-'+index).val(),
            trp_6: $('#trp_6-'+index).val(),
        }
        console.log(data_update);
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
        var url = "{{url('modal-master-renstra') }}/"+periode+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_delete="{{ url('renstra')}}/"+$(this).attr('value');
        var data_delete = {
            _method: "DELETE",
            tabel: "ind",
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
        var tk2 = $('#tk2-'+id_kegindikator).val();
        var tk3 = $('#tk3-'+id_kegindikator).val();
        var tk4 = $('#tk4-'+id_kegindikator).val();
        var tk5 = $('#tk5-'+id_kegindikator).val();
        var tk6 = $('#tk6-'+id_kegindikator).val();
        $('#wait').show();
        var url = "{{url('modal-master-renstra') }}/"+periode+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_simpan = "{{ route('renstra.store') }}";

        var formData = {
            id_kegindikator: id_kegindikator,
            tsat: tsat,
            tk: tk,
            tk2: tk2,
            tk3: tk3,
            tk4: tk4,
            tk5: tk5,
            tk6: tk6,
        }
        
        // console.log(formData);
        
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
        var url = "{{url('modal-master-renstra') }}/"+periode+'/'+idprgrm+'/id_instansi/'+id_instansi+'/'+unitkey;
        var url_delete="{{ url('renstra')}}/"+$(this).attr('value');
        var data_delete = {
            _method: "DELETE",
            tabel: "ind_det",
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