@extends('layouts.sign-in')

@section('content')
<!-- begin login -->
<div class="login login-with-news-feed">
    <!-- begin news-feed -->
    <div class="news-feed">
        <div class="news-image">
            <img src="{{ asset('public/template/color_admin/img/login-bg/bg-7.jpg') }}" data-id="login-cover-image" alt="" />
        </div>
        <div class="news-caption">
            <h4 class="caption-title"><i class="fa fa-diamond text-success"></i> Announcing the Color Admin app</h4>
            <p>
                Aplikasi SIMONEV Dokumen Perancanaan Daerah
            </p>
        </div>
    </div>
    <!-- end news-feed -->
    <!-- begin right-content -->
    <div class="right-content">
        <!-- begin login-header -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> Login Admin
                <small>SIMONEV DokRenda</small>
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
            </div>
        </div>
        <!-- end login-header -->
        <!-- begin login-content -->
        <div class="login-content">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label class="control-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <label class="control-label">{{ __('E-Mail Address') }} <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Alamat email" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <label class="control-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        
                    </div>
                </div>

                <label class="control-label">{{ __('Confirm') }} <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input id="password-confirm" type="password" placeholder="Re-type Password" class="form-control" name="password_confirmation" required>
                        
                    </div>
                </div>

                <div class="register-buttons">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('Register') }}</button>
                </div>
                <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                    Already a member? Click <a href="{{ route('login') }}">here</a> to login.
                </div>
                <hr />
                <p class="text-center">
                    &copy; Simonev Dokrenda All Right Reserved 2019
                </p>


            </form>
        </div>
        <!-- end login-content -->
    </div>
    <!-- end right-container -->
</div>
<!-- end login -->
@endsection
