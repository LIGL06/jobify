@extends('layouts.app')

@section('content')
    @if(Auth::user()->isEmployer() && Auth::user()->employer)
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-4 mx-auto">
                <h1 class="font-weight-normal">Empresas</h1>
                <p class="lead font-weight-normal">Tu panel de empleos {{ config('app.name', 'Ciudad Madero') }}
                    .</p>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row" style="padding-bottom:100px">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5>Tus empleos</h5>
                            <div>
                                <ul class="list-group">
                                    @foreach(Auth::user()->employer->company->jobs as $job)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{mb_convert_case($job->title,MB_CASE_TITLE, "UTF-8")}}
                                            <span class="badge badge-primary badge-pill">{{Count($job->employees)}}
                                                aplicantes</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5>Tus aplicantes</h5>
                            <div>
                                <ul class="list-group">
                                    @foreach($myEmployees as $employee)
                                        <a href={{route('employees.show', $employee->id)}} class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-0">{{$employee->name}}</h5>
                                            </div>
                                            <p class="mb-0">Empleo: {{mb_convert_case($employee->title,MB_CASE_TITLE, "UTF-8")}}</p>
                                            <small class="text-muted">Profesión deseada: {{mb_convert_case($employee->subTitle,MB_CASE_TITLE, "UTF-8")}}</small>
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-22">
                    <div class="card">
                        <div class="card-body">
                            <h1>Crear empleo</h1>
                            <div>
                                {!! Form::open(['route'=>'jobs.store']) !!}
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('title', null, ['class'=> 'form-control', 'placeholder' => 'Título de puesto']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Profesión</label>
                                    <div class="col-sm-10">
                                        <input class="typeahead form-control" type="text"
                                               placeholder="Profesión a buscar (sin acentos)"
                                               name="subTitle" autocomplete="off" id="jobsAutocomplete">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Empresa</label>
                                    <div class="col-sm-10">
                                        {!! Form::hidden('companyId', (Auth::user()->employer->company->id)) !!}
                                        {!! Form::text('Empresa', (Auth::user()->employer->company->name), ['disabled' => true, 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Empleador</label>
                                    <div class="col-sm-10">
                                        {!! Form::hidden('employerId', (Auth::user()->employer->id)) !!}
                                        {!! Form::text('Empresa', (Auth::user()->name), ['disabled' => true, 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">N° vacantes</label>
                                    <div class="col-sm-10">
                                        {!! Form::selectRange('vacancies', 1, 6, null, ['class'=> 'form-control']) !!}
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sex" id="gridRadios1"
                                                       value="masculino">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Femenino
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sex" id="gridRadios2"
                                                       value="femenino">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Masculino
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sex" id="gridRadios2"
                                                       value="indistinto" required>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Indistinto
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-2">Urgente</div>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            {!! Form::checkbox('required', '1', true) !!}
                                            <label class="form-check-label">
                                                Esta vacante es requerida con urgencia
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(!Auth::user()->employer)
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-4 mx-auto my-4">
                <div class="card">
                    <img class="card-img-top"
                         src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,h_400/v1540658645/04_l6q5l3.jpg"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Permisos</h5>
                        <p class="card-text">Perece ser que aún no te has registrado a una empresa.</p>
                        <a href={{route('companies.create')}} class="btn btn-primary">Registrar Empresa</a>
                    </div>
                </div>
            </div>
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