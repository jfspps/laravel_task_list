<!DOCTYPE html>
<html>
<head>
    <title>Task List App</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    @yield('styles')
</head>

<body class="container mx-auto mt-10 max-w-lg">
<h1 class="mb-4 text-2xl">@yield('title')</h1>

{{-- to check: getting session key-value pairs only accessible from app.blade.php? --}}
@if(session()->has('success'))
    <div style="color: green; font-size: 0.8rem; background: lightgreen">
        {{ session('success') }}
    </div>
    <br/>
@endif

<div>
    @yield('content')
</div>
</body>
</html>
