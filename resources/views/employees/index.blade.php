@extends('layouts.app')

@section('content')
    @if(Auth::user()->isEmployee() && Auth::user()->info)
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-4 mx-auto">
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
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 offset-5">
                            <span>Ordenar por:
                                <a class="btn btn-sm" href="{{ Request::fullUrlWithQuery(['sort' => 'id']) }}">Fecha</a>
                                <a class="btn btn-sm" href="{{ Request::fullUrlWithQuery(['sort' => 'subTitle']) }}">Profesión</a>
                                <a class="btn btn-sm" href="{{ Request::url() }}">Título</a>
                            </span>
                        </div>
                        @foreach($jobs as $job)
                            @if(!Auth::user()->info)
                                <div class="col-12 text-center">
                                    <b>{{__('Parece ser que no has creado tu perfil, debes hacerlo para poder aplicar a oportunidades.')}}</b>
                                </div>
                            @endif
                            <div class="col-md-4 pb-lg-3 pb-2">
                                <div class="card flex-md-row mb-4 shadow-sm h-md-250 h-100">
                                    <div class="card-body d-flex flex-column align-items-start">
                                        <h5 class="mb-0">
                                            <strong class="d-inline-block mb-2 text-primary">{{ucwords(strtoupper($job->company->name))}}</strong>
                                        </h5>
                                        <p class="mb-0 h6 text-muted">
                                            {{mb_convert_case($job->subTitle,MB_CASE_TITLE, "UTF-8")}}
                                        </p>
                                        <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($job->created_at)->format('M d')}}</div>
                                        <b class="card-text mb-auto">
                                            {{mb_convert_case($job->title,MB_CASE_TITLE, "UTF-8")}}</b>
                                        @if(Auth::user()->info)
                                            {!! Form::open(['route' => 'employees.store']) !!}
                                            {!! Form::hidden('companyId',$job->companyId)!!}
                                            {!! Form::hidden('jobId',$job->id)!!}
                                            {!! Form::hidden('userId', Auth::user()->id)!!}
                                            {!! Form::submit('Aplicar',['class' => 'btn btn-sm btn-success']) !!}
                                            {!! Form::close() !!}
                                        @else
                                            <a class="btn btn-sm btn-danger" href={{route('createProfile')}}>Crear
                                                perfil</a>
                                        @endif
                                    </div>
                                    @if(!$job->company->bgPictureUrl)
                                        <img class="card-img-right flex-auto d-none my-auto d-lg-block"
                                             style="width: 100px; height: 100px;"
                                             src="https://cdn2.iconfinder.com/data/icons/mixed-rounded-flat-icon/512/briefcase-512.png">
                                    @else
                                        <img class="card-img-right flex-auto d-none my-auto d-lg-block"
                                             style="width: 100px; height: 100px;"
                                             src={{$job->company->bgPictureUrl}}>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $jobs->appends(Request::query())->render() }}
                </div>
            </div>
            <div class="row mb-2 pb-lg-5">
                <h5 class="col-12">Mis aplicaciones</h5>
                @foreach($myJobs as $myJob)
                    <div class="col-md-3">
                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                                <strong class="d-inline-block text-primary mb-0">{{ucwords(strtoupper($myJob->company->name))}}</strong>
                                <p class="mb-0 text-muted">
                                    {{mb_convert_case($myJob->job->title,MB_CASE_TITLE, "UTF-8")}}
                                </p>
                                <div class="text-muted col-12">
                                    <span class="float-left">{{ \Carbon\Carbon::parse($myJob->created_at)->format('M d')}}</span>
                                    <span class="badge badge-primary badge-pill float-right">{{mb_convert_case($myJob->status,MB_CASE_TITLE, "UTF-8")}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @elseif(!Auth::user()->employer)
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-4 mx-auto my-4">
                <div class="card">
                    <img class="card-img-top"
                         src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,h_400/v1540658645/04_l6q5l3.jpg"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Permisos</h5>
                        <p class="card-text">Perece ser que aún no tienes tu perfil.</p>
                        <a class="btn btn-primary" href={{route('createProfile')}} >Crear perfil</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="position-relative overflow-hidden text-center bg-light">
            <div class="col-md-4 mx-auto">
                <h1 class="font-weight-normal">Permisos</h1>
                <p class="lead font-weight-normal">No tienes permitido acceder a esta área.</p>
            </div>
        </div>
    @endif
@endsection