@extends('layouts.app')

@section('title', 'Add task')

@section('styles')
    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')
    {{--    list all Laravel errors here --}}
{{--    {{ $errors }}--}}
    <form method="POST" action="{{ route('tasks.store') }}">
        {{--Laravel middleware builds templates that protect against cross-site request forgery attacks --}}
        @csrf
        <div>
            <label for="title">
                Task title
            </label>
            <input name="title" id="title"/>
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
            <textarea name="description" id="description" rows="5"></textarea>
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
            <textarea name="long_description" id="long_description" rows="10"></textarea>
        </div>
        @error('long_description')
        <p class="error-message">
            {{ $message }}
        </p>
        @enderror

        <div>
            <button type="submit">Add task</button>
        </div>
    </form>
@endsection
