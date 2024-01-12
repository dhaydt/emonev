@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">RPJMD</div>
                <div class=""><center>Formulir E.17</center></div>
                <div class=""><center>Evaluasi Terhadap Hasil RPJMD</center></div>
                <div class=""><center>Provinsi Sumatera Barat</center></div>
                <div class="card-body">
                <form method="GET" action="{{route('carirpjmd')}}">
                       
                        <div class="form-group row">
                            <label for="name" class="col-md-5 col-form-label text-md-right">Dari Tahun:</label>

                            <div class="col-md-2">
                                <input id="name" type="text" class="form-control" name="tahun1" required autofocus>

                                @if ($errors->has('tahun1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tahun1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-5 col-form-label text-md-right">Sampai Tahun:</label>

                            <div class="col-md-2">
                                <input id="name" type="text" class="form-control" name="tahun2" required autofocus>

                                @if ($errors->has('tahun2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tahun2') }}</strong>
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
