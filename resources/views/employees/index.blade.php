@extends('layouts.app')

@section('content')
    @if(Auth::user()->isEmployee())
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-5 mx-auto">
                <h1 class="font-weight-normal mb-0">Encuentra trabajo</h1>
                <p class="lead font-weight-normal mb-0">El trabajo que buscas está
                    en {{ config('app.name', 'Ciudad Madero') }}
                    .</p>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @elseif(session('alert'))
                    <div class="alert alert-danger">
                        {{ session('alert') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row mb-2 pb-lg-2">
                @foreach($jobs as $job)
                    <div class="col-md-4 pb-lg-3 pb-2">
                        <div class="card flex-md-row mb-4 shadow-sm h-md-250 h-100">
                            <div class="card-body d-flex flex-column align-items-start">
                                <h4 class="mb-0">
                                    <strong class="d-inline-block mb-2 text-primary">{{ucwords(strtolower($job->company->name))}}</strong>
                                </h4>
                                <p class="mb-0 h6 text-muted">
                                    <small>Prof: </small>{{mb_convert_case($job->subTitle,MB_CASE_TITLE, "UTF-8")}}
                                </p>
                                <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($job->created_at)->format('M d')}}</div>
                                <b class="card-text mb-auto">
                                    <small>Puesto: </small>{{mb_convert_case($job->title,MB_CASE_TITLE, "UTF-8")}}</b>
                                {!! Form::open(['route' => 'employees.store']) !!}
                                {!! Form::hidden('companyId',$job->companyId)!!}
                                {!! Form::hidden('jobId',$job->id)!!}
                                {!! Form::hidden('userId', Auth::user()->id)!!}
                                {!! Form::submit('Aplicar',['class' => 'btn btn-sm btn-success']) !!}
                                {!! Form::close() !!}
                            </div>
                            <img class="card-img-right flex-auto d-none my-auto d-lg-block"
                                 style="width: 100px; height: 100px;"
                                 src="https://cdn2.iconfinder.com/data/icons/mixed-rounded-flat-icon/512/briefcase-512.png">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mb-2 pb-lg-5">
                <h5 class="col-12">Mis aplicaciones</h5>
                @foreach($myJobs as $myJob)
                    <div class="col-md-3">
                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                                <strong class="d-inline-block text-primary mb-0">{{ucwords(strtolower($myJob->company->name))}}</strong>
                                <p class="mb-0 text-muted">
                                    {{mb_convert_case($myJob->job->title,MB_CASE_TITLE, "UTF-8")}}
                                </p>
                                <div class="text-muted col-12">
                                    <span class="float-left">{{ \Carbon\Carbon::parse($myJob->created_at)->format('M d')}}</span>
                                    <span class="badge badge-primary badge-pill float-right">{{ucwords(strtolower($myJob->status))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-5 mx-auto">
                <h1 class="font-weight-normal">Permisos</h1>
                <p class="lead font-weight-normal">No tienes permitido acceder a esta área.</p>
            </div>
        </div>
    @endif
@endsection
