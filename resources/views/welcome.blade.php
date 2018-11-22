@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div id="myCarousel" class="carousel slide mb-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container" style="max-height:500px">
                            <img class="w-100"
                                 src="https://res.cloudinary.com/hur6st2mn/image/upload/c_scale,h_800/v1542906297/samples/people/jazz.jpg">
                            <div class="carousel-caption text-left">
                                <h3 class="text-white">Entrevista aspirantes</h3>
                                <p><a class="btn btn-lg btn-primary" href={{route('register')}} role="button">Registrarse</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container" style="max-height:500px">
                            <img class="w-100"
                                 src="https://res.cloudinary.com/hur6st2mn/image/upload/c_scale,h_800/v1542906292/samples/people/kitchen-bar.jpg">
                            <div class="carousel-caption">
                                <h3 class="text-danger">Crea oportunidades</h3>
                                <p><a class="btn btn-lg btn-primary"
                                      href={{url('employees')}} role="button">Aspirantes</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container" style="max-height:500px">
                            <img class="w-100"
                                 src="https://res.cloudinary.com/hur6st2mn/image/upload/c_scale,h_800/v1542906295/samples/people/smiling-man.jpg">
                            <div class="carousel-caption text-right">
                                <h3 class="text-dark">Ayudanos a crecer contigo.</h3>
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
        </div>
    </div>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading mb-0">{{env('APP_NAME')}}</h1>
            <p class="lead text-muted mb-0 mt-0">¡Genera, Aplica o ve Empleos!</p>
            <p class="pb-0">
                <a href="{{ url('/employees') }}" class="btn btn-primary my-2">Aspirantes</a>
                <a href="{{ url('/employers') }}" class="btn btn-secondary my-2">Empresas</a>
            </p>
        </div>
    </section>
@endsection
