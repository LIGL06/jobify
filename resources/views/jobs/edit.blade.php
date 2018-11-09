@extends('layouts.app')

@section('content')
    @if(Auth::user()->isEmployer() && Auth::user()->employer)
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-4 mx-auto">
                <h1 class="font-weight-normal mb-0">Empresas</h1>
                <p class="lead font-weight-normal mb-0">Tu panel de empleos en {{ config('app.name', 'Ciudad Madero') }}
                    .</p>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="col-md-1">
            </div>
        </div>
        <div class="container">
            <div class="row" style="padding-bottom:100px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Editar empleo</h1>
                            <div>
                                {!! Form::model($job, ['route'=> ['jobs.update', $job->id], 'method' => 'put']) !!}
                                {{Form::hidden('approved', true)}}
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('title', $job->title, ['class'=> 'form-control', 'placeholder' => 'Título de puesto']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Profesión</label>
                                    <div class="col-sm-10">
                                        <input class="typeahead form-control" type="text"
                                               placeholder="Profesión a buscar (sin acentos)"
                                               name="subTitle" autocomplete="off" id="jobsAutocomplete"
                                               value={{$job->subTitle}}>
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
                                        {!! Form::selectRange('vacancies', 1, 6, $job->vacancies, ['class'=> 'form-control']) !!}
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
                                        <button type="submit" class="btn btn-dark">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection