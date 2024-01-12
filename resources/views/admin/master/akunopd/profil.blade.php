@extends('layouts.template')
@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Profil OPD</li>
    <li class="active">Edit</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Edit Profil OPD <small></small></h3>
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
            <h4 class="panel-title">Form Edit Profil OPD</h4>
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

                        @if ($message = Session::get('sukses'))
                            <div id="notif" class="alert alert-success">
                                <p>{{$message}}</p>
                            </div>
                        @endif
                    <form method="POST" class="form-horizontal" action="{{route('profil.update',Auth::id())}}" >
                        @csrf
                        @method('PUT')
                        
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Nama OPD:</label>
                              <div class="col-sm-8">
                                  <input type="text" class="form-control" value="{{$opd->data_opd->nm_instansi}}" readonly="readonly">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Username:</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" name="username" value="{{$opd->username}}" placeholder="username" readonly="readonly">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">NIP Operator:</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" name="nip" value="{{$opd->nip}}" placeholder="nomor induk Pegawai">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Nama Operator:</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="nm_pegawai" value="{{$opd->nm_pegawai}}" placeholder="nama Pegawai">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Nama Pimpinan:</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="kepala" value="{{$opd->data_opd->kepala}}" placeholder="nama pimpinan">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Nip Pimpinan:</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" name="nip_pimpinan" value="{{$opd->data_opd->nip}}" placeholder="nip pimpinan">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Jenis Pimpinan:</label>
                              <div class="col-sm-2">
                                  <select name="pimpinan" class="form-control" >
                                    <option value="KEPALA" @if($opd->data_opd->pimpinan=="KEPALA") selected @endif >KEPALA</option>
                                    <option value="DIREKTUR" @if($opd->data_opd->pimpinan=="DIREKTUR") selected @endif >DIREKTUR</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Nomor Telepon:</label>
                              <div class="col-sm-4">
                                    <input type="text" class="form-control" name="telp" value="{{$opd->data_opd->telp}}" placeholder="Nomor Telepon" value="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Alamat:</label>
                              <div class="col-sm-5">
                                    <textarea class="form-control" placeholder="alamat" name="alamat">{{$opd->data_opd->alamat}}</textarea>
                              </div>
                          </div>
                      <div class="form-group"> 
                        <div class="col-sm-offset-3 col-sm-8">
                          <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                      </div>

                    </form>         
</div>
<script>
        $('#notif').slideDown('slow').delay(3000).slideUp('slow');
</script>
@endsection
