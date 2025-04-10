@extends('app')

@section('content')
    <h2>Create Task</h2>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action={{ route('create_task') }} method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Task name:</label><br>
        <input type="text" name="name" placeholder="Input task name"><br>
        <label for="description">Description:</label><br>
        <input type="text" name="description" placeholder="Input description"><br>
        <label for="group_id">Group:</label><br>
        <select name="group_id" id="">
            <option value="">Select task group</option>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select> <br>
        <label for="due_date">Due Date:</label><br>
        <input type="datetime-local" name="due_date"><br>
        <label for="">Assign to users:</label><br>
        @foreach ($users as $user)
            <input type="checkbox" name="users[]" value="{{ $user->id }}">
            {{ $user->name }} <br>
        @endforeach
        <label for="thumbnail">Thumbnail:</label><br>
        <input type="file" name="thumbnail"><br>
        <button type="submit">Create</button>
    </form>
@endsection
