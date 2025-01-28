{{--Need to get this HTML layout to match app.blade.php in order to inherit the template--}}
{{--convention: directory.bladePrefix--}}
@extends('layouts.app')

{{--let the section handle HTML tags, no @endsection needed--}}
@section('title', $task->title)

@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.list') }}" class="link">Return to task list</a>
    </nav>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    @isset($task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endisset
    {{-- Render the date relative to the present with diffForHumans() --}}
    <p class=" mb-4 text-sm text-slate-500">Created: {{ $task->created_at->diffForHumans() }}</p>
    <p class=" mb-4 text-sm text-slate-500">Updated: {{ $task->updated_at->diffForHumans() }}</p>

    <p class="mb-4">
        @if($task->completed)
            <span class="font-medium text-green-500">Status: Completed</span>
        @else
            <span class="font-medium text-red-500">Status: Not completed</span>
        @endif
    </p>

    <div class="flex gap-2">
        {{-- Laravel will assume the entity has a primary key and use that when mapping to the endpoint --}}
        <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="btn">
            Edit
        </a>

        <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
            @csrf
            @method('PUT')

            <button type="submit" class="btn">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}
            </button>
        </form>

        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">
                Delete
            </button>
        </form>
    </div>
@endsection

{{--Check the page source to see this template has a head and body element--}}
