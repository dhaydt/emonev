@extends('layouts.template')

@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Master Sub Kegiatan</li>
    <li class="active">Edit</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Edit Master Sub Kegiatan <small></small></h3>
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
            <h4 class="panel-title">Form Edit Sub Kegiatan</h4>
        </div>
        <div class="panel-body">

                        @if ($message = Session::get('fail'))
                            <div class="alert alert-danger" style="padding:0px;">
                                <p>{{$message}}</p>
                            </div>
                        @endif

                        <ul>
                        @foreach($errors->all() as $error)
                            <li class="alert alert-danger">{{$error}}</li>
                        @endforeach
                        </ul>

                        <link href="{{ asset('public/template/color_admin/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
                    <form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('mastersubkegiatan.update',$kegiatan->id)}}" @endif>
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="kdunit">ID Sub Kegiatan:</label>
                            <div class="col-sm-2">
                              <input type="text"  readonly=readonly class="form-control" name="id" value="{{$kegiatan->id}}" placeholder="nama kegiatan">
                            </div>
                        </div>
                      <div class="form-group">
                                      <label class="control-label col-sm-3" for="kdunit">Nama Kegiatan:</label>
                                      <div class="col-sm-5">
                                          <select name="idprgrm" class="form-control" id="sel">
                                            @foreach($prog as $p)
                                              <option value="{{$p->id}}" @if($kegiatan->kdkegunit==$p->id) selected @endif >[{{$p->id}}] {{$p->nmkegunit}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-sm-3" for="kdunit">Nama Sub Kegiatan:</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nmkegunit" value="{{$kegiatan->nmsub_keg}}" placeholder="nama kegiatan">
                                      </div>
                                  </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="kdunit">Status:</label>
                            <div class="col-sm-4">
                              <input type="radio" value='1' name="id_status" @if($kegiatan->id_status==1) checked @endif >Aktif&nbsp;
                              <input type="radio" value='2' name="id_status" @if($kegiatan->id_status==2) checked @endif>Tidak Aktif
                            </div>
                        </div>

                      <div class="form-group"> 
                        <div class="col-sm-offset-3 col-sm-8">
                          <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                      </div>

                    </form>         
</div>

<script src="{{ asset('public/template/color_admin/plugins/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sel').select2();
    });
</script>
@endsection
