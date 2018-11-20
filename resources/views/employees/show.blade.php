@extends('layouts.app')

@section('content')
    <div class="container my-auto mx-auto">
        <div class="row pb-5">
            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-header m-0" style="background:#680e1b;">
                        <h1 class="text-white text-center mb-0">{{$employee->job->title}}</h1>
                        <h5 class="text-white text-center mb-0">{{$employee->job->subTitle}}
                            en {{$employee->job->company->name}}</h5>
                    </div>
                    @if($user->info)
                        <div class="card-body text-center">
                            <div class="row">
                                @if($user->info->pictureUrl)
                                    <img class="img-fluid img-thumbnail col-4 mt-0 mb-0 mx-auto h-100" alt="profile-img"
                                         src={{$user->info->pictureUrl}}>
                                @endif
                                <div class="col-lg-6 col-12">
                                    <h1 class="card-title mt-4 mb-0">
                                        {{$user->name}}<br>
                                    </h1>
                                    <div class="card-text">
                                        <p class="mb-0"><i class="fa fa-phone"></i> {{$user->info->phone}}</p>
                                        <i class="fa fa-envelope"></i> <a
                                                href="mailto:{{$user->email}}">{{$user->email}}</a>
                                        <p class="mb-0"><i class="fa fa-map"></i> {{$user->info->address}}</p>
                                        <b>{{$user->info->profession}}</b> |
                                        <small>{{$user->info->civilStatus}}</small>
                                        <p>SS: {{$user->info->socialKey}} | RFC: {{$user->info->uniqueKey}}</p>
                                        @if($user->info->cvUrl)
                                            <a class="btn btn-sm btn-info mb-1" target="_blank"
                                               href={{$user->info->cvUrl}}><i
                                                        class="fa fa-eye"></i> Ver CV</a>
                                        @endif
                                        <div class="mt-5 justify-content-between">
                                            @if(Auth::user()->isEmployer())
                                                @if($employee->status == 'Pre-confirmación')
                                                    {!! Form::model($employee,['route' => ['employees.update', $employee->id], 'method'=>'put']) !!}
                                                    {!! Form::hidden('status', 'Confirmación')!!}
                                                    {!! Form::submit('Me gusta su perfil',['class' => 'btn btn-sm btn-primary float-right']) !!}
                                                    {!! Form::close() !!}
                                                @elseif($employee->status == 'Confirmación')
                                                    {!! Form::model($employee,['route' => ['employees.update', $employee->id], 'method'=>'put']) !!}
                                                    {!! Form::hidden('status', 'Entrevista')!!}
                                                    {!! Form::submit('Quiero entrevistar',['class' => 'btn btn-sm btn-primary float-right']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <p class="badge badge-danger">Ya has actualizado el
                                                        estado de éste aspirante, contáctalo.</p>
                                                @endif
                                            @endif
                                            <a href="{{route('home')}}" class="btn btn-sm btn-dark">Regresar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <h1 class="text-center">Usuario sin Información</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection