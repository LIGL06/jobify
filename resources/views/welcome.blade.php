<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bolsa de Trabajo Municipio de Ciudad Madero</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Roboto', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Ingresar</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Registrarse</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <img src="https://res.cloudinary.com/hammock-software/image/upload/v1539445395/logo.png" class="col-12 col-md-12 col-lg-12">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center" style="text-transform:uppercase"><b>bolsa de trabajo ciudad madero</b></h3>
                </div>
            </div>
            <div class="row" style="padding-bottom: 20px">
                <div class="col-8 col-sm-3 offset-2 pb-2 offset-sm-3 col-md-4 offset-md-2 col-lg-4">
                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal"
                            data-target="#authModal">Busco
                        empleo
                    </button>
                </div>
                <div class="col-8 col-sm-3 offset-2 pb-2 offset-sm-0 col-md-4 col-lg-4">
                    <button type="button" class="btn btn-secondary btn-lg btn-block" data-toggle="modal"
                            data-target="#authModal">Busco
                        empleados
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
