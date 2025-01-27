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

    <div>
        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection

{{--Check the page source to see this template has a head and body element--}}
