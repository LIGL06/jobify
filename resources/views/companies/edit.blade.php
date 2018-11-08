@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md" style="padding-bottom:120px">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Editar Empresa</div>
                    <div class="card-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h1>{{Auth::user()->employer->company->name}}</h1>
                                </div>
                            </div>
                            {!! Form::model($user,['route' => ['companies.update', Auth::user()->employer->company->id], 'method'=>'put', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="text-center">
                                        <img class="avatar img-circle img-thumbnail" alt="avatar"
                                             src={{Auth::user()->employer->company->bgPictureUrl}}>
                                        <h6>Subir un logo o foto...</h6>
                                        {{Form::file('image', ['class'=> 'text-center center-block file-upload', 'required' => true])}}
                                    </div>
                                </div>
                                <!--/col-sm-3-->
                                <div class="col-8">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label for="fName"><h4>{{__('Nombre')}}</h4></label>
                                            {!! Form::text('name', Auth::user()->employer->company->name, ['class'=> 'form-control', 'placeholder' => 'Nombre de empresa']) !!}
                                        </div>
                                        <div class="col-6">
                                            <label for="lName"><h4>{{__('Giro')}}</h4></label>
                                            {!! Form::text('rotation', Auth::user()->employer->company->rotation, ['class'=> 'form-control', 'placeholder' => 'Giro de empresa' ]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label for="fName"><h4>{{__('Teléfono')}}</h4></label>
                                            {!! Form::text('phone', Auth::user()->employer->company->phone, ['class'=> 'form-control','placeholder' => 'Teléfono de empresa']) !!}
                                        </div>
                                        <div class="col-6">
                                            <label for="lName"><h4>{{__('Contacto')}}</h4></label>
                                            {!! Form::text('contact', Auth::user()->name, ['class'=> 'form-control','placeholder' => 'Contacto en empresa','readOnly'=>true]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label for="doB"><h4>{{ __('Correo electrónico') }}</h4></label>
                                            {!! Form::email('email', Auth::user()->employer->company->email, ['class'=> 'form-control','placeholder' => 'Email de empresa']) !!}
                                        </div>
                                        <div class="col-6">
                                            <label for="doB"><h4>{{ __('Dirección') }}</h4></label>
                                            {!! Form::text('address', Auth::user()->employer->company->address, ['class'=> 'form-control','placeholder' => 'Domicilio de empresa']) !!}
                                        </div>
                                    </div>
                                </div>
                                <!--/col-sm-9-->
                            </div><!--/row-->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label for="doB"><h4>{{ __('Observaciones') }}</h4></label>
                                            {!! Form::text('observations', Auth::user()->employer->company->observations, ['class'=> 'form-control','placeholder' => 'Observaciones de empresa']) !!}
                                        </div>

                                    </div>
                                </div>
                                <!--/col-sm-12-->
                                <div class="col-12">
                                    {!! Form::submit('Editar',['class' => 'btn btn-lg btn-success float-right']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection