@extends('layouts.template')

@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>Akun Admin</li>
    <li class="active">Edit</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Edit Akun Admin <small></small></h3>
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
            <h4 class="panel-title">Form Edit Akun Admin</h4>
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

                    <form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('akun-adm.update',$adm->id)}}" @endif>
                        @csrf
                        @method('PUT')
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Nama Lengkap:</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" value="{{$adm->name}}" placeholder="username">
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
                                <input type="email" class="form-control" name="email"  value="{{$adm->email}}" placeholder="email">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="control-label col-sm-3" for="kdunit">Level:</label>
                              <div class="col-sm-4">
                                <select class="form-control" name="level">
                                  <option @if($adm->level=="Super Admin") selected=selected @endif>Super Admin</option>
                                  <option @if($adm->level=="Bidang") selected=selected @endif>Bidang</option>
                                  <option @if($adm->level=="Viewer") selected=selected @endif>Viewer</option>
                              </select>
                              </div>
                          </div>

                      <div class="form-group"> 
                        <div class="col-sm-offset-3 col-sm-8">
                          <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                      </div>

                    </form>         
</div>
@endsection
