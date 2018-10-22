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
                        <img class="first-slide"
                             src="https://res.cloudinary.com/hammock-software/image/upload/v1540232384/pexels-photo-1161465_fq0cbd.jpg"
                             alt="First slide" width="100%">
                        <div class="container">
                            <div class="carousel-caption text-left">
                                <h1>Example headline.</h1>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                                    porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id
                                    elit.</p>
                                <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="second-slide"
                             src="https://res.cloudinary.com/hammock-software/image/upload/v1540232381/pexels-photo-567633_rinjwi.jpg"
                             alt="Second slide" width="100%">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>Another example headline.</h1>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                                    porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id
                                    elit.</p>
                                <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="third-slide"
                             src="http://res.cloudinary.com/hammock-software/image/upload/v1540232381/pexels-photo-580613_ds8t8x.jpg"
                             alt="Third slide" width="100%">
                        <div class="container">
                            <div class="carousel-caption text-right">
                                <h1>One more for good measure.</h1>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                                    porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id
                                    elit.</p>
                                <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
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
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Bolsa de Trabajo</h1>
                    <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus fuga
                        minima quisquam reprehenderit. Aliquam architecto atque commodi deleniti eveniet id libero
                        necessitatibus officiis optio provident quo repellendus sequi totam, veritatis!</p>
                    <p>
                        <a href="{{ url('/employees') }}" class="btn btn-primary my-2">Busco empleo</a>
                        <a href="{{ url('/employers') }}" class="btn btn-secondary my-2">Busco empleados</a>
                    </p>
                </div>
            </section>
        </div>
    </div>
@endsection
