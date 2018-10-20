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
                        <label class="col-sm-2 col-form-label">Especialización</label>
                        <div class="col-sm-10">
                            {!! Form::select('subdescription', ['contable','adminitrativo','otro'], null, ['id'=>'subdescription','class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Empresa</label>
                        <div class="col-sm-10">
                            {!! Form::select('email', $companies, null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">N° vacantes</label>
                        <div class="col-sm-10">
                            {!! Form::select('vacancies', [1,2,3,5,6], null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Requerido/Urgente</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                {!! Form::checkbox('noPenalties', '1', true) !!}
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