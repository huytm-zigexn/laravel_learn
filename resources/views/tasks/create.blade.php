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
    <form action="/tasks" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Input task name"><br>
        <input type="text" name="description" placeholder="Input description"><br>
        <select name="group_id" id="">
            <option value="">Select task group</option>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select> <br>
        <input type="file" name="thumbnail"><br>
        <button type="submit">Create</button>
    </form>
@endsection
