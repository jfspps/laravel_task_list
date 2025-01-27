<!DOCTYPE html>
<html>
<head>
    <title>Task List App</title>
    @yield('styles')
</head>

<body>
<h1>@yield('title')</h1>

{{-- to check: getting session key-value pairs only accessible from app.blade.php? --}}
@if(session()->has('success'))
    <div style="color: green; font-size: 0.8rem; background: lightgreen">
        {{ session('success') }}
    </div>
@endif

<div>
    @yield('content')
</div>
</body>
</html>
