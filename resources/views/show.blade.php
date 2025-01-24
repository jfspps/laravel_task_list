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

    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>
@endsection

{{--Check the page source to see this template has a head and body element--}}
