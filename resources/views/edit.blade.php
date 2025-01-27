@extends('layouts.app')

@section('title', 'Edit task')

@section('styles')
    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}">
        @csrf
        {{-- HTML forms only support GET and POST; apply method spoofing with @method: redirect to a route with PUT instead of POST --}}
        @method('PUT')
        <div>
            <label for="title">
                Task title
            </label>
            <input name="title" id="title" value="{{ $task->title }}"/>
        </div>

        @error('title')
        <p class="error-message">
            {{ $message }}
        </p>
        @enderror

        <div>
            <label for="description">
                Description
            </label>
            <textarea name="description" id="description" rows="5">
                {{ $task->description }}
            </textarea>
        </div>
        @error('description')
        <p class="error-message">
            {{ $message }}
        </p>
        @enderror

        <div>
            <label for="long_description">
                Long description
            </label>
            <textarea name="long_description" id="long_description" rows="10">
                {{ $task->long_description }}
            </textarea>
        </div>
        @error('long_description')
        <p class="error-message">
            {{ $message }}
        </p>
        @enderror

        <div>
            <button type="submit">Edit task</button>
        </div>
    </form>
@endsection
