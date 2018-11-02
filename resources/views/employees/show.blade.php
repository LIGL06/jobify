@extends('layouts.app')

@section('content')
    <div class="container my-auto mx-auto">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header p-5 bg-dark">
                        <h5 class="display-4 text-white text-center mb-0">{{$employee->job->title}}</h5>
                        <h5 class="text-white text-center mb-0">{{$employee->job->subTitle}}</h5>
                    </div>
                    @if($user[0]->info)
                        <div class="card-body text-center">
                            @if($user[0]->info->pictureUrl)
                                <img class="img-fluid img-thumbnail col-2" alt="profile-img"
                                     src={{$user[0]->info->pictureUrl}}>
                            @endif
                            <h5 class="card-title mt-4 mb-0">
                                {{$user[0]->name}} <br>
                            </h5>
                            <div class="card-text">
                                <small><i class="fa fa-phone"></i> {{$user[0]->info->phone}}</small>
                                |
                                <a href="mailto:{{$user[0]->email}}">{{$user[0]->email}}</a>
                                <p class="mb-0"><i class="fa fa-map"></i> {{$user[0]->info->address}}</p>
                                <b>{{$user[0]->info->profession}}</b> |
                                <small>{{$user[0]->info->civilStatus}}</small>
                                <p>SS: {{$user[0]->info->socialKey}} | RFC: {{$user[0]->info->uniqueKey}}</p>
                            </div>
                            @if(!$employee->status)
                                {!! Form::model($employee,['route' => ['employees.update', $employee->id], 'method'=>'put']) !!}
                                {!! Form::hidden('status', 'preConfirmation')!!}
                                {!! Form::submit('Perfil concuerda con vacante',['class' => 'btn btn-sm btn-success']) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::model($employee,['route' => ['employees.update', $employee->id], 'method'=>'put']) !!}
                                {!! Form::hidden('status', 'interview')!!}
                                {!! Form::submit('Entrevistar',['class' => 'btn btn-sm btn-success']) !!}
                                {!! Form::close() !!}
                            @endif
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