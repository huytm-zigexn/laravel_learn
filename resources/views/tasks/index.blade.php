@extends('app')

@section('content')
    <div style="display: flex; align-items: center; justify-content: space-between">
        <h2>List of tasks</h2>
        <a href="/tasks">
            <button>Create new task</button>
        </a>
    </div>
    @foreach ($tasks as $task)
        <div style="display: flex; align-items:center; justify-content: space-between ;background-color: bisque; border-radius: 10px; margin-bottom: 10px; padding-right: 20px">
            <a style="text-decoration: none; padding: 20px; color: black;" href="/tasks/{{ $task->id }}">
                <h3>{{ $task->name }}</h3>
                <p>{{ $task->description }}</p>
            </a>
            <form action="/tasks/{{ $task->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure about deleting this task?')">Delete</button>
            </form>
        </div>
    @endforeach

    <a href="/tasks">
        <button>Create new task</button>
    </a>
@endsection