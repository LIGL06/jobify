@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" style="padding-bottom:120px">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Editar Perfil</div>
                    <div class="card-body">
                        @if($user->info)
                            {!! Form::model($user,['route' => ['updateProfile',$user->id], 'method'=>'put']) !!}
                            {!! Form::hidden('userInfoId', $user->info->id) !!}
                            <div class="form-group row">
                                <label for="fName" class="col-md-2 col-form-label text-md-right">Nombre(s)</label>
                                <div class="col-md-4">
                                    {!! Form::text('fName', $user->info->fName, ['class'=> 'form-control', 'placeholder' => 'Nombre(s)']) !!}
                                </div>

                                <label for="lName" class="col-md-2 col-form-label text-md-right">Apellidos(s)</label>
                                <div class="col-md-4">
                                    {!! Form::text('lName', $user->info->lName, ['class'=> 'form-control', 'placeholder' => 'Apellido(s)']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Correo') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('email', $user->email, ['class'=> 'form-control', 'placeholder' => 'Correo electrónico', 'readOnly'=> true]) !!}
                                </div>
                                <label for="doB"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Fecha nacimiento') }}</label>
                                <div class="col-md-4">
                                    {!! Form::date('doB', $user->info->doB, ['class'=> 'form-control', 'placeholder' => 'Fecha de nacimiento']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Dirección') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('address', $user->info->address, ['class'=> 'form-control', 'placeholder' => 'Dirección']) !!}
                                </div>
                                <label for="profession"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Profesión') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('profession', $user->info->profession, ['class'=> 'form-control', 'placeholder' => 'Profesión']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="uniqueKey"
                                       class="col-md-2 col-form-label text-md-right">{{ __('CURP') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('uniqueKey', $user->info->uniqueKey, ['class'=> 'form-control', 'placeholder' => 'Clave unica de regitro poblacional']) !!}
                                </div>
                                <label for="socialKey"
                                       class="col-md-2 col-form-label text-md-right">{{ __('NSS') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('socialKey', $user->info->socialKey, ['class'=> 'form-control', 'placeholder' => 'Número de seguro social']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="civilStatus"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Estado Civil') }}</label>
                                <div class="col-md-4">
                                    {{Form::select('civilStatus', ['casado' => 'Casado', 'soltero' => 'Soltero', 'otro'=> 'Otro'], $user->info->civilStatus, ['class'=> 'form-control','placeholder' => 'Seleccionar estado civil'])}}
                                </div>
                                <label for="phone"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                                <div class="col-md-4">
                                    {{Form::text('phone', $user->info->phone, ['class'=> 'form-control','placeholder' => 'Teléfono móvil'])}}
                                </div>
                            </div>

                            <div class="form-group row mb-0 float-right">
                                <div class="col-md-2">
                                    {!! Form::submit('Editar',['class' => 'btn btn-lg btn-success']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @else
                            {!! Form::model($user,['route' => ['createProfile'], 'method'=>'post']) !!}
                            <div class="form-group row">
                                <label for="fName" class="col-md-2 col-form-label text-md-right">Nombre(s)</label>
                                <div class="col-md-4">
                                    {!! Form::text('fName', $user->name, ['class'=> 'form-control', 'placeholder' => 'Nombre(s)' , 'required']) !!}
                                </div>

                                <label for="lName" class="col-md-2 col-form-label text-md-right">Apellidos(s)</label>
                                <div class="col-md-4">
                                    {!! Form::text('lName', null, ['class'=> 'form-control', 'placeholder' => 'Apellido(s)' , 'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Correo') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('email', null, ['class'=> 'form-control', 'placeholder' => 'Correo electrónico', 'readOnly'=> true , 'required']) !!}
                                </div>
                                <label for="doB"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Fecha nacimiento') }}</label>
                                <div class="col-md-4">
                                    {!! Form::date('doB', \Carbon\Carbon::now(), ['class'=> 'form-control', 'placeholder' => 'Fecha de nacimiento' , 'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Dirección') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('address', null, ['class'=> 'form-control', 'placeholder' => 'Dirección', 'required']) !!}
                                </div>
                                <label for="profession"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Profesión') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('profession', null, ['class'=> 'form-control', 'placeholder' => 'Profesión', 'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="uniqueKey"
                                       class="col-md-2 col-form-label text-md-right">{{ __('CURP') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('uniqueKey', null, ['class'=> 'form-control', 'placeholder' => 'Clave unica de regitro poblacional', 'required']) !!}
                                </div>
                                <label for="socialKey"
                                       class="col-md-2 col-form-label text-md-right">{{ __('NSS') }}</label>
                                <div class="col-md-4">
                                    {!! Form::text('socialKey', null, ['class'=> 'form-control', 'placeholder' => 'Número de seguro social', 'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="civilStatus"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Estado Civil') }}</label>
                                <div class="col-md-4">
                                    {{Form::select('civilStatus', ['casado' => 'Casado', 'soltero' => 'Soltero', 'otro'=> 'Otro'], null, ['class'=> 'form-control','placeholder' => 'Seleccionar estado civil', 'required'])}}
                                </div>
                                <label for="phone"
                                       class="col-md-2 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                                <div class="col-md-4">
                                    {{Form::text('phone', null, ['class'=> 'form-control','placeholder' => 'Teléfono móvil', 'required'])}}
                                </div>
                            </div>

                            <div class="form-group row mb-0 float-right">
                                <div class="col-md-2">
                                    {!! Form::submit('Editar',['class' => 'btn btn-lg btn-success']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection