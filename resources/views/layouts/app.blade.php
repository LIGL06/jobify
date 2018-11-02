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
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="https://res.cloudinary.com/hammock-software/image/upload/v1539445395/logo.png"
                 class="d-inline-block align-top img-fluid"
                 alt="" style="max-height:50px">
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
                <a class="nav-item nav-link" href="{{ url('/employees') }}">Aspirantes</a>
                <a class="nav-item nav-link" href="{{ url('/employers') }}">Empresas</a>
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
                        <notification v-bind:notifications="notifications"></notification>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-user-o"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fa fa-user-circle"></i> {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-unlock"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-3 col-md-1 col-lg-1 my-auto">
                    <img src="https://res.cloudinary.com/hammock-software/image/upload/v1540740818/LOGO_DIRECCION_DE_DESARROLLO_ECONOMIGO_3183_d60tju.png" class="img-fluid img-thumbnail">
                </div>
                <div class="col-9 col-md-10">
                    <h5 class="mt-2">H. Ayuntamiento de Cuidad Madero</h5>
                    <b class="mb-0">Dirección de Desarrollo Económico</b>
                    <hr>
                    <small>Av. Álvaro Obregón 201 Sur, Zona Centro, 89400 Cd Madero, Tamps.</small>
                    <small><b>(833) 305 2300</b></small>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- Scripts -->
<script>
    @if(Auth::user())
        window.Laravel = {!!json_encode([
                'csrfToken' => csrf_token(),
                'user' => Auth::user()
            ]) !!};
    @else
        window.Laravel = {!!json_encode([
                'csrfToken' => 'none',
                'user' => 'none'
            ]) !!};
    @endif

</script>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script>
    var jobsPath = "{{ route('jobAutoComplete') }}";
    $('#jobsAutocomplete').typeahead({
        source: function (query, process) {
            return $.get(jobsPath, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
    var userPath = "{{ route('userAutoComplete') }}";
    $('#usersAutocomplete').typeahead({
        source: function (query, process) {
            return $.get(userPath, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
    var companiesPath = "{{ route('companiesAutoComplete') }}";
    $('#companiesAutocomplete').typeahead({
        source: function (query, process) {
            return $.get(companiesPath, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
</script>
</body>

</html>
