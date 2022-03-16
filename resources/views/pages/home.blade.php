@extends('layouts.default')
@section('content')
    <div class="justify-content-md-center">
        <div class="jumbotron">
            <h1 class="display-4">Hello, There!</h1>
            <p class="lead">
                Med Consulting App, It is an application that deals with several medical topics and allows users to request a consultation.
            </p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Consult Now!</a>
            </p>
        </div>
    </div>
    <div class="row">
        @foreach($topics as $topic)
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top border-bottom border-secondary" height="250" width="100"
                         src="{{ asset($topic->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $topic->title }}</h5>
                        <p class="card-text">
                            @if(strlen($topic->body) > 100)
                                {{ substr($topic->body, 0, 100) }}...
                            @else
                                {{ $topic->body }}
                            @endif
                        </p>
                        <a href="{{ route('topics.show', ['topic' => $topic->id]) }}" class="btn btn-primary">Read More!</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
