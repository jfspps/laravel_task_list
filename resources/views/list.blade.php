@extends('layouts.app')

@section('title', 'Task list')

@section('content')

    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}" class="font-medium text-gray-700 underline decoration-pink-500">Add
            task</a>
    </nav>

    @forelse($tasks as $theTask)
        {{--route() generates a URL; pass a key-value pair "id":"theTasksId" to the route with name tasks.show--}}
        <li><a href="{{ route('tasks.show', ['task' => $theTask->id]) }}"
                {{-- Always set the class font-bold, and 'line-through' only if the task is completed --}}
                @class(['font-bold', 'line-through' => $theTask->completed])>
                {{ $theTask->title }}
            </a>
        </li>
    @empty
        <div>No tasks presented</div>
    @endforelse

    @if($tasks->count())
        <br/>
        <nav class="mt-4">
            {{-- Establish a Previous and Next link between paginated lists, while also setting up page number
            parameters in the URL --}}
            {{ $tasks->links() }}
        </nav>
    @endif

@endsection
