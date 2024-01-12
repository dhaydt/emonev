@extends('layouts.template')

@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Akun OPD</li>
    <li class="active">Edit</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Edit Akun OPD <small></small></h3>
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
            <h4 class="panel-title">Form Edit Akun OPD</h4>
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
                    <form method="POST" class="form-horizontal" action="{{route('akun-opd.update',$opd->id)}}">
                        @csrf
                        @method('PUT')
                        
                        @if(Auth::guard('web')->check())
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Nama OPD:</label>
                              <div class="col-sm-8">
                                  <select name="id_instansi" class="form-control" id="sel">
                                    @foreach($data as $p)
                                      <option value="{{$p->id}}" @if($p->id==$opd->id_instansi) selected @endif>{{$p->nm_instansi}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">Username:</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="username" value="{{$opd->username}}" placeholder="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">Password:</label>
                                <div class="col-sm-4">
                                  <input type="password" class="form-control" name="password" placeholder="password">
                                  <small>*) kosongkan jika password tidak dirubah</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">Email:</label>
                                <div class="col-sm-4">
                                  <input type="email" class="form-control" name="email"  value="{{$opd->email}}" placeholder="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">NIP:</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="nip" value="{{$opd->nip}}" placeholder="nomor induk Pegawai">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">Nama Pegawai:</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="nm_pegawai" value="{{$opd->nm_pegawai}}" placeholder="nama Pegawai">
                                </div>
                            </div>
                            

                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Status:</label>
                              <div class="col-sm-4">
                                <input type="radio" value='1' name="status" @if($opd->status==1) checked @endif >Aktif&nbsp;
                                <input type="radio" value='2' name="status" @if($opd->status==2) checked @endif>Tidak Aktif
                              </div>
                          </div>

                        <div class="form-group"> 
                          <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-primary">Edit</button>
                          </div>
                        </div>
                        @else
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Nama OPD:</label>
                              <div class="col-sm-8">
                                  <select name="id_instansi" class="form-control" id="sel" readonly>
                                    @foreach($data as $p)
                                      <option value="{{$p->id}}" @if($p->id==$opd->id_instansi) selected @else disabled @endif>{{$p->nm_instansi}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">Username:</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="username" value="{{$opd->username}}" placeholder="username" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">Password:</label>
                                <div class="col-sm-4">
                                  <input type="password" class="form-control" name="password" placeholder="password">
                                  <small>*) kosongkan jika password tidak dirubah</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">Email:</label>
                                <div class="col-sm-4">
                                  <input type="email" class="form-control" name="email"  value="{{$opd->email}}" placeholder="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">NIP:</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="nip" value="{{$opd->nip}}" placeholder="nomor induk Pegawai">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="kdunit">Nama Pegawai:</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="nm_pegawai" value="{{$opd->nm_pegawai}}" placeholder="nama Pegawai">
                                </div>
                            </div>
                            

                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Status:</label>
                              <div class="col-sm-4">
                                <input type="radio" value='1' name="status" @if($opd->status==1) checked @else disabled @endif readonly>Aktif&nbsp;
                                <input type="radio" value='2' name="status" @if($opd->status==2) checked @else disabled @endif readonly>Tidak Aktif
                              </div>
                          </div>

                        <div class="form-group"> 
                          <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-primary">Edit</button>
                          </div>
                        </div>
                        @endif

                    </form>         
</div>

<script src="{{ asset('public/template/color_admin/plugins/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sel').select2();
    });
</script>
@endsection
