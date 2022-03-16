@extends('layouts.default')
<title>Show Consulting Request</title>
@section('content')
    <h2 class="text-center">Consulting Request Details </h2>
    <p class="text-center font-weight-light">
        Created At: {{ $request->created_at }},
        By: {{ $request->user->name }},
        Age: {{ $request->age }},
        Gender: {{ $request->gender }}.
        @if(auth()->user()->hasRole('admin'))
            <strong><a href="{{ route('requests.reply.form', ['consultRequest' => $request->id]) }}">Reply</a></strong>
        @endif
    </p>
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-5 col-md-offset-5 m-2 border border-secondary">
            <div class="pt-2">
                <p>
                    <strong>Consulting Address:</strong> {{ $request->consult_address }}
                </p>
            </div>
            <div class="pt-2">
                <p>
                    <strong>Medical History:</strong> {{ $request->medical_history }}
                </p>
            </div>
            <div class="pt-2">
                <p>
                    <strong>Consulting Text:</strong> {{ $request->consulting_text }}
                </p>
            </div>
            @if($request->doctor_reply)
                <div class="pt-2">
                    <p>
                        <strong>Reply:</strong> {{ $request->doctor_reply }}
                    </p>
                </div>
            @endif
            <div class="my-3">
                <a href="javascript:history.back()"><- Go Back</a>
            </div>
        </div>
    </div>
@stop
