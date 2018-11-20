@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100"
                             src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,h_500/c_scale,g_south_east,h_100,l_icon.png/v1540232384/pexels1.jpg">
                        <div class="container">
                            <div class="carousel-caption text-left">
                                <h1>Entrevistas.</h1>
                                <p>Las entrevistas de trabajo son un método indispensable en cualquier proceso de
                                    reclutamiento. Es por eso que debemos prepararnos con anticipación y aprender a
                                    vendernos de la mejor manera posible.</p>
                                <p><a class="btn btn-lg btn-primary" href={{route('register')}} role="button">Registrarse</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100"
                             src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,h_500/c_scale,g_south_east,h_100,l_icon.png/v1540232381/pexels2.jpg">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>Crea oportunidades.</h1>
                                <p>Dale a todos la oportunidad de realizar un trabajo, ya sea como plomero, albañil o
                                    programador.</p>
                                <p><a class="btn btn-lg btn-primary"
                                      href={{url('employees')}} role="button">Aspirantes</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100"
                             src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,h_500/c_scale,g_south_east,h_100,l_icon.png/v1540232381/pexels3.jpg">
                        <div class="container">
                            <div class="carousel-caption text-right">
                                <h1>Comparte tu experiencia de trabajo.</h1>
                                <p>Genera un historial de una empresa y ayudanos a crecer contigo.</p>
                                <p><a class="btn btn-lg btn-primary"
                                      href={{url('employers')}} role="button">Empresas</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <section class="jumbotron text-center pb-lg-5">
                <div class="container">
                    <h1 class="jumbotron-heading">Bolsa de Trabajo</h1>
                    <p class="lead text-muted">¡Genera, Aplica o ve Empleos!</p>
                    <p>
                        <a href="{{ url('/employees') }}" class="btn btn-primary my-2">Aspirantes</a>
                        <a href="{{ url('/employers') }}" class="btn btn-secondary my-2">Empresas</a>
                    </p>
                </div>
            </section>
        </div>
    </div>
@endsection
