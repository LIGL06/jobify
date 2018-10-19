@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-10 main">

                <h1 class="hidden-xs-down">
                    Administración
                </h1>
                <p class="lead hidden-xs-down">Aquí puedes ver el estado de la plataforma</p>

                <div class="alert alert-warning fade collapse" role="alert" id="myAlert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Holy guacamole!</strong> It's free.. this is an example theme.
                </div>

                <div class="row mb-3">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-inverse">
                            <div class="card-block">
                                <div class="rotate">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <h6 class="text-uppercase">Empresas</h6>
                                <h1 class="display-1">{{$companiesCount}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-inverse">
                            <div class="card-block">
                                <div class="rotate">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <h6 class="text-uppercase">Aplicantes</h6>
                                <h1 class="display-1">{{$employeesCounts}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-inverse">
                            <div class="card-block">
                                <div class="rotate">
                                    <i class="fa fa-twitter fa-5x"></i>
                                </div>
                                <h6 class="text-uppercase">Trabajos</h6>
                                <h1 class="display-1">{{$jobCounts}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-inverse">
                            <div class="card-block">
                                <div class="rotate">
                                    <i class="fa fa-share fa-5x"></i>
                                </div>
                                <h6 class="text-uppercase">Empleadores</h6>
                                <h1 class="display-1">{{$employersCounts}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->

                <hr>

                <p class="lead hidden-xs-down">Aquí puedes ver las ultimas vacantes creadas</p>
                <div class="row placeholders mb-3">
                    @foreach($jobs as $job)
                        <div class="col-6 col-sm-3 placeholder text-center">
                            <img src="//placehold.it/200/dddddd/fff?text=1"
                                 class="center-block img-fluid rounded-circle">
                            <h4>{{$job->title}}</h4>
                            <span class="text-muted">{{$job->company->name}}</span>
                        </div>
                    @endforeach
                </div>

                <a id="layouts"></a>
                <hr>
                <h2 class="sub-header">Listado de toda la información</h2>
                <div class="row mb-3" style="padding-bottom: 100px">
                    <div class="col-lg-12">
                        <div class="card card-default card-block">
                            <ul id="tabsJustified" class="nav nav-tabs nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" href="" data-target="#tab1" data-toggle="tab">Aplicaciones
                                        no aprobadas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="" data-target="#tab2" data-toggle="tab">Empresas no
                                        aprobadas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="" data-target="#tab3" data-toggle="tab">Usuarios no
                                        aprobados</a>
                                </li>
                            </ul>
                            <!--/tabs-->
                            <br>
                            <div id="tabsJustifiedContent" class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Puesto interesado</th>
                                            <th scope="col">Emprea interesada</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aprobado</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td scope="row">{{$employee->user->name}}</td>
                                                <td>{{$employee->job->title}}</td>
                                                <td>{{$employee->company->name}}</td>
                                                <td>{{$employee->status}}</td>
                                                @if(!$employee->approved)
                                                    <td>
                                                        <span class="badge badge-warning">No aprobado</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge badge-succes">Aprobado</span>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <h4>Profile Section</h4>
                                            <p>Imagine creating this simple user profile inside a tab card.</p>
                                        </div>
                                        <div class="col-sm-5"><img src="//placehold.it/170"
                                                                   class="float-right img-responsive img-rounded"></div>
                                    </div>
                                    <hr>
                                    <a href="javascript:;" class="btn btn-info btn-block">Read More Profiles</a>
                                    <div class="spacer5"></div>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <div class="list-group">
                                        <a href="" class="list-group-item"><span
                                                    class="float-right label label-info label-pill">44</span> <code>.panel</code>
                                            is now <code>.card</code></a>
                                        <a href="" class="list-group-item"><span
                                                    class="float-right label label-info label-pill">8</span> <code>.nav-justified</code>
                                            is deprecated</a>
                                        <a href="" class="list-group-item"><span
                                                    class="float-right label label-info label-pill">23</span> <code>.badge</code>
                                            is now <code>.label-pill</code></a>
                                        <a href="" class="list-group-item text-muted">Message n..</a>
                                    </div>
                                </div>
                            </div>
                            <!--/tabs content-->
                        </div>
                        <!--/card-->
                    </div>
                    <!--/col-->
                </div st>
                <!--/row-->

            </div>
        </div>
    </div>
@endsection
