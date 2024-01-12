@extends('layouts.template')

@section('content')

<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li>OPD</li>
    <li class="active">Edit</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h3 class="page-header" style="margin: 0px;">Edit OPD <small></small></h3>
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
            <h4 class="panel-title">Form Edit OPD</h4>
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
                    <form method="POST" class="form-horizontal" @if(Auth::user()->level=='Super Admin') action="{{route('data-opd.update',$opd->id)}}" @endif>
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Kode Unit:</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" name="kdunit" value="{{$opd->kdunit}}" placeholder="kode unit" readonly="readonly">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">UnitKey:</label>
                          <div class="col-sm-2">
                                <input type="text" class="form-control" name="unit_key" value="{{$opd->unit_key}}" placeholder="unitkey" readonly="readonly">  
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Kode Level:</label>
                          <div class="col-sm-1">
                                <select class="form-control" name="kdlevel">
                                    <option 
                                    @if($opd->kdlevel==3)
                                        selected 
                                    @endif
                                    >3</option>
                                    <option
                                    @if($opd->kdlevel==4)
                                        selected 
                                    @endif
                                    >4</option>
                                </select>   
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Tipe:</label>
                          <div class="col-sm-1">
                                <input type="text" class="form-control" name="tipe"  value="{{$opd->tipe}}" placeholder="tipe"> 
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Nama Instansi:</label>
                          <div class="col-sm-5">
                                <input type="text" class="form-control" name="nm_instansi" value="{{$opd->nm_instansi}}" placeholder="nama instansi">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Jenis Pimpinan:</label>
                          <div class="col-sm-2">
                              <select name="pimpinan" class="form-control" >
                                <option value="KEPALA" @if($opd->pimpinan=="KEPALA") selected @endif >KEPALA</option>
                                <option value="DIREKTUR" @if($opd->pimpinan=="DIREKTUR") selected @endif >DIREKTUR</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Kepala Instansi:</label>
                          <div class="col-sm-5">
                                <input type="text" class="form-control" name="kepala" value="{{$opd->kepala}}" placeholder="kepala instansi">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">NIP:</label>
                          <div class="col-sm-3">
                                <input type="text" class="form-control" name="nip" value="{{$opd->nip}}" placeholder="NIP Kepala Instansi" value="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Sigkatan:</label>
                          <div class="col-sm-4">
                                <input type="text" class="form-control" name="singkatan" value="{{$opd->singkatan}}" placeholder="Singkatan" value="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Akrounit:</label>
                          <div class="col-sm-4">
                                <input type="text" class="form-control" name="akrounit" value="{{$opd->akrounit}}" placeholder="Akrounit" value="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Nomor Telepon:</label>
                          <div class="col-sm-4">
                                <input type="text" class="form-control" name="telp" value="{{$opd->telp}}" placeholder="Nomor Telepon" value="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Alamat:</label>
                          <div class="col-sm-5">
                                <textarea class="form-control" name="alamat">{{$opd->alamat}}</textarea>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="kdunit">Non Urusan:</label>
                          <div class="col-sm-4">
                            <input type="radio" name="non_urusan" value="1" @if($opd->non_urusan==1) checked @endif>Ada 
                            <input type="radio" name="non_urusan" value="0" @if($opd->non_urusan==0) checked @endif>Tidak Ada
                          </div>
                      </div>
                      <div class="form-group"> 
                        <div class="col-sm-offset-4 col-sm-8">
                          <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                      </div>

                    </form>         
</div>

@endsection
