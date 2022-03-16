@extends('layouts.default')
<title>List of Consulting Requests</title>
@section('content')
    <h2 class="text-center">Consulting Requests</h2>
    <div class="m-3">
        @if(Session::has('success'))
            <p class="alert alert-success py-1">{{Session::get('success')}}</p>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Consulting Text</th>
                <th scope="col">Created At</th>
                <th scope="col">Replied</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <th scope="row">{{ $request->id }}</th>
                    <td>{{ $request->age }}</td>
                    <td>{{ $request->gender }}</td>
                    <td>
                        @if(strlen($request->consulting_text) > 50)
                            {{ substr($request->consulting_text, 0, 50) }}...
                        @else
                            {{ $request->consulting_text }}
                        @endif
                    </td>
                    <td>{{ $request->created_at }}</td>
                    <td>
                        @if($request->doctor_reply)
                            <p class="text-success">Replied</p>
                        @else
                            <p class="text-danger">No Replied</p>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('requests.show', ['request' => $request->id]) }}">show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
