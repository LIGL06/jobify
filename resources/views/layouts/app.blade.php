<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Iván García <luis.garcialuna@outlook.com>">
    <meta property="og:title" content="Bolsa de trabajo en {{env('APP_NAME')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:image"
          content="{{env('APP_LOGO_FOOTER')}}"/>
    <meta property="og:image:alt" content="{{env('APP_ICON_URL')}}"/>
    <meta property="og:description" content="Crea, ve y encuentra trabajo en {{env('APP_NAME')}}."/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trabajos en {{env('APP_NAME')}}</title>
    <link rel="icon" type="image/png" sizes="196x196"
          href="{{env('APP_ICON_URL')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.min.css" rel="stylesheet"
          type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{env('APP_LOGO_URL')}}"
                 class="d-inline-block align-top img-fluid"
                 style="max-height:40px">
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
                @if(Auth::user() && Auth::user()->isEmployee())
                    <a class="nav-item nav-link" href="{{ url('/employees') }}">Aspirantes</a>
                @endif
                @if(Auth::user() && Auth::user()->isEmployer())
                    <a class="nav-item nav-link" href="{{ url('/employers') }}">Empresas</a>
                @endif
            </div>
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
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
                            @if(Auth::user()->isEmployee())
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fa fa-user-circle"></i> {{ __('Mi Perfil') }}
                                </a>
                            @endif
                            @if(Auth::user()->isEmployer())
                                <a class="dropdown-item" href="{{ route('companyProfile') }}">
                                    <i class="fa fa-suitcase"></i> {{ __('Mi Empresa') }}
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-unlock"></i> {{ __('Salir') }}
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
                <div class="col-3 col-md-2 col-lg-2 my-auto d-none d-sm-block">
                    <img src="{{env('APP_FOOTER_URL')}}" class="img-fluid">
                </div>
                <div class="col-12 col-md-10">
                    <h5 class="mt-2 mb-0">Peopable</h5>
                    <b class="mb-0">Genera, Ve o Aplica a Empleos</b><br>
                    <small>By <a href="mailto:luis.garcialuna@outlook.com">luis.garcialuna@outlook.com</a></small>
                    <small><b>(833) 411 4394</b></small>
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
<script src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/plugins/paragraph_format.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/plugins/font_size.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/plugins/lists.min.js"></script>
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
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function () {
        readURL(this);
    });
    var readURLCompany = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.companyAvatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".companyAvatarUpload").on('change', function () {
        readURLCompany(this);
    });
    $('textarea').froalaEditor({
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', '|', 'fontSize', 'paragraphFormat', 'formatOL', 'formatUL', 'outdent', 'indent', '|', 'undo', 'redo'],
        toolbarButtonsXS: ['bold', 'italic', 'underline', '|', 'paragraphFormat'],
        listAdvancedTypes: true,
    });
</script>
</body>

</html>
