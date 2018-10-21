<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Iván García <luis.garcialuna@outlook.com>">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ciudad Madero') }}</title>
    <link rel="icon" type="image/png" sizes="196x196"
          href="https://res.cloudinary.com/hammock-software/image/upload/v1539446336/icon.png">
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand active" href="{{ url('/') }}">
            <img src="https://res.cloudinary.com/hammock-software/image/upload/v1539445395/logo.png"
                 class="col-10 offset-6 col-md-8 offset-md-0">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                @if(Auth::user() && Auth::user()->isAdmin())
                    <a class="nav-item nav-link" href="{{ url('/admin') }}">Admnistrador</a>
                @endif
                <a class="nav-item nav-link" href="{{ url('/employees') }}">Empleados</a>
                <a class="nav-item nav-link" href="{{ url('/employers') }}">Empleadores</a>
            </div>
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
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    @if(Auth()->check())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                               data-toggle="dropdown"
                               aria-expanded="false"><i class="fa fa-globe"></i> Notifications <span
                                        class="badge badge-danger"
                                        id="count-notification">
                                 {{Auth()->user()->unreadNotifications->count()}}<span
                                            class="caret"></span></span>
                            </a>
                            <div class="dropdown-menu">
                                @if(Auth()->user()->unreadNotifications->count())
                                    @foreach(Auth()->user()->unreadNotifications as $notification)
                                        <a href="#" class="dropdown-item">
                                            {{$notification->data['message']}}
                                        </a>
                                    @endforeach
                                @else
                                    <a href="#" class="dropdown-item">
                                        No notification
                                    </a>
                                @endif
                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="col-12 text-center text-muted">
                <p>Ayuntamiento de Ciudad Madero
                <hr style="margin-top:-15px;margin-bottom:0px;">
                Administración 2018 - 2021
                <br style="margin-bottom:-10px;">
                </p>
                <p style="margin-top:-20px;margin-bottom:-10px;"><a href="#">Aviso de Privacidad</a> &nbsp; | &nbsp; <a
                            href="#">Contacto</a></p>
            </div>
        </div>
    </footer>
</div>
</body>

</html>
