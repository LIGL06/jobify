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
                    <div class="card-header">Editar Perfil</div>
                    <div class="card-body">
                        @if(Auth::user()->isEmployee() && $user->info)
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <h1>{{Auth::user()->name}}</h1>
                                    </div>
                                </div>
                                {!! Form::model($user,['route' => ['updateProfile',$user->id], 'method'=>'put' ,'files' => true]) !!}
                                {!! Form::hidden('userInfoId', $user->info->id) !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center">
                                            <img class="avatar img-circle img-thumbnail" alt="avatar"
                                                 src={{Auth::user()->info->pictureUrl}}>
                                            <h6>Subir una foto...</h6>
                                            {{Form::file('image', ['class'=> 'text-center center-block file-upload', 'required' => true])}}
                                        </div>
                                    </div>
                                    <!--/col-sm-3-->
                                    <div class="col-8">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="fName"><h4>{{__('Nombre(s)')}}</h4></label>
                                                {!! Form::text('fName', $user->info->fName, ['class'=> 'form-control', 'placeholder' => 'Nombre(s)']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label for="lName"><h4>{{__('Apellido(s)')}}</h4></label>
                                                {!! Form::text('lName', $user->info->lName, ['class'=> 'form-control', 'placeholder' => 'Apellido(s)']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="fName"><h4>{{__('Teléfono')}}</h4></label>
                                                {{Form::text('phone', $user->info->phone, ['class'=> 'form-control','placeholder' => 'Teléfono móvil'])}}
                                            </div>
                                            <div class="col-6">
                                                <label for="lName"><h4>{{__('Correo electrónico')}}</h4></label>
                                                {!! Form::text('email', $user->email, ['class'=> 'form-control', 'placeholder' => 'Correo electrónico', 'readOnly'=> true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="doB"><h4>{{ __('Fecha nacimiento') }}</h4></label>
                                                {!! Form::date('doB', $user->info->doB, ['class'=> 'form-control', 'placeholder' => 'Fecha de nacimiento']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label for="doB"><h4>{{ __('Dirección') }}</h4></label>
                                                {!! Form::text('address', $user->info->address, ['class'=> 'form-control', 'placeholder' => 'Dirección']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/col-sm-9-->
                                </div><!--/row-->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('Profesión') }}</h4></label>
                                                {!! Form::text('profession', $user->info->profession, ['class'=> 'form-control', 'placeholder' => 'Profesión']) !!}
                                            </div>
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('CURP') }}</h4></label>
                                                {!! Form::text('uniqueKey', $user->info->uniqueKey, ['class'=> 'form-control', 'placeholder' => 'Clave unica de regitro poblacional']) !!}
                                            </div>
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('NSS') }}</h4></label>
                                                {!! Form::text('socialKey', $user->info->socialKey, ['class'=> 'form-control', 'placeholder' => 'Número de seguro social']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/col-sm-12-->
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('Estado civil') }}</h4></label>
                                                {{Form::select('civilStatus', ['casado' => 'Casado', 'soltero' => 'Soltero', 'otro'=> 'Otro'], $user->info->civilStatus, ['class'=> 'form-control','placeholder' => 'Seleccionar estado civil'])}}
                                            </div>
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('CV') }}</h4></label>
                                                {{Form::file('cv', ['class'=> 'form-control-file', 'required' => true])}}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/col-sm-12-->
                                    <div class="col-12">
                                        {!! Form::submit('Editar',['class' => 'btn btn-lg btn-success float-right']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div><!--/container-->
                        @endif
                        @if(Auth::user()->isEmployee() && !$user->info)
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <h1>{{Auth::user()->name}}</h1>
                                    </div>
                                </div>
                                {!! Form::model($user,['route' => ['createProfile'], 'method'=>'post']) !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center">
                                            <img class="avatar img-circle img-thumbnail" alt="avatar"
                                                 src=''>
                                            <h6>Subir una foto...</h6>
                                            {{Form::file('image', ['class'=> 'text-center center-block file-upload', 'required' => true])}}
                                        </div>
                                    </div>
                                    <!--/col-sm-3-->
                                    <div class="col-8">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="fName"><h4>{{__('Nombre(s)')}}</h4></label>
                                                {!! Form::text('fName', null, ['class'=> 'form-control', 'placeholder' => 'Nombre(s)']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label for="lName"><h4>{{__('Apellido(s)')}}</h4></label>
                                                {!! Form::text('lName', null, ['class'=> 'form-control', 'placeholder' => 'Apellido(s)']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="fName"><h4>{{__('Teléfono')}}</h4></label>
                                                {{Form::text('phone', null, ['class'=> 'form-control','placeholder' => 'Teléfono móvil'])}}
                                            </div>
                                            <div class="col-6">
                                                <label for="lName"><h4>{{__('Correo electrónico')}}</h4></label>
                                                {!! Form::text('email', $user->email, ['class'=> 'form-control', 'placeholder' => 'Correo electrónico', 'readOnly'=> true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="doB"><h4>{{ __('Fecha nacimiento') }}</h4></label>
                                                {!! Form::date('doB', null, ['class'=> 'form-control', 'placeholder' => 'Fecha de nacimiento']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label for="doB"><h4>{{ __('Dirección') }}</h4></label>
                                                {!! Form::text('address', null, ['class'=> 'form-control', 'placeholder' => 'Dirección']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/col-sm-9-->
                                </div><!--/row-->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('Profesión') }}</h4></label>
                                                {!! Form::text('profession', null, ['class'=> 'form-control', 'placeholder' => 'Profesión']) !!}
                                            </div>
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('CURP') }}</h4></label>
                                                {!! Form::text('uniqueKey', null, ['class'=> 'form-control', 'placeholder' => 'Clave unica de regitro poblacional']) !!}
                                            </div>
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('NSS') }}</h4></label>
                                                {!! Form::text('socialKey', null, ['class'=> 'form-control', 'placeholder' => 'Número de seguro social']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/col-sm-12-->
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('Estado civil') }}</h4></label>
                                                {{Form::select('civilStatus', ['casado' => 'Casado', 'soltero' => 'Soltero', 'otro'=> 'Otro'], null, ['class'=> 'form-control','placeholder' => 'Seleccionar estado civil'])}}
                                            </div>
                                            <div class="col-4">
                                                <label for="doB"><h4>{{ __('CV') }}</h4></label>
                                                {{Form::file('cv', ['class'=> 'form-control-file', 'required' => true])}}
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
                        @else
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <h1>{{Auth::user()->employer->company->name}}</h1>
                                    </div>
                                </div>
                                {!! Form::model($user,['route' => ['createCompanyProfile', Auth::user()->employer->company->id], 'method'=>'post']) !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center">
                                            <img class="avatar img-circle img-thumbnail" alt="avatar"
                                                 src=''>
                                            <h6>Subir un logo o foto de empresa...</h6>
                                            {{Form::file('image', ['class'=> 'text-center center-block file-upload', 'required' => true])}}
                                        </div>
                                    </div>
                                    <!--/col-sm-3-->
                                    <div class="col-8">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="fName"><h4>{{__('Empresa')}}</h4></label>
                                                {!! Form::text('companyName', Auth::user()->employer->company->name, ['class'=> 'form-control', 'placeholder' => 'Nombre Empresa']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label for="lName"><h4>{{__('Giro')}}</h4></label>
                                                {!! Form::text('comapanyRotation', Auth::user()->employer->company->rotation, ['class'=> 'form-control', 'placeholder' => 'Apellido(s)']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="fName"><h4>{{__('Teléfono corporativo')}}</h4></label>
                                                {{Form::text('companyPhone', Auth::user()->employer->company->phone, ['class'=> 'form-control','placeholder' => 'Teléfono móvil'])}}
                                            </div>
                                            <div class="col-6">
                                                <label for="lName"><h4>{{__('Contacto')}}</h4></label>
                                                {!! Form::text('companyContact', $user->name, ['class'=> 'form-control', 'placeholder' => 'Correo electrónico', 'readOnly'=> true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label for="doB"><h4>{{ __('Dirección') }}</h4></label>
                                                {!! Form::text('companyAddress', Auth::user()->employer->company->address, ['class'=> 'form-control', 'placeholder' => 'Fecha de nacimiento']) !!}
                                            </div>
                                            <div class="col-6">
                                                <label for="doB"><h4>{{ __('Correo corporativo') }}</h4></label>
                                                {!! Form::text('address', Auth::user()->employer->company->email, ['class'=> 'form-control', 'placeholder' => 'Dirección']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/col-sm-9-->
                                </div><!--/row-->
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection