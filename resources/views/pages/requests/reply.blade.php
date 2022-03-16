@extends('layouts.default')
<title>Make Reply</title>
@section('content')
    <h2 class="text-center">Make Reply On Request</h2>
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-4 col-md-offset-4 m-2 p-3 border border-secondary">
            @if(Session::has('danger'))
                <p class="alert alert-danger py-1">{{Session::get('danger')}}</p>
            @endif
            @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
            @endif
            <form action="{{ route('requests.reply', ['consultRequest' => $request->id]) }}" method="Post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="doctor-reply">Reply</label>
                    <textarea required name="doctor_reply" class="form-control" id="doctor-reply" aria-describedby="replyHelp" placeholder="Enter Reply"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop
