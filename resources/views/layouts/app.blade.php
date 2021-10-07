<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Channelised') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
    @stack('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register_plan'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register_plan') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @hasrole('partner')
                            <li class="nav-item">
                                <input type="text" class="form-control" id="search_event" value="{{@$txt}}" data-href="{{route(Auth::user()->roles[0]->name.'.event.search',':txt')}}"/>
                            </li>
                        @endhasrole
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::user()->roles[0]->name.'.home') }}">Home</a>
                            </li>
                        @hasrole('vendor')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::user()->roles[0]->name.'.events.index') }}">Events</a>
                            </li>
                        @endhasrole
                        @hasrole('partner')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::user()->roles[0]->name.'.events') }}">Events</a>
                            </li>
                        @endhasrole
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fullname }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js" defer></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js' defer></script>
    @stack('js')
    <script defer>
        $(function () {
            $(document).on('keyup','#search_event',function(event){
                //console.log($(this).val()); return false;
                var txt_search = $(this).val();
                if(event.which==13 && txt_search.length > 0){
                    var evtsrchlink = $(this).data('href');
                    evtsrchlink = evtsrchlink.replace(':txt',txt_search);
                    window.location = evtsrchlink; 
                }
            });
        });
    </script>
</body>
</html>
