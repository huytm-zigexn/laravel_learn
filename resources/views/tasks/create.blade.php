@extends('app')

@section('content')
    <h2>Create Task</h2>
    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Input task name"><br>
        <input type="text" name="description" placeholder="Input description"><br>
        <button type="submit">Create</button>
    </form>
@endsection
