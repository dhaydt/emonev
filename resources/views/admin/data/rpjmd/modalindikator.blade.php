@extends('layouts.template')
 
@section('title', 'CRUD BLOG')
@section('content')

<link href="{{ asset('public/template/color_admin/plugins/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
<script src="{{ asset('public/template/color_admin/plugins/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>

<div class="row">
 <div class="col-lg-12">
    <p><b>OPD : {{$prog->opd_program()}}</b></p>
    <p><b>Urusan : {{$prog->urusan_program()}}</b></p>
    
    <table class="table table-hover table-bordered table-striped">
        <tr>
            <th>#</th>
            <th>Indikator</th>
            <th>Satuan</th>
            <th>Tahun {{$th_awal}}</th>
            <th>Tahun {{$th_awal+1}}</th>
            <th>Tahun {{$th_awal+2}}</th>
            <th>Tahun {{$th_awal+3}}</th>
            <th>Tahun {{$th_awal+4}}</th>
            <th>Tahun {{$th_akhir}}</th>
            <th>Aksi</th>
        </tr>
        @php $no=0; @endphp
        @foreach($prog->indikator_program() as $i)
        @php $no++; @endphp

            <tr>
                <td>{{$no}}</td>
                <td>
                    <a href="" @if(Auth::user()->level=='Super Admin') class="update_ind" @endif data-name="indikator" data-pk="{{$i->id}}" data-placeholder="Edit Indikator" data-url="{{route('rpjmd.update',$i->id)}}" data-type="textarea">{{$i->indikator}}</a>
                </td>
                <td>
                    <a href="" @if(Auth::user()->level=='Super Admin') class="update_ind" @endif data-name="satuan" data-pk="{{$i->id}}" data-placeholder="Edit satuan" data-url="{{route('rpjmd.update',$i->id)}}" data-type="text">{{$i->satuan}}</a>
                </td>
                <td>
                    <a href="" @if(Auth::user()->level=='Super Admin') class="update_ind" @endif data-name="t1" data-pk="{{$i->id}}" data-placeholder="2016" data-url="{{route('rpjmd.update',$i->id)}}" data-type="text">{{$i->t1}}</a>
                </td>
                <td>
                    <a href="" @if(Auth::user()->level=='Super Admin') class="update_ind" @endif data-name="t2" data-pk="{{$i->id}}" data-placeholder="2017" data-url="{{route('rpjmd.update',$i->id)}}" data-type="text">{{$i->t2}}</a>
                </td>
                <td>
                    <a href="" @if(Auth::user()->level=='Super Admin') class="update_ind" @endif data-name="t3" data-pk="{{$i->id}}" data-placeholder="2018" data-url="{{route('rpjmd.update',$i->id)}}" data-type="text">{{$i->t3}}</a>
                </td>
                <td>
                    <a href="" @if(Auth::user()->level=='Super Admin') class="update_ind" @endif data-name="t4" data-pk="{{$i->id}}" data-placeholder="2019" data-url="{{route('rpjmd.update',$i->id)}}" data-type="text">{{$i->t4}}</a>
                </td>
                <td>
                    <a href="" @if(Auth::user()->level=='Super Admin') class="update_ind" @endif data-name="t5" data-pk="{{$i->id}}" data-placeholder="2020" data-url="{{route('rpjmd.update',$i->id)}}" data-type="text">{{$i->t5}}</a>
                </td>
                <td>
                    <a href="" @if(Auth::user()->level=='Super Admin') class="update_ind" @endif data-name="t6" data-pk="{{$i->id}}" data-placeholder="2021" data-url="{{route('rpjmd.update',$i->id)}}" data-type="text">{{$i->t6}}</a>
                </td>
                <td>
                    @if(Auth::user()->level=='Super Admin') 
                    <a ref="" class="btn btn-xs btn-danger hapus_ind" title="hapus indikator" value='{{$i->id}}' id_instansi="{{$prog->id_instansi}}" idprgrm="{{$prog->idprgrm}}"><i class="fa fa-trash"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
            <tr>
                <td></td>
                <td><textarea id="indikator" placeholder="Indikator" rows="3" cols="50"></textarea></td>
                <td><input type="text" id="satuan" maxlength="18" size="7" placeholder="Satuan"></td>
                <td><input type="text" id="t1" maxlength="18" size="7" placeholder="Tahun 1"></td>
                <td><input type="text" id="t2" maxlength="18" size="7" placeholder="Tahun 2"></td>
                <td><input type="text" id="t3" maxlength="18" size="7" placeholder="Tahun 3"></td>
                <td><input type="text" id="t4" maxlength="18" size="7" placeholder="Tahun 4"></td>
                <td><input type="text" id="t5" maxlength="18" size="7" placeholder="Tahun 5"></td>
                <td><input type="text" id="t6" maxlength="18" size="7" placeholder="Tahun 6"><input type="hidden" id="id_periode_rpjmd" value="{{$id_periode_rpjmd}}"></td>
                <td>
                    @if(Auth::user()->level=='Super Admin') 
                    <a ref="#" class="btn btn-xs btn-primary tambah_ind" title="tambah indikator program" id_instansi="{{$prog->id_instansi}}" idprgrm="{{$prog->idprgrm}}" unitkey="{{$prog->unitkey}}"><i class="fa fa-plus"></i></a>
                    @endif
                </td>
            </tr>
        
  </table>
 </div>
</div>
<script type="text/javascript">
    $('#wait').show();
    $(document).ready(function() {
        $('#wait').hide();
    });
    $.fn.editable.defaults.ajaxOptions = {type: "put"}
    $.ajaxSetup({
        headers: {
            // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.update_ind').editable({
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

    $('.tambah_ind').off('click').on('click', function () {
        var id_instansi = $(this).attr('id_instansi');
        var idprgrm = $(this).attr('idprgrm');
        var unitkey = $(this).attr('unitkey');
        var indikator = $('#indikator').val();
        var satuan = $('#satuan').val();
        var t1 = $('#t1').val();
        var t2 = $('#t2').val();
        var t3 = $('#t3').val();
        var t4 = $('#t4').val();
        var t5 = $('#t5').val();
        var t6 = $('#t6').val();
        var id_periode_rpjmd = $('#id_periode_rpjmd').val();
        $('#wait').show();
        var url = "{{url('modal') }}/"+idprgrm+'/id_instansi/'+id_instansi+'/'+id_periode_rpjmd;
        var url_simpan = "{{ route('rpjmd.store') }}";

        var formData = {
            tabel: "rpjmd_indikator",
            id_instansi: id_instansi,
            idprgrm: idprgrm,
            unitkey: unitkey,
            indikator: indikator,
            satuan: satuan,
            t1: t1,
            t2: t2,
            t3: t3,
            t4: t4,
            t5: t5,
            t6: t6,
            id_periode_rpjmd: id_periode_rpjmd,
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
    $('.hapus_ind').off('click').on('click', function () {
        var r = confirm("Hapus indikator program ?");
        if (r == false) {return false;}
        $('#wait').show();
        var id_instansi = $(this).attr('id_instansi');
        var idprgrm = $(this).attr('idprgrm');
        var id_periode_rpjmd = $('#id_periode_rpjmd').val();
        var url = "{{url('modal') }}/"+idprgrm+'/id_instansi/'+id_instansi+'/'+id_periode_rpjmd;
        var url_delete="{{ url('rpjmd')}}/"+$(this).attr('value');
        var data_delete = {
            _method: "DELETE",
            tabel: "rpjmd_indikator",
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
</script>
@endsection