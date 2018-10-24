@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-10 main">
            <h1 class="hidden-xs-down">
                Administración
            </h1>
            <p class="lead hidden-xs-down">Para crear una vacante:
                <ol>
                    <li>Crea o ten creada una empresa.</li>
                    <li>Crea o ten empleadores en la empresa.</li>
                    <li>Crea o ten vacantes de empleos disponibles.</li>
                </ol>
            </p>
            <div class="row mb-3">
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="pb-2">
                                <i class="fa fa-building fa-5x"></i>
                            </div>
                            <h5 class="text-uppercase pt-0">Empresas: <b>{{$companiesCount}}</b></h5>
                            <a href="{{url('/companies/create')}}" class="btn btn-sm btn-secondary">Nueva</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="rotate">
                                <i class="fa fa-suitcase fa-5x"></i>
                            </div>
                            <h5 class="text-uppercase">Empleadores: <b>{{$employersCounts}}</b></h5>
                            <a href="{{url('/employers/create')}}" class="btn btn-sm btn-secondary">Nueva</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="pb-2">
                                <i class="fa fa-handshake-o fa-5x"></i>
                            </div>
                            <h5 class="text-uppercase">Empleos: <b>{{$jobCounts}}</b></h5>
                            <a href="{{url('/jobs/create')}}" class="btn btn-sm btn-secondary">Nueva</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="pb-2">
                                <i class="fa fa-paperclip fa-5x"></i>
                            </div>
                            <h5 class="text-uppercase">Aspirantes: <b>{{$employeesCounts}}</b></h5>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

            <hr>
            <h2 class="sub-header">Listado de no aprobaciones</h2>
            <div class="row mb-3 pb-lg-1">
                <div class="col-lg-12">
                    <div class="card card-default card-block">
                        <ul id="tabsJustified" class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="" data-target="#tab2" data-toggle="tab">Empresas no
                                    aprobadas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="" data-target="#tab3" data-toggle="tab">Empleadores no
                                    aprobados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="" data-target="#tab4" data-toggle="tab">Empleos no
                                    aprobados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="" data-target="#tab1" data-toggle="tab">Aspirantes
                                    no aprobadas</a>
                            </li>
                        </ul>
                        <!--/tabs-->
                        <br>
                        <div id="tabsJustifiedContent" class="tab-content">
                            <div class="tab-pane" id="tab1">
                                <table class="table text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Puesto interesado</th>
                                            <th scope="col">Emprea interesada</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aprobado</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                        @if(!$employee->approved)
                                        <tr>
                                            <td scope="row">{{$employee->user->name}}</td>
                                            <td>{{$employee->job->title}}</td>
                                            <td>{{$employee->company->name}}</td>
                                            <td>{{$employee->status}}</td>
                                            @if(!$employee->approved)
                                            <td>
                                                <span class="badge badge-warning">No aprobado</span>
                                            </td>
                                            <td>
                                                {!! Form::model($employee,['route' => ['employees.update',
                                                $employee->id], 'method'=>'put']) !!}
                                                {!! Form::hidden('approved',1)!!}
                                                {!! Form::submit('Activar',['class' => 'btn btn-sm btn-success']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-succes">Aprobado</span>
                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane active" id="tab2">
                                <table class="table text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Giro</th>
                                            <th scope="col">Teléfono</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($companies as $company)
                                        @if(!$company->approved)
                                        <tr>
                                            <td scope="row">{{$company->name}}</td>
                                            <td>{{$company->rotation}}</td>
                                            <td>{{$company->phone}}</td>
                                            <td>{{$company->address}}</td>
                                            @if(!$company->approved)
                                            <td>
                                                <span class="badge badge-warning">No aprobado</span>
                                            </td>
                                            <td>
                                                {!! Form::model($company,['route' => ['companies.update',
                                                $company->id], 'method'=>'put']) !!}
                                                {!! Form::hidden('approved',1)!!}
                                                {!! Form::submit('Activar',['class' => 'btn btn-sm btn-success']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-succes">Aprobado</span>
                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab3">
                                <table class="table text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Empresa</th>
                                            <th scope="col">Aprobado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employers as $employer)
                                        @if(!$employer->approved)
                                        <tr>
                                            <td scope="row">{{$employer->user->name}}</td>
                                            <td>{{$employer->company->name}}</td>
                                            @if(!$employer->approved)
                                            <td>
                                                <span class="badge badge-warning">No aprobado</span>
                                            </td>
                                            <td>
                                                {!! Form::model($employer,['route' => ['employers.update',
                                                $employer->id], 'method'=>'put']) !!}
                                                {!! Form::hidden('approved',1)!!}
                                                {!! Form::submit('Activar',['class' => 'btn btn-sm btn-success']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-succes">Aprobado</span>
                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab4">
                                <table class="table text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Titulo</th>
                                            <th scope="col">Profesión</th>
                                            <th scope="col">Empresa</th>
                                            <th scope="col">Vacantes</th>
                                            <th scope="col">Status</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                        @if(!$job->approved)
                                        <tr>
                                            <td scope="row">{{$job->title}}</td>
                                            <td>{{$job->subTitle}}</td>
                                            <td>{{$job->company->name}}</td>
                                            <td>
                                                @if($job->vacancies <= 2) <span class="badge badge-warning">{{$job->vacancies}}</span>
                                                    @else
                                                    <span class="badge badge-success">{{$job->vacancies}}</span>
                                                    @endif
                                            </td>
                                            @if(!$job->approved)
                                            <td>
                                                <span class="badge badge-warning">No aprobado</span>
                                            </td>
                                            <td>
                                                {!! Form::model($job,['route' => ['jobs.update',
                                                $job->id], 'method'=>'put']) !!}
                                                {!! Form::hidden('approved',1)!!}
                                                {!! Form::submit('Activar',['class' => 'btn btn-sm btn-success']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-succes">Aprobado</span>
                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/tabs content-->
                    </div>
                    <!--/card-->
                </div>
                <!--/col-->
            </div>
            <!--/row-->

            <hr>
            <h2 class="sub-header">Listado de aprobados</h2>
            <div class="row mb-3 pb-lg-1">
                <div class="col-lg-12">
                    <div class="card card-default card-block">
                        <ul id="tabsJustified" class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="" data-target="#approvedTab2" data-toggle="tab">Empresas
                                    aprobadas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="" data-target="#approvedTab3" data-toggle="tab">Empleadores
                                    aprobados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="" data-target="#approvedTab1" data-toggle="tab">Aspirantes
                                    aprobadas</a>
                            </li>
                        </ul>
                        <!--/tabs-->
                        <br>
                        <div id="tabsJustifiedContent" class="tab-content">
                            <div class="tab-pane" id="approvedTab1">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Puesto interesado</th>
                                            <th scope="col">Emprea interesada</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aprobado</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                        @if($employee->approved)
                                        <tr>
                                            <td scope="row">{{$employee->user->name}}</td>
                                            <td>{{$employee->job->title}}</td>
                                            <td>{{$employee->company->name}}</td>
                                            <td>{{$employee->status}}</td>
                                            @if(!$employee->approved)
                                            <td>
                                                <span class="badge badge-warning">No aprobado</span>
                                            </td>
                                            <td>

                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-succes">Aprobado</span>
                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane active" id="approvedTab2">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Giro</th>
                                            <th scope="col">Teléfono</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($companies as $company)
                                        @if($company->approved)
                                        <tr>
                                            <td scope="row">{{$company->name}}</td>
                                            <td>{{$company->rotation}}</td>
                                            <td>{{$company->phone}}</td>
                                            <td>{{$company->address}}</td>
                                            @if(!$company->approved)
                                            <td>
                                                <span class="badge badge-warning">No aprobado</span>
                                            </td>
                                            <td>

                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-succes">Aprobado</span>
                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="approvedTab3">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Empresa</th>
                                            <th scope="col">Aprobado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employers as $employer)
                                        @if($employer->approved)
                                        <tr>
                                            <td scope="row">{{$employer->user->name}}</td>
                                            <td>{{$employer->company->name}}</td>
                                            @if(!$employer->approved)
                                            <td>
                                                <span class="badge badge-warning">No aprobado</span>
                                            </td>
                                            <td>

                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-succes">Aprobado</span>
                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/tabs content-->
                    </div>
                    <!--/card-->
                </div>
                <!--/col-->
            </div>

            <hr>
            <p class="lead hidden-xs-down">Aquí puedes ver los ultimos empleos creados de empresas validas</p>
            <div class="row placeholders mb-3" style="padding-bottom:100px;">
                @foreach($jobs as $job)
                @if($job->company->approved && $job->vacancies>0)
                <div class="card col-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$job->title}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$job->company->name}}</h6>
                        <p class="card-text">Quedan <b>{{$job->vacancies}}</b> vacantes</p>
                        <a href={{url("/jobs/{$job->id}")}} class="card-link">Ver</a>
                        <a href={{url("/jobs/{$job->id}/edit")}} class="card-link">Editar</a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
