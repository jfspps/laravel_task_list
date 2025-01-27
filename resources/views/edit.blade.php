@extends('layouts.app')

@section('content')
    {{-- Include the form.blade.php subview   --}}
    @include('form', ['task' => $task])
@endsection
