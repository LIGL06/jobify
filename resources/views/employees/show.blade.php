@extends('layouts.app')

@section('content')
    <div class="container my-auto mx-auto">
        <div class="row pb-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header p-5 bg-dark">
                        <h1 class="text-white text-center mb-0">{{$employee->job->title}}</h1>
                        <h5 class="text-white text-center mb-0">{{$employee->job->subTitle}}</h5>
                    </div>
                    @if($user->info)
                        <div class="card-body text-center">
                            <div class="row">
                                @if($user->info->pictureUrl)
                                    <img class="img-fluid img-thumbnail col-5 mt-0 mb-0 mx-auto" alt="profile-img"
                                         src={{$user->info->pictureUrl}}>
                                @endif
                                <div class="col-6">
                                    <h3 class="card-title mt-4 mb-0">
                                        {{$user->name}} <br>
                                    </h3>
                                    <div class="card-text">
                                        <small><i class="fa fa-phone"></i> {{$user->info->phone}}</small>
                                        |
                                        <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                        <p class="mb-0"><i class="fa fa-map"></i> {{$user->info->address}}</p>
                                        <b>{{$user->info->profession}}</b> |
                                        <small>{{$user->info->civilStatus}}</small>
                                        <p>SS: {{$user->info->socialKey}} | RFC: {{$user->info->uniqueKey}}</p>
                                        <a class="btn btn-sm btn-info mb-1" target="_blank" href={{$user->info->cvUrl}}><i
                                                    class="fa fa-eye"></i> Ver CV</a>
                                    </div>
                                    @if(!$employee->status)
                                        {!! Form::model($employee,['route' => ['employees.update', $employee->id], 'method'=>'put']) !!}
                                        {!! Form::hidden('status', 'preConfirmation')!!}
                                        {!! Form::submit('Me gusta su perfil',['class' => 'btn btn-lg btn-success float-right']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::model($employee,['route' => ['employees.update', $employee->id], 'method'=>'put']) !!}
                                        {!! Form::hidden('status', 'interview')!!}
                                        {!! Form::submit('Quiero entrevistar',['class' => 'btn btn-lg btn-danger float-right']) !!}
                                        {!! Form::close() !!}
                                    @endif
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