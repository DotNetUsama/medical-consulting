<!doctype html>
<html lang="">
<head>
    <title></title>
    @include('includes.head')
</head>
<body>
<div class="container-fluid">
    @if(auth()->user() && auth()->user()->hasRole('admin'))
        <div class="mb-3">
            @include('includes.admin_header')
        </div>
    @else
        <div class="mb-3">
            @include('includes.header')
        </div>
    @endif
    <div class="m-1">
        @yield('content')
    </div>
    <div class="mt-3">
        @include('includes.footer')
    </div>
</div>
</body>
</html>
