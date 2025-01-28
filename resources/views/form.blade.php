@extends('layouts.app')

@section('title', isset($task) ? 'Edit task' : 'Add task')

@section('content')
    {{--    list all Laravel errors here --}}
    {{--    {{ $errors }}--}}
    <form method="POST"
          action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        {{--Laravel middleware builds templates that protect against cross-site request forgery attacks --}}
        @csrf

        @isset($task)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="title">
                Task title
            </label>

            {{-- HTML form POST only: get Laravel to recall valid data entry; use current title if not null (i.e. when
             updating) and any valid title prior to form submission --}}
            <input name="title" id="title"
                   @class(['border-red-500' => $errors->has('title')])
                   value="{{ $task->title ?? old('title') }}"/>
        </div>

        @error('title')
        <p class="error">
            {{ $message }}
        </p>
        @enderror

        <div class="mb-4">
            <label for="description">
                Description
            </label>

            {{-- HTML form POST only: get Laravel to recall valid data entry --}}
            <textarea name="description" id="description" rows="5"
            @class(['border-red-500' => $errors->has('description')])>
                {{ $task->description ?? old('description') }}
            </textarea>
        </div>
        @error('description')
        <p class="error">
            {{ $message }}
        </p>
        @enderror

        <div class="mb-4">
            <label for="long_description">
                Long description
            </label>

            {{-- HTML form POST only: get Laravel to recall valid data entry --}}
            <textarea name="long_description" id="long_description" rows="10"
            @class(['border-red-500' => $errors->has('long_description')])>
                {{ $task->long_description ?? old('long_description') }}
            </textarea>
        </div>
        @error('long_description')
        <p class="error">
            {{ $message }}
        </p>
        @enderror

        <div class="flex gap-2 items-center">
            <button type="submit" class="btn">
                @isset($task)
                    Update task
                @else
                    Add task
                @endisset
            </button>
            <a href="{{ route('tasks.list') }}" class="link">Cancel</a>
        </div>
    </form>
@endsection
