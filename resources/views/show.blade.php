{{--Need to get this HTML layout to match app.blade.php in order to inherit the template--}}
{{--convention: directory.bladePrefix--}}
@extends('layouts.app')

{{--let the section handle HTML tags, no @endsection needed--}}
@section('title', $task->title)

@section('content')
    <p>{{ $task->description }}</p>

    @isset($task->long_description)
        <p>{{ $task->long_description }}</p>
    @endisset

    <p>Created at: {{ $task->created_at }}</p>
    <p>Updated at: {{ $task->updated_at }}</p>

    <p>
        @if($task->completed)
            Status: Completed
        @else
            Status: Not completed
        @endif
    </p>

    <div>
        {{-- Laravel will assume the entity has a primary key and use that when mapping to the endpoint --}}
        <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
        <br/>
        <br/>
    </div>

    <div>
        <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
            @csrf
            @method('PUT')

            <button type="submit">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}
            </button>
        </form>
        <br/>
    </div>

    <div>
        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection

{{--Check the page source to see this template has a head and body element--}}
