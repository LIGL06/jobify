@extends('layouts.app')

@section('content')
    @if(Auth::user()->isAdmin())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 main">
                    <h1 class="mb-0">
                        Administración
                    </h1>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="lead  mb-0">Para crear una vacante:
                    <ol>
                        <li>Crea o ten creada una empresa.</li>
                        <li>Crea o ten empleadores en la empresa.</li>
                        <li>Crea o ten vacantes de empleos disponibles.</li>
                    </ol>
                    </p>
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card h-100">
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
                            <div class="card h-100">
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
                            <div class="card h-100">
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
                            <div class="card h-100">
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
                    <div class="row pb-5">
                        <div class="col-md-3 col-12">
                            <h2 class="text-center">Empresas</h2>
                            <div class="card card-default card-block h-100">
                                <div class="list-group pre-scrollable">
                                    @foreach($companies as $company)
                                        <a
                                           class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{mb_convert_case($company->name,MB_CASE_TITLE, "UTF-8")}}</h5>
                                                <small>{{\Carbon\Carbon::parse($company->created_at)->format('M d')}}</small>
                                            </div>
                                            <p class="mb-1">{{mb_convert_case($company->rotation,MB_CASE_TITLE, "UTF-8")}}</p>
                                            <div class="d-flex w-100 justify-content-between">
                                                <small>{{mb_convert_case($company->observations,MB_CASE_TITLE, "UTF-8")}}</small>
                                                @if(!$company->approved)
                                                    {!! Form::model($company,['route' => ['companies.update',
                                                    $company->id], 'method'=>'put']) !!}
                                                    {!! Form::hidden('approved',1)!!}
                                                    {!! Form::submit('Aprobar',['class' => 'btn btn-sm btn-success']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <span class="badge badge-primary">Aprobado</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <h2 class="text-center">Empleadores</h2>
                            <div class="card card-default card-block h-100">
                                <div class="list-group pre-scrollable">
                                    @foreach($employers as $employer)
                                        <a
                                           class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-0">{{mb_convert_case($employer->user->name,MB_CASE_TITLE, "UTF-8")}}</h5>
                                                <small>{{\Carbon\Carbon::parse($employer->created_at)->format('M d')}}</small>
                                            </div>
                                            <small class="mb-0">{{mb_convert_case($employer->user->email,MB_CASE_TITLE, "UTF-8")}}</small>
                                            <div class="d-flex w-100 justify-content-between">
                                                <small>{{mb_convert_case($employer->company->name,MB_CASE_TITLE, "UTF-8")}}</small>
                                                @if(!$employer->approved)
                                                    {!! Form::model($employer,['route' => ['employers.update',
                                                    $employer->id], 'method'=>'put']) !!}
                                                    {!! Form::hidden('approbed',1)!!}
                                                    {!! Form::submit('Aprobar',['class' => 'btn btn-sm btn-success']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <span class="badge badge-primary">Aprobado</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <h2 class="col-12 text-center">Empleos</h2>
                            <div class="card card-default card-block h-100">
                                <div class="list-group pre-scrollable">
                                    @foreach($jobs as $job)
                                        <a href="{{route('jobs.show', $job->id)}}"
                                           class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-0">{{mb_convert_case($job->title,MB_CASE_TITLE, "UTF-8")}}</h5>
                                                <small>{{\Carbon\Carbon::parse($job->created_at)->format('M d')}}</small>
                                            </div>
                                            <small>{{mb_convert_case($job->subTitle,MB_CASE_TITLE, "UTF-8").' en '. $job->company->name}}</small>
                                            <div class="d-flex w-100 justify-content-between">
                                                @if($job->vacancies <= 2)
                                                    <span class="badge badge-warning">{{$job->vacancies.' vacantes'}}</span>
                                                @else
                                                    <span class="badge badge-success">{{$job->vacancies.' vacantes'}}</span>
                                                @endif
                                                @if(!$job->approved)
                                                    {!! Form::model($job,['route' => ['jobs.update',
                                                    $job->id], 'method'=>'put']) !!}
                                                    {!! Form::hidden('approved',1)!!}
                                                    {!! Form::submit('Aprobar',['class' => 'btn btn-sm btn-success']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <span class="badge badge-primary">Aprobado</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <h2 class="text-center">Aspirantes</h2>
                            <div class="card card-default card-block h-100">
                                <div class="list-group pre-scrollable">
                                    @foreach($employees as $employee)
                                        <a href="{{route('employees.show', $employee->id)}}"
                                           class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{mb_convert_case($employee->user->name,MB_CASE_TITLE, "UTF-8")}}</h5>
                                                <small>{{\Carbon\Carbon::parse($employee->created_at)->format('M d')}}</small>
                                            </div>
                                            <p class="mb-1">{{mb_convert_case($employee->job->title,MB_CASE_TITLE, "UTF-8")}}</p>
                                            <div class="d-flex w-100 justify-content-between">
                                                <small>{{mb_convert_case($employee->job->company->name,MB_CASE_TITLE, "UTF-8")}}</small>
                                                @if(!$employee->approved)
                                                    {!! Form::model($employee,['route' => ['employees.update',
                                                    $employee->id], 'method'=>'put']) !!}
                                                    {!! Form::hidden('approved',1)!!}
                                                    {!! Form::submit('Aprobar',['class' => 'btn btn-sm btn-success']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <span class="badge badge-primary">Aprobado</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <hr>
                    <div class="row pb-5">
                        <h5 class="text-center col-12">Aquí puedes ver los ultimos empleos creados de empresas
                            validas</h5>
                        @foreach($jobs as $job)
                            <div class="col-md-3 col-12 pb-1">
                                @if($job->company->approved && $job->vacancies>0)
                                    <div class="card card-default">
                                        <div class="card-body">
                                            <h5 class="card-title mb-0">{{ucfirst(strtolower($job->title))}}</h5>
                                            <b class="card-subtitle mb-2 text-muted">{{$job->company->name}}</b>
                                            <br>
                                            <small class="card-text"><b>{{$job->vacancies}}</b> vacantes</small>
                                            <hr>
                                            <a href={{url("/jobs/{$job->id}")}} class="card-link">Ver</a>
                                            <a href={{url("/jobs/{$job->id}/edit")}} class="card-link">Editar</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>
                <!--/main-->

            </div>
            <!--/container-->
        </div>
    @else
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-4 mx-auto">
                <h1 class="font-weight-normal">Permisos</h1>
                <p class="lead font-weight-normal">No tienes permitido acceder a esta área.</p>
            </div>
        </div>
    @endif
@endsection
