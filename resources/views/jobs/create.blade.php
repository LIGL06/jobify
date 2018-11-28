@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-5">Crear empleo</h1>
                <div style="padding-bottom:100px">
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
                                   placeholder="Profesión a buscar (sin acentos)" name="subTitle" autocomplete="off"
                                   id="jobsAutocomplete">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Empresa</label>
                        <div class="col-sm-10">
                            <select name="companyId" class="form-control">
                                <option selected disabled>Elegir empresa</option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Empleador</label>
                        <div class="col-sm-10">
                            <select name="employerId" class="form-control">
                                <option selected disabled>Elegir Empleador</option>
                                @foreach($employers as $employer)
                                    <option value="{{$employer->id}}">{{$employer->user->name}}
                                        - {{$employer->company->name}}</option>
                                @endforeach
                            </select>
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
                        <h5>Descripción de vacante a detalle:</h5>
                        <div class="col-12">
                                <textarea name="skills" cols="30"
                                          rows="10" required>Este campo es obligatorio ser modificado</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Requerido/Urgente</div>
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
@endsection