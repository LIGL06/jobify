@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-5">Crear empleador</h1>
                <div style="padding-bottom:100px">
                    {!! Form::open(['route'=>'employers.store']) !!}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Correo de usuario</label>
                        <div class="col-sm-10">
                            <input class="typeahead form-control" type="email" placeholder="Correo a buscar" name="email" autocomplete="off" id="usersAutocomplete">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Empresa</label>
                        <div class="col-sm-10">
                            <input class="typeahead form-control" type="text" placeholder="Empresa a buscar" name="company" autocomplete="off" id="companiesAutocomplete">
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