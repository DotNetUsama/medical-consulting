@extends('layouts.default')
<title>Show Topic</title>
@section('content')
    <h2 class="text-center">{{ $topic->title }}</h2>
    <p class="text-center font-weight-light">
        Published At: {{ $topic->created_at }}, Views: {{ $topic->views }}
    </p>
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-5 col-md-offset-5 m-2 p-3">
            <div class="border-bottom border-secondary p-1">
                <img class="card-img-top" src="{{ asset($topic->image) }}" alt="Card image cap">
            </div>
            <div class="pt-2">
                {{ $topic->body }}
            </div>
            <div class="my-3">

                <a href="javascript:history.back()"><- Go Back</a>
            </div>
        </div>
    </div>
@stop
