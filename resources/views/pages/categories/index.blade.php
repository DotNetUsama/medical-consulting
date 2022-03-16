@extends('layouts.default')
<title>List of Topics</title>
@section('content')
    <div class="m-3">
        <a href="{{ route('categories.create.form') }}">+create new category</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at }}</td>
                <td><a href="{{ route('categories.delete', ['category' => $category->id]) }}">delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
