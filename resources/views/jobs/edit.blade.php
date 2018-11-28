@extends('layouts.app')

@section('content')
    @if((Auth::user()->isEmployer() && Auth::user()->employer)||(Auth::user()->isAdmin()))
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
                            <div >
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
                                        {!! Form::hidden('companyId', $job->companyId) !!}
                                        {!! Form::text('company', $job->company->name, ['disabled' => true, 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Empleador</label>
                                    <div class="col-sm-10">
                                        {!! Form::hidden('employerId', $job->employerId) !!}
                                        {!! Form::text('employer', $job->employer->user->name, ['disabled' => true, 'class' => 'form-control']) !!}
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
                                    <h5>Descripción de vacante a detalle:</h5>
                                    <div class="col-12">
                                        @if($job->info)
                                            <textarea name="skills" cols="30"
                                                      rows="10" required>{!!$job->info->skills!!}</textarea>
                                        @else
                                            <textarea name="skills" cols="30"
                                                      rows="10"
                                                      required>Este campo es obligatorio ser modificado</textarea>
                                        @endif
                                    </div>
                                </div>
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
                                <div class="row align-content-between">
                                    <div class="col">
                                        <a href="{{route('home')}}" class="btn btn-sm btn-dark">Cancelar</a>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-sm btn-dark">Editar</button>
                                    </div>
                                    @if(Auth::user()->isEmployer())
                                        <div class="modal fade" id="jobModal{{$job->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">¿Eliminar {{mb_convert_case($job->title,MB_CASE_TITLE, "UTF-8")}}?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <p class="mb-0">Profesión
                                                                deseada:
                                                                <b>{{mb_convert_case($job->subTitle,MB_CASE_TITLE, "UTF-8")}}</b>
                                                            </p>
                                                            <p class="mb-0">Empresa:
                                                                <b>{{mb_convert_case($job->company->name,MB_CASE_TITLE, "UTF-8")}}</b>
                                                            </p>
                                                            @if($job->info)
                                                                <span class="mb-0">Descipción de vacante:</span>
                                                                {!!$job->info->skills!!}
                                                            @endif
                                                        </div>
                                                        <small class="float-right">Publicado:
                                                            <b>{{ \Carbon\Carbon::parse($job->created_at)->format('M d')}}</b>
                                                        </small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark btn-sm"
                                                                data-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                        {!! Form::model($job, ['route'=> ['jobs.destroy', $job->id], 'method' => 'delete']) !!}
                                                        {!! Form::submit('Eliminar',['class' => 'btn btn-sm btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#jobModal{{$job->id}}">Eliminar
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-4 mx-auto my-4">
                <div class="card">
                    <img class="card-img-top"
                         src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,h_400/v1540658645/04_l6q5l3.jpg"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Permisos</h5>
                        <p class="card-text">No tienes permisos para acceder a esta parte.</p>
                        <a class="btn btn-primary" href={{route('home')}} >Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection