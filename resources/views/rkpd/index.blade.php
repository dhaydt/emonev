@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Evaluasi Terhadap Hasil RKPD</div>
                <div class=""><center>Formulir E.19</center></div>
                <div class=""><center>Evaluasi Terhadap Hasil RKPD</center></div>
                <div class=""><center>Provinsi Sumatera Barat</center></div>
                <div class="card-body">
                <form method="GET" action="{{route('carirkpd')}}">
                       
                        <div class="form-group row">
                            <label for="name" class="col-md-5 col-form-label text-md-right">Tahun:</label>

                            <div class="col-md-2">
                                <input id="name" type="text" class="form-control" name="tahun1" required autofocus>

                                @if ($errors->has('tahun1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tahun1') }}</strong>
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
