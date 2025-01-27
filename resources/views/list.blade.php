@extends('layouts.app')

@section('title', 'Task list')

@section('content')
    @forelse($tasks as $theTask)
        {{--route() generates a URL; pass a key-value pair "id":"theTasksId" to the route with name tasks.index--}}
        <li><a href="{{ route('tasks.index', ['task' => $theTask->id]) }}">{{ $theTask->title }}</a></li>
    @empty
        <div>No tasks presented</div>
    @endforelse
@endsection
