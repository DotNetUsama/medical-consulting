@extends('layouts.default')
<title>Register</title>
@section('content')
    <h2 class="text-center">Create New Account</h2>
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-4 col-md-offset-4 m-2 p-3 border border-secondary">
            @if(Session::has('danger'))
                <p class="alert alert-danger py-1">{{Session::get('danger')}}</p>
            @endif
            @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
            @endif
            <form action="{{ route('auth.register') }}" method="Post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input required type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Your Name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input required type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input required type="text" name="phone" class="form-control" id="phone" placeholder="Enter Your Phone Number">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input required type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Password Confirmation">
                </div>
                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                        {!! app('captcha')->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop
