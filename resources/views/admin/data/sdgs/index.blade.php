<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>SIMONEV Dokumen Perencanaan Daerah)</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ asset('public/assets/img/logo.png') }}">

    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
    <link href="{{ asset('public/template/color_admin/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/template/color_admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/template/color_admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/template/color_admin/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/template/color_admin/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/template/color_admin/css/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/template/color_admin/css/theme/default.css') }}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('public/template/color_admin/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/template/color_admin/plugins/DataTables/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/template/color_admin/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('public/template/color_admin/plugins/pace/pace.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
    
    <script src="{{ asset('public/template/color_admin/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('public/template/color_admin/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
    <script src="{{ asset('public/template/color_admin/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
    
    <script src="{{ asset('public/template/color_admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!--<script>
    alert('Database sedang perbaikan, Belum bisa untuk menyimpan data, tetapi masih bisa untuk melihat data Renja, Data baru bisa di entry kan mulai tanggal 23 Mei 2019');
</script>-->
    
</head>
<body>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>SDGs</li>
    <li class="active">View</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Data SDGs<small></small></h3>
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
            <h4 class="panel-title">Pilih Urusan dan Program OPD</h4>
        </div>
        <div class="panel-body">
            <form class="form-inline" id='form_cari_periode' action="" method="get">
                <div class="form-group m-r-10">
                    Pilih Periode RKPD : <select name="periode" id="pilih_periode" class="form-control" onchange="cari_data()">
                        <option value="">Pilih Periode</option>
                        @php 
                        $thn=date('Y');
                        for($t=2019;$t<=$thn;$t++){
                            if($periode==$t){$sel="selected";}else{$sel="";}
                            echo"<option $sel>$t</option>";
                        }
                        @endphp
                    </select>
                    <script type="text/javascript">
                        function cari_data(){
                            var periode=$('#pilih_periode').val();
                            if(periode!=""){
                                // alert('submit');
                                $('#wait_periode').show();
                                $('#form_cari_periode').submit();
                            }
                        }
                    </script>
                    <div id="wait_periode" style='display:none;'><img src="{{ asset('public/template/color_admin/img/ajax-loader.gif') }}">
                        Loading...<!-- Loading -->
                    </div>
                </div>
            </form>
            <br/>
            
            @if($periode!="")
            @if ($message = Session::get('sukses'))
                <div id="notif" class="alert alert-success" style="padding:0px;">
                    <p>{{$message}}</p>
                </div>
            @endif


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
                                #{{$no}} - {{$v->opd->nm_instansi}}
                            </a>
                        </h3>
                    </div>
                    <div id="collapse{{$v->id}}" class="panel-collapse collapse bg-silver">
                        <div class="panel-body" style="padding:10px;">
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
                                            $rpjmd_prog_urusan = $rpjmd_prog->where('id_instansi','=',$v->opd->id)->where('id_status','=',1)->where('unitkey','=',$value);
                                            $no=0;
                                            @endphp
                                            <table class="table table-striped table-hover table-bordered">
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">SDGs</th>
                                                <th>Program</th>
                                            </tr>
                                            @foreach($rpjmd_prog_urusan as $vp)
                                            @php $no++; @endphp
                                            <tr>
                                                <td>{{$no}}</td>

                                                <td align="center">
                                                    @php
                                                    $sel="";
                                                    $data_sdgs=$sdgs->where('id_instansi','=',$v->opd->id)->where('idprgrm','=',$vp->idprgrm)->first();
                                                    if($data_sdgs!=""){
                                                        if($data_sdgs->sdgscek==1){$sel="checked=checked";}else{$sel="";}
                                                    }
                                                    @endphp
                                                    <input type="checkbox" name='sdgscek' idi="{{$v->id_instansi}}" idprgrm="{{$vp->idprgrm}}" {{$sel}} class="sdgscek">
                                                </td>
                                                <td style="font-size: 18px">
                                                Program {{$vp->nmprgrm}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            </table>
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
    <div class="modal fade" id="modalMd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <!--<div id="page-loader" class="fade"><span class="spinner"></span></div>-->
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header" style="padding:2px;background-color: #FF1B05;position: -webkit-sticky;position: sticky;top: 0;padding: 5px;z-index: 9999;">
                  <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; <b>Close</b></span></button>
                  
                  <h4 class="modal-title" id="modalMdTitle" style="color: #fff;"></h4>
              </div>
              <div class="modal-body" style="padding:5px;padding-top: 0px;padding-bottom: 0px;">
                    <style>
                      #wait {
                            /*cursor: pointer;*/
                            position: fixed;
                            top: 50%;
                              left: 50%;
                              /* bring your own prefixes */
                              transform: translate(-50%, -50%);
                            z-index: 9999;
                            background-color: #ffffff;
                            border: 1px solid black;
                            opacity: 0.6;
                            filter: alpha(opacity=60);
                            border-radius:10px;
                        }
                    </style>
                    <div id="wait" class="text-center"><img src="{{ asset('public/template/color_admin/img/loading/l2.gif') }}">
                        <!-- Loading -->
                    </div>
                  <div class="modalError"></div>
                  <div id="modalMdContent"></div>
              </div>
          </div>
      </div>
    </div>
    <script type="text/javascript">
        $(document).ajaxStart(function(){
            $('#wait').show();
        });
        $(document).on('ajaxComplete ready', function () {
            $('.modalMd').off('click').on('click', function () {
                $('#modalMdContent').load($(this).attr('value'), function( response, status, xhr ) {
                  if ( status == "error" ) {
                    var msg = "Sorry but there was an error: ";
                    $( "#modalError" ).html( msg + xhr.status + " " + xhr.statusText );
                  }
                });
                $('#modalMdTitle').html($(this).attr('title'));
            });
        });
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $(".sdgscek").click(function() {
                $('#wait').show();
                var nmfield=$(this).attr('name');
                
                var id_instansi=$(this).attr('idi');
                var idprgrm=$(this).attr('idprgrm');
                //var periode={{$periode}};
                
                if ($(this).is(":checked")){
                    // it is checked
                    var vfield=1;
                }else{
                    var vfield=0;
                }
                // alert(vfield);
                @php
                if($periode!=null){
                @endphp
                    var periode= {{$periode}};
                @php
                } 
                @endphp
                var url="{{ route('data-sdgs.store') }}";
                var formData = {
                    nmfield: nmfield,
                    vfield: vfield,
                    id_instansi: id_instansi,
                    idprgrm: idprgrm,
                    periode: periode,
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
</body>
</html>