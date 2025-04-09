@extends('app')

@section('content')
    <h2>Update Task</h2>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/tasks/{{ $task->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Task name:</label><br>
        <input value="{{ $task->name }}" type="text" name="name" placeholder="Input task name"><br>
        <label for="description">Description:</label><br>
        <input value="{{ $task->description }}" type="text" name="description" placeholder="Input description"><br>
        <label for="group_id">Group:</label><br>
        <select name="group_id" id="">
            <option value="">Select task group</option>
            @foreach ($groups as $group)
                <option {{ $group->id == $task->group_id ? 'selected' : '' }} value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select> <br>
        <label for="thumbnail">Thumbnail:</label><br>
        <input type="file" name="thumbnail"><br><br>
        @if($task->thumbnail)
            <img src="{{ asset('storage/' . $task->thumbnail) }}" alt="Thumbnail" style="max-width: 200px;"><br><br>
        @endif
        <button type="submit">Update</button>
    </form>
@endsection