@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Formulir E.54</div>
                <div class=""><center>Formulir E.54</center></div>
                <div class=""><center>Evaluasi terhadap Hasil Renstra Perangkat Daerah Lingkup Provinsi</center></div>
                <div class="card-body">
                <form method="GET" action="{{route('carie54')}}">
                       
                        <div class="form-group row">
                            <label for="name" class="col-md-5 col-form-label text-md-right">Kabupaten/Kota:</label>

                            <div class="col-md-4">
                                <select class="form-control" name="daerah" required autofocus>
                                    <option value=''>Pilih Kabupaten/Kota</option>
                                    <option value='1'>Kota Padang</option>
                                    <option value='2'>Kota Solok</option>
                                </select>
                                @if ($errors->has('daerah'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('daerah') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><div class="form-group row">
                            <label for="name" class="col-md-5 col-form-label text-md-right">Periode Pelaksanaan:</label>

                            <div class="col-md-2">
                                <input id="name" type="text" class="form-control" name="periode" required>

                                @if ($errors->has('periode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('periode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><div class="form-group row">
                            <label for="name" class="col-md-5 col-form-label text-md-right">Indikator dan Target Kinerja:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="indikator" required >

                                @if ($errors->has('indikator'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('indikator') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection