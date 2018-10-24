@extends('layouts.app')

@section('content')
    <div class="position-relative overflow-hidden text-center bg-light">
        <div class="col-md-5 mx-auto">
            <h1 class="font-weight-normal">Encuentra trabajo</h1>
            <p class="lead font-weight-normal">El trabajo que buscas está en {{ config('app.name', 'Ciudad Madero') }}
                .</p>
        </div>
    </div>
    <div class="container">
        <div class="row mb-2 pb-lg-5">
            @foreach($jobs as $job)
                <div class="col-md-4">
                    <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                        <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-primary">{{$job->company->name}}</strong>
                            <h3 class="mb-0">
                                <a class="text-dark" href="#">{{$job->subTitle}}</a>
                            </h3>
                            <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($job->created_at)->format('M d')}}</div>
                            <p class="card-text mb-auto">{{$job->title}}</p>
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
    </div>
@endsection
