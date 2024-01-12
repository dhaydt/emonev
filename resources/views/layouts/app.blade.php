<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMONEV (DokRenDa)</title>
    <link rel="shortcut icon" href="{{ asset('public/assets/img/logo.png') }}">


    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#60a3bc;">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                <img src="{{ asset('public/assets/img/sumbar.png') }}" alt="logo" height="25px">
                    SIMONEV (DokRenDa)

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                        
                            @php
                            if (!Auth::guard('web')->check() and !Auth::guard('opd')->check()) {
                            @endphp
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @php
                            }
                            else if (Auth::guard('web')->check()) {
                            @endphp
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('formrpjmd') }}">Evaluasi RPJMD</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('formrkpd') }}">Evaluasi RKPD</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('forme54') }}">Evaluasi RENSTRA</a>
                                </li>
                            @php
                            }
                            @endphp

                            @php
                            if (Auth::guard('web')->check() or Auth::guard('opd')->check()) {
                            @endphp
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('evaluasi-renja') }}">Evaluasi RENJA</a>
                                </li>    

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        @php
                                        if (Auth::guard('web')->check()) {
                                            echo Auth::user()->name;
                                        }else if (Auth::guard('opd')->check()){
                                            echo Auth::guard('opd')->user()->username;
                                        }
                                        @endphp    
                                        <span class="caret text-white"></span>
                                    
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        
                                    @php
                                    if (Auth::guard('web')->check()) {
                                    @endphp
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @php
                                    }
                                    @endphp
                            
                            @php
                            if (Auth::guard('opd')->check()) {
                            @endphp
                                        <a href="{{ route('keluar') }}" class="dropdown-item" >Keluar</a>
                            @php
                            }
                            @endphp
                            
                                    </div>
                                </li>
                                @php
                            }
                            @endphp
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    </footer>
    <footer class="footer">
      <div class="container">
        <span class="text-muted">© 2019 Copyright - EMonev | Page Render In {{ (microtime(true)) - LARAVEL_START }} Seconds</span>
      </div>
    </footer>
</body>
</html>