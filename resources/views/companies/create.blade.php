@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-5">Crear empresa</h1>
                <div style="padding-bottom:100px">
                    {!! Form::open(['route'=>'companies.store']) !!}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            {!! Form::text('name', null, ['class'=> 'form-control', 'placeholder' => 'Nombre de empresa']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Giro</label>
                        <div class="col-sm-10">
                            {!! Form::text('rotation', null, ['class'=> 'form-control', 'placeholder' => 'Giro de empresa' ]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Teléfono</label>
                        <div class="col-sm-10">
                            {!! Form::text('phone', null, ['class'=> 'form-control','placeholder' => 'Teléfono de empresa']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Correo electrónico</label>
                        <div class="col-sm-10">
                            {!! Form::email('email', null, ['class'=> 'form-control','placeholder' => 'Email de empresa']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Dirección</label>
                        <div class="col-sm-10">
                            {!! Form::text('address', null, ['class'=> 'form-control','placeholder' => 'Domicilio de empresa']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Observaciones</label>
                        <div class="col-sm-10">
                            {!! Form::text('observations', null, ['class'=> 'form-control','placeholder' => 'Observaciones de empresa']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Contacto</label>
                        <div class="col-sm-10">
                            {!! Form::text('contact', Auth::user()->name, ['class'=> 'form-control','placeholder' => 'Contacto en empresa']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Operador de franquicias</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                {!! Form::checkbox('parent', '1', true) !!}
                                <label class="form-check-label">
                                    Esta empresa tiene varias franquicias
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Antecedentes no penales</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                {!! Form::checkbox('noPenalties', '1', true) !!}
                                <label class="form-check-label">
                                    Se solicita carta de antecedentes no penales
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-content-between">
                        <div class="col">
                            <a href="{{route('home')}}" class="btn btn-dark">Cancelar</a>
                        </div>
                        @if(Auth::user()->isEmployer() || Auth::user()->isAdmin())
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection