@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-10 main">

                <h1 class="hidden-xs-down">
                    Administración
                </h1>
                <p class="lead hidden-xs-down">Aquí puedes ver el estado de la plataforma</p>
                <div class="row mb-3">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="pb-2">
                                    <i class="fa fa-building fa-5x"></i>
                                </div>
                                <h5 class="text-uppercase pt-0">Empresas</h5>
                                <h3>{{$companiesCount}}</h3>
                                <a href="{{url('/companies/create')}}" class="btn btn-sm btn-secondary">Nueva</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="pb-2">
                                    <i class="fa fa-paperclip fa-5x"></i>
                                </div>
                                <h5 class="text-uppercase">Aplicantes</h5>
                                <h3>{{$employeesCounts}}</h3>
                                <a href="{{url('/employees/create')}}" class="btn btn-sm btn-secondary">Nueva</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="pb-2">
                                    <i class="fa fa-handshake-o fa-5x"></i>
                                </div>
                                <h5 class="text-uppercase">Empleos</h5>
                                <h3>{{$jobCounts}}</h3>
                                <a href="{{url('/jobs/create')}}" class="btn btn-sm btn-secondary">Nueva</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="rotate">
                                    <i class="fa fa-suitcase fa-5x"></i>
                                </div>
                                <h5 class="text-uppercase">Empleadores</h5>
                                <h3>{{$employersCounts}}</h3>
                                <a href="{{url('/employers/create')}}" class="btn btn-sm btn-secondary">Nueva</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->

                <hr>
                <h2 class="sub-header">Listado de toda la información</h2>
                <div class="row mb-3 pb-lg-1">
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
                                    <a class="nav-link" href="" data-target="#tab3" data-toggle="tab">Empleadores no
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
                                            <th scope="col">Acciones</th>
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
                                                    <td>
                                                        {!! Form::model($employee,['route' => ['employees.update', $employee->id], 'method'=>'put']) !!}
                                                        {!! Form::hidden('approved',true)!!}
                                                        {!! Form::submit('Activar',['class' => 'btn btn-sm btn-success']) !!}
                                                        {!! Form::close() !!}
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
                                                        {!! Form::model($company,['route' => ['companies.update', $company->id], 'method'=>'put']) !!}
                                                        {!! Form::hidden('approved',true)!!}
                                                        {!! Form::submit('Activar',['class' => 'btn btn-sm btn-success']) !!}
                                                        {!! Form::close() !!}
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
                                <div class="tab-pane" id="tab3">
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
                                            <tr>
                                                <td scope="row">{{$employer->user->name}}</td>
                                                <td>{{$employer->company->name}}</td>
                                                @if(!$employer->approved)
                                                    <td>
                                                        <span class="badge badge-warning">No aprobado</span>
                                                    </td>
                                                    <td>
                                                        {!! Form::model($employer,['route' => ['employers.update', $employer->id], 'method'=>'put']) !!}
                                                        {!! Form::hidden('approved',true)!!}
                                                        {!! Form::submit('Activar',['class' => 'btn btn-sm btn-success']) !!}
                                                        {!! Form::close() !!}
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
                            </div>
                            <!--/tabs content-->
                        </div>
                        <!--/card-->
                    </div>
                    <!--/col-->
                </div>
                <!--/row-->

                <hr>
                <p class="lead hidden-xs-down">Aquí puedes ver los ultimos empleos creados</p>
                <div class="row placeholders mb-3" style="padding-bottom:100px;">
                    @foreach($jobs as $job)
                        <div class="col-6 col-sm-3 placeholder text-center">
                            <div class="pb-2">
                                <i class="fa fa-briefcase fa-5x"></i>
                            </div>
                            <h4>{{$job->title}}</h4>
                            <span class="text-muted">{{$job->company->name}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
