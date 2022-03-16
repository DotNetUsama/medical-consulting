@extends('layouts.default')
<title>Edit Topic</title>
@section('content')
    <h2 class="text-center">Edit Medical Topic</h2>
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-4 col-md-offset-4 m-2 p-3 border border-secondary">
            @if(Session::has('danger'))
                <p class="alert alert-danger py-1">{{Session::get('danger')}}</p>
            @endif
            @if($errors->any())
                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
            @endif
            <form enctype="multipart/form-data" action="{{ route('topics.edit', ['topic' => $topic->id]) }}" method="post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input required type="text" value="{{ $topic->title }}" name="title" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter Topic Title">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" id="category">
                        @foreach($categories as $category)
                            <option @if($topic->category->id === $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" value="{{ $topic->image }}" name="image" class="form-control" id="image" placeholder="Upload Image">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea required name="body" class="form-control" id="body" placeholder="Enter Topic Body">
                        {{ $topic->body }}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@stop
