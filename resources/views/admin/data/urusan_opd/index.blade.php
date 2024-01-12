@extends('layouts.template')

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Urusan OPD</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Urusan OPD<small></small></h3>
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
            <h4 class="panel-title">View Urusan OPD</h4>
        </div>
        <div class="panel-body">
            
        <link href="{{ asset('public/template/color_admin/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
                       

    @if ($message = Session::get('sukses'))
        <div id="notif" class="alert alert-success" style="padding:0px;">
            <p>{{$message}}</p>
        </div>
    @endif


            <div class="panel-group" id="accordion">
                @php $no=0; @endphp
                @foreach($data_opd as $v)
                @if($v->id!=85)
                @php $no++; @endphp
                <div class="panel panel-info overflow-hidden">
                    <div class="panel-heading" style="padding:3px;">
                        <h3 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$no}}">
                                <i class="fa fa-plus-circle pull-right"></i> 
                                #{{$no}} - {{$v->nm_instansi}}
                            </a>
                        </h3>
                    </div>
                    <div id="collapse{{$no}}" class="panel-collapse collapse bg-silver">
                        <div class="panel-body">
                            <table id="table-{{$no}}">
                            @if(!empty($v->urusan_opd))
                            @php $pecah=explode(",",$v->urusan_opd->arr_urusan); @endphp
                            
                            @php
                                print_r($pecah);
                            @endphp
                            
                            @foreach($pecah as $value)
                                <tr class='hps-{{$no}}-{{$value}}'>
                                    <td style="padding: 5px;">
                                        <li>
                                            @php 
                                                if($value!="80_"){
                                                    $du = $dafunit->where('unitkey','=',$value);
                                                    @endphp
                                                        @foreach($du as $vd)
                                                        {{$vd->nm_unit}}
                                                        @endforeach
                                                    @php
                                                }else{
                                                    $du = $dafunit->where('unitkey','=','212_')->first();
                                                    $sekda = $data_opd->where('unit_key','=',$value)->first();
                                                    @endphp
                                                        {{$du->nm_unit}} : {{$sekda->nm_instansi}}
                                                    @php
                                                }
                                            @endphp
                                        </li>
                                    </td>
                                    @if(Auth::user()->level=='Super Admin') 
                                    <td><a id_instansi='{{$v->id}}' unitkey='{{$value}}' no_br='{{$no}}' class="btn btn-danger btn-xs hps_urusan"><i class="fa fa-trash"></i></a></td>
                                    @endif
                                </tr>
                            @endforeach
                            @endif
                            </table>
                              <div class="form-inline">
                                  <div class="form-group">
                                    <select class="multiple-select2 form-control sel" id="sel-{{$v->id}}">
                                            <option value=''>Pilih Urusan </option>
                                            @foreach($bidangurusan as $bu)
                                            <option value="{{$bu->unitkey}}">{{$bu->nm_unit}} </option>
                                            @endforeach
                                    </select>
                                    @if(Auth::user()->level=='Super Admin') 
                                    <a class="btn btn-info btn-xs tambah-urusan" id_instansi='{{$v->id}}' no_br='{{$no}}'><i class="fa fa-plus"></i></a>
                                    @endif
                                  </div>
                              </div>

                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                
            </div>

            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
            <div class="loader"></div>
            <div clas="loader-txt">
              <img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}"><br><br><p>Loading...!</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id='result'></div>
    <script src="{{ asset('public/template/color_admin/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.sel').select2({dropdownAutoWidth : true});

            $(".tambah-urusan").on("click", function(e) {
                e.preventDefault();
                $("#loadMe").modal({
                  backdrop: "static", //remove ability to close modal with click
                  keyboard: false, //remove option to close with keyboard
                  show: true //Display loader!
                });
                //setTimeout(function() {
                  //$("#loadMe").modal("hide");
                //}, 3500);
              });
        });
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".tambah-urusan").click(function() {
            //alert('tes');
            var id_instansi=$(this).attr('id_instansi');
            var no_br=$(this).attr('no_br');
            var unitkey=$('#sel-'+id_instansi).val();
            
            var url_simpan = "{{ route('urusan-opd.store') }}";
            var formData = {
                id_instansi: id_instansi,
                unitkey: unitkey,
            }
            $.ajax({
                type    : "POST",
                url     : url_simpan,
                data    : formData,
                dataType: 'json',
                success : function (data) {
                    console.log(data);
                    console.log(data.store);
                    alert(data.msg);
                    $('#table-'+no_br).append("<tr class='hps-"+no_br+"-"+unitkey+"'><td style='padding: 5px;'><li>"+data.urusan+"</li></td><td><a id_instansi='"+id_instansi+"' unitkey='"+unitkey+"' no_br='"+no_br+"'class='btn btn-danger btn-xs hps_urusan'><i class='fa fa-trash'></i></a></td></tr>");
                    $("#loadMe").modal("hide");
                },
                error: function (jqXHR, status, thrownError) {
                    console.log(thrownError);
                    alert('error');
                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(responseText);
                            console.log(responseText.message);
                            $("#loadMe").modal("hide");
                }
            });
        });

        $(".hps_urusan").click(function(e) {
            var id_instansi=$(this).attr('id_instansi');
            var unitkey=$(this).attr('unitkey');
            var no_br=$(this).attr('no_br');
            // alert('tes hps-'+no_br+'-'+unitkey);
            $("#loadMe").modal({
              backdrop: "static", //remove ability to close modal with click
              keyboard: false, //remove option to close with keyboard
              show: true //Display loader!
            });
            var url_delete="{{ url('urusan-opd')}}/"+$(this).attr('id_instansi');
            var formData = {
                id_instansi: id_instansi,
                unitkey: unitkey,
                _method: "DELETE",
            }
            $.ajax({
                type    : "POST",
                url     : url_delete,
                data    : formData,
                dataType: 'json',
                success : function (data) {
                    console.log(data);
                    console.log(data.store);
                    alert(data.msg);
                    $("#loadMe").modal("hide");
                    $('.hps-'+no_br+'-'+unitkey).remove();
                },
                error: function (jqXHR, status, thrownError) {
                    console.log(thrownError);
                    alert('error');
                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(responseText);
                            console.log(responseText.message);
                            $("#loadMe").modal("hide");
                }
            });
            
        });
        
    </script>
@endsection