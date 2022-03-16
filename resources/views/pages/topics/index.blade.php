@extends('layouts.default')
<title>List of Topics</title>
@section('content')
        <h2 class="text-center">Available Medical Topics</h2>
        <div class="m-3">
            <h6><a href="{{ route('topics.create.form') }}">+create new topic</a></h6>
        </div>
        <div class="m-3">
            @if(Session::has('success'))
                <p class="alert alert-success py-1">{{Session::get('success')}}</p>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Created At</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($topics as $topic)
                    <tr>
                        <th scope="row">{{ $topic->id }}</th>
                        <td>{{ $topic->title }}</td>
                        <td>{{ $topic->category->name }}</td>
                        <td>
                            <img width="50" height="50" src="{{ $topic->image }}" alt="">
                        </td>
                        <td>{{ $topic->created_at }}</td>
                        <td>
                            <a href="{{ route('topics.delete', ['topic' => $topic->id]) }}">delete</a>
                            <a href="{{ route('topics.edit.form', ['topic' => $topic->id]) }}">update</a>
                            <a href="{{ route('topics.show', ['topic' => $topic->id]) }}">show</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@stop
