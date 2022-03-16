@extends('layouts.default')
<title>New Consulting Request</title>
@section('content')
    <h2 class="text-center">Create New Consulting Request</h2>
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-4 col-md-offset-4 m-2 p-3 border border-secondary">
            @if(Session::has('danger'))
                <p class="alert alert-danger py-1">{{Session::get('danger')}}</p>
            @endif
            @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
            @endif
            <form action="{{ route('requests.create') }}" method="Post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="consulting-address">Consulting Address</label>
                    <input required type="text" name="consult_address" class="form-control" id="consulting-address" aria-describedby="addressHelp" placeholder="Enter Address">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input required type="text" name="age" class="form-control" id="age" aria-describedby="ageHelp" placeholder="Enter Your Age">
                </div>
                <div class="form-group">
                    <label for="medical-history">Medical History</label>
                    <textarea required name="medical_history" class="form-control" id="medical-history" placeholder="Enter Your Medical History"></textarea>
                </div>
                <div class="form-group">
                    <label for="consulting-text">Consulting Text</label>
                    <textarea required name="consulting_text" class="form-control" id="consulting-text" placeholder="Enter Your Consulting Text"></textarea>
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
