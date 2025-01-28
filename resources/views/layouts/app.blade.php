<!DOCTYPE html>
<html>
<head>
    <title>Task List App</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10
            hover:bg-slate-50
        }

        .link {
            @apply font-medium text-gray-700 underline decoration-pink-500
        }

        label {
            @apply block uppercase text-slate-700 mb-2
        }

        input, textarea {
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight
            focus:outline-none
        }

        .error {
            @apply text-red-500 text-sm
        }
    </style>
    {{-- blade-formatter-enable --}}

    @yield('styles')
</head>

<body class="container mx-auto mt-10 max-w-lg">
<h1 class="mb-4 text-2xl">@yield('title')</h1>

{{-- x-data and other x-literals are AlpineJS related, start by setting flash to true --}}
<div x-data="{ flash: true }">

    {{-- to check: getting session key-value pairs only accessible from app.blade.php? --}}
    @if(session()->has('success'))

        {{-- the nearest POSITIONed ancestor; taking this out means the X button would be positioned relative to the viewport --}}
        {{-- AlpineJS: show this div is flash is true (true as assigned above and by default on page load)--}}
        <div x-show="flash"
             class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
             role="alert">
            <strong class="font-bold">Success!</strong>
            <div>
                {{ session('success') }}
            </div>

            {{-- place the cross top-right by defining the CSS class, positioned relative to the nearest POSITIONed
            ancestor/parent, not to the viewport --}}
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
               stroke-width="1.5"
               {{-- listener which on click, sets flash to false, therefore hiding the flash message --}}
               @click="flash = false"
               stroke="currentColor" class="h-6 w-6 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </span>
        </div>
    @endif

    <div>
        @yield('content')
    </div>
</div>
</body>
</html>
