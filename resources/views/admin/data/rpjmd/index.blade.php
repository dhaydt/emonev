@extends('layouts.template')
@section('title', 'CRUD BLOG')
@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>RPJMD</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Data :@if($id_periode_rpjmd!="") {{$cekrpjmd->judul}} - {{$th_awal}} s/d {{$th_akhir}} @endif<small></small></h3>
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
            <h4 class="panel-title">List Data RPJMD</h4>
        </div>
        <div class="panel-body">

    @if ($message = Session::get('sukses'))
        <div id="notif" class="alert alert-success" style="padding:0px;">
            <p>{{$message}}</p>
        </div>
    @endif

        <form class="form-inline" action="">
              <div class="form-group">
                  <label for="email">Periode RPJMD :</label>
                       <select name='id_periode_rpjmd' id='id_periode_rpjmd' class="form-control" onchange="submit()">
                            <option value=''>Pilih Periode RPJMD</option>
                            @foreach($prpjmd as $r)
                            <option value='{{$r->id}}' @if($r->id==$id_periode_rpjmd) selected @endif>{{$r->judul}} ({{$r->thn_awal}}-{{$r->thn_akhir}})</option>
                            @endforeach
                       </select>    
              </div>
          <div class="form-group">
            <label for="email">Tahun Awal:</label>
            <input type="text" class="form-control" name="th_awal" readonly value="{{$th_awal}}">
          </div>
          <div class="form-group">
            <label for="pwd">Tahun Akhir:</label>
            <input type="text" class="form-control" name="th_akhir" readonly value="{{$th_akhir}}">
          </div>
        </form><br>
        @if($id_periode_rpjmd!="")
            <div class="panel-group" id="accordion">
                @php $no=0; @endphp
                @foreach($opd as $v)
                @if($v->id!=1)
                @php $no++; @endphp
                <div class="panel panel-info overflow-hidden">
                    <div class="panel-heading" style="padding:3px;">
                        <h3 class="panel-title">
                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$v->id}}">
                                <i class="fa fa-plus-circle pull-right"></i> 
                                #{{$no}} - {{@$v->opd->nm_instansi}}
                            </a>
                        </h3>
                    </div>
                    <div id="collapse{{$v->id}}" class="panel-collapse collapse bg-silver">
                        <div class="panel-body" style="padding:10px;">
                            @if(@$v->opd->non_urusan==1)
                            
                            <div class="panel panel-warning overflow-hidden">
                                <div class="panel-heading" style="padding:3px;">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapsenon{{$no}}">
                                            <i class="fa fa-plus-circle pull-right"></i> 
                                            NON URUSAN
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapsenon{{$no}}" class="panel-collapse collapse bg-silver">
                                    <div class="panel-body bg-success">
                                        @php 
                                        $rpjmd_prog_non_urusan = $rpjmd_prog_non->where('id_instansi','=',$v->opd->id)->where('id_status','=',1);
                                        @endphp
                                        <table id='table-{{$v->id_instansi}}-0_'>
                                        @foreach($rpjmd_prog_non_urusan as $vpn)
                                        <tr class="hps-{{$v->id_instansi}}-0_-{{$vpn->idprgrm}}">
                                            <td style="padding: 3px;">
                                            <li>
                                                <a ref="#" value="{{ action('ModalController@show',['idprgrm'=>$vpn->idprgrm, 'id_instansi'=>$v->id_instansi, 'id_periode_rpjmd'=>$id_periode_rpjmd]) }}" class="btn btn-xs modalMd" title="Program : {{$vpn->nmprgrm}}" data-toggle="modal" data-target="#modalMd">{{$vpn->nmprgrm}}</a>
                                            </li>
                                            @if(Auth::user()->level=='Super Admin') 
                                            <td><a class="btn btn-danger btn-xs hps_prog" id_instansi='{{$v->id_instansi}}' unitkey='0_' idprgrm='{{$vpn->idprgrm}}'><i class="fa fa-trash"></i></a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        </table>
                                        <div class="form-inline">
                                            <div class="form-group">
                                              <select class="multiple-select2 form-control sel" id="sel-{{$v->id_instansi}}-0_">
                                                      <option value=''>Pilih Program</option>
                                                      @foreach($program_non_urusan as $po)
                                                      <option value="{{$po->id}}">{{$po->nmprgrm}}</option>
                                                      @endforeach
                                              </select>
                                            </div>
                                            <div class="form-group">
                                               <select class="form-control" id="pr-{{$v->id_instansi}}-0_">
                                                    <option value="PD">Prioritas Daerah</option>
                                                    <option value="PN">Prioritas Nasional</option>
                                               </select>
                                               @if(Auth::user()->level=='Super Admin') 
                                                <a class="btn btn-info btn-xs tmbh_prog" id_instansi='{{$v->id_instansi}}' unitkey='0_'><i class="fa fa-plus"></i></a>
                                                @endif
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @php 
                                $pecah=explode(",",$v->arr_urusan); 
                                $no2=0;
                            @endphp
                            @foreach($pecah as $value)
                            @php $no2++ @endphp
                                <div class="panel panel-warning overflow-hidden">
                                    <div class="panel-heading" style="padding:3px;">
                                        <h3 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{$v->id_instansi}}{{$value}}{{$no}}{{$no2}}">
                                                <i class="fa fa-plus-circle pull-right"></i> 
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

                                            </a>
                                        </h3>
                                    </div>
                                    
                                    <div id="collapse{{$v->id_instansi}}{{$value}}{{$no}}{{$no2}}" class="panel-collapse collapse bg-silver">
                                        <div class="panel-body bg-success">
                                            @php 
                                            $rpjmd_prog_urusan = $rpjmd_prog->where('id_instansi','=',@$v->opd->id)->where('id_status','=',1)->where('unitkey','=',$value);
                                            
                                            @endphp

                                            <table id='table-{{$v->id_instansi}}-{{$value}}'>
                                            @foreach($rpjmd_prog_urusan as $vp)
                                            <tr class="hps-{{$v->id_instansi}}-{{$value}}-{{$vp->idprgrm}}">
                                                <td style="padding: 3px;">
                                                <li>
                                                    <a href="#" value="{{ action('ModalController@show',['idprgrm'=>$vp->idprgrm, 'id_instansi'=>$v->id_instansi,'id_periode_rpjmd'=>$id_periode_rpjmd]) }}" class="btn btn-xs modalMd" title="Program : {{$vp->nmprgrm}}" data-toggle="modal" data-target="#modalMd">{{$vp->nmprgrm}}</a> 
                                                    <!--<a href="{{route('rpjmd.indikator_program',['idprgrm'=>$vp->id, 'id_instansi'=>$v->id_instansi])}}">
                                                        {{$vp->nmprgrm}}
                                                    </a>-->
                                                </li>
                                                @if(Auth::user()->level=='Super Admin') 
                                                <td><a class="btn btn-danger btn-xs hps_prog" id_instansi='{{$v->id_instansi}}' unitkey='{{$value}}' idprgrm='{{$vp->idprgrm}}'><i class="fa fa-trash"></i></a></td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </table>
                                        <div class="form-inline">
                                            <div class="form-group">
                                              <select class="multiple-select2 form-control sel" id="sel-{{$v->id_instansi}}-{{$value}}">
                                                      <option value=''>Pilih Program </option>
                                                      @foreach($program as $pr)
                                                      <option value="{{$pr->id}}">{{$pr->nmprgrm}}</option>
                                                      @endforeach
                                              </select>
                                            </div>
                                            <div class="form-group">
                                               <select class="form-control" id="pr-{{$v->id_instansi}}-{{$value}}">
                                                    <option value="PD">Prioritas Daerah</option>
                                                    <option value="PN">Prioritas Nasional</option>
                                               </select>
                                               @if(Auth::user()->level=='Super Admin') 
                                                <a class="btn btn-info btn-xs tmbh_prog" id_instansi='{{$v->id_instansi}}' unitkey='{{$value}}'><i class="fa fa-plus"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                
            </div>

            @endif
            
            </div>
        </div>
        </div>
    </div>


<!--Modal-->
    <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <!--<div id="page-loader" class="fade"><span class="spinner"></span></div>-->
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalMdTitle"></h4>
              </div>
              <div class="modal-body">
                    <div id="wait" class="text-center"><img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}"> Loading</div>
                  <div class="modalError"></div>
                  <div id="modalMdContent"></div>
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
    <script src="{{ asset('public/template/color_admin/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.sel').select2({dropdownAutoWidth : true});

            $(".tmbh_prog").on("click", function(e) {
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
        $('#wait').hide();

        $(document).ajaxStart(function(){
            $('#wait').show();
        });

        $(document).on('ajaxComplete ready', function () {
            $('.modalMd').off('click').on('click', function () {
                $('#modalMdContent').load($(this).attr('value'));
                
                $('#modalMdTitle').html($(this).attr('title'));

                // $('#wait').hide();
            });
        });
        
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".tmbh_prog").click(function() {
            var th_awal= @php echo $th_awal ? $th_awal : '0'; @endphp ;
            var th_akhir= @php echo $th_akhir ? $th_akhir : '0'; @endphp ;
            var id_periode_rpjmd= @php echo $id_periode_rpjmd ? $id_periode_rpjmd : '0'; @endphp ;

            var id_instansi=$(this).attr('id_instansi');
            var unitkey=$(this).attr('unitkey');
            var idprgrm=$('#sel-'+id_instansi+'-'+unitkey).val();
            var pr=$('#pr-'+id_instansi+'-'+unitkey).val();
            // alert('ets'+id_instansi+' '+unitkey+' '+idprgrm+' '+pr);
            var url_simpan = "{{ route('rpjmd.store') }}";
            var formData = {
                id_instansi: id_instansi,
                unitkey: unitkey,
                idprgrm: idprgrm,
                pr: pr,
                th_awal: th_awal,
                th_akhir: th_akhir,
                id_periode_rpjmd: id_periode_rpjmd,
                tabel:"rpjmd",
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
                    $('#table-'+id_instansi+'-'+unitkey).append("<tr class='hps-"+id_instansi+"-"+unitkey+"-"+idprgrm+"'><td style='padding: 5px;'><li><a ref='#' value='./modal/"+idprgrm+"/id_instansi/"+id_instansi+"' class='btn btn-xs modalMd' title='Program : "+data.nmprgrm+"' data-toggle='modal' data-target='#modalMd'>"+data.nmprgrm+"</a></li></td><td><a class='btn btn-danger btn-xs hps_prog' id_instansi='"+id_instansi+"' unitkey='"+unitkey+"' idprgrm='"+idprgrm+"' ><i class='fa fa-trash'></i></a></td></tr>");
                    $("#loadMe").modal("hide");
                },
                error: function (jqXHR, status, thrownError) {
                    console.log(thrownError);
                    console.log(jqXHR);
                    console.log(status);
                    alert('error 123');
                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(responseText);
                            console.log(responseText.message);
                            $("#loadMe").modal("hide");
                }
            });
        });

        $(".hps_prog").click(function(e) {
            var id_instansi=$(this).attr('id_instansi');
            var unitkey=$(this).attr('unitkey');
            var idprgrm=$(this).attr('idprgrm');
            // alert('tes hps-'+idprgrm+'-'+unitkey);
            $("#loadMe").modal({
              backdrop: "static", //remove ability to close modal with click
              keyboard: false, //remove option to close with keyboard
              show: true //Display loader!
            });
            var url_delete="{{ url('rpjmd')}}/"+$(this).attr('id_instansi');
            var formData = {
                id_instansi: id_instansi,
                unitkey: unitkey,
                idprgrm: idprgrm,
                _method: "DELETE",
                tabel:"rpjmd",
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
                    $('.hps-'+id_instansi+'-'+unitkey+'-'+idprgrm).remove();
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