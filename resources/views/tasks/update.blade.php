@extends('app')
@section('content')
    <h2>Update Task</h2>
    <form action="{{ route('tasks.edit', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input value="{{ $task->name }}" type="text" name="name" placeholder="Input task name"><br>
        <input value="{{ $task->description }}" type="text" name="description" placeholder="Input description"><br>
        <button type="submit">Update</button>
    </form>
@endsection