<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Channelised') }}</title>
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/sass/app.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/sass/register.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/css/home-style.css') }}">
</head>
<body class="basic_layout home-lt">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
            <a class="navbar-brand" href="javascript:void(0)"><img src="{{ asset('public/assets/images/logo.svg') }}" alt="" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">About Us</a>
                    <a class="nav-item nav-link" href="#">Features</a>
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-light my-2 my-sm-0 btn-shadow">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light my-2 my-sm-0 btn-shadow">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary text-white my-2 my-sm-0 btn-shadow">Sign Up</a>
                    @endauth
                </div>
            </div>
            </div>
        </nav>
    </header>
    <div>
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('public/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
    @stack('js')
</body>
</html>
