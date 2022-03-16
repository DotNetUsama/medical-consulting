@extends('layouts.default')
<title>Login</title>
@section('content')
    <h2 class="text-center">Login</h2>
    <h6 class="text-center">admin email: admin@med-consulting.org</h6>
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-4 col-md-offset-4 m-2 p-3 border border-secondary">
            @if(Session::has('danger'))
                <p class="alert alert-danger py-1">{{Session::get('danger')}}</p>
            @endif
            @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
            @endif
            <form action="{{ route('auth.login') }}" method="Post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input required type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop
