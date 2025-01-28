<!DOCTYPE html>
<html>
<head>
    <title>Task List App</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10
            hover:bg-slate-50
        }

        .link {
            @apply font-medium text-gray-700 underline decoration-pink-500
        }
    </style>
    {{-- blade-formatter-enable --}}

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
