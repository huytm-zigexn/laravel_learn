<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequestValidate;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->with('group')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $groups = Group::get();
        $users = User::get();
        return view('tasks.create', compact('groups', 'users'));
    }

    public function store(TaskRequestValidate $request)
    {
        $thumbnailPath = null;
        
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        
        $dueDate = $request->due_date 
            ? Carbon::parse($request->due_date)->format('Y-m-d\TH:i')
            : null;

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'group_id' => $request->group_id,
            'due_date' => $dueDate,
            'thumbnail' => $thumbnailPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $task->users()->attach($request->users);

        return redirect()->route('app')->with('success', 'Task created successfully!');
    }

    public function update(string $id)
    {
        $task = Task::findOrFail($id);
        $users = User::get();
        Gate::authorize('update', $task);
        $groups = Group::get();

        if(!$task)
        {
            abort(404);
        }
        return view('tasks.update', compact('task', 'groups', 'users'));
    }

    public function edit(TaskRequestValidate $request, string $id)
    {
        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        
        $dueDate = $request->due_date ? Carbon::parse($request->due_date) : null;

        $task = Task::findOrFail($id);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'group_id' => $request->group_id,
            'due_date' => $dueDate,
            'thumbnail' => $thumbnailPath,
            'updated_at' => now()
        ]);
        $task->users()->sync($request->users);

        return redirect()->route('app')->with('success', 'Task updated successfully!');
    }

    public function delete(string $id)
    {
        $task = Task::findOrFail($id);
        Gate::authorize('delete', $task);
        $task->delete();
        return redirect()->route('app')->with('success', 'Task deleted successfully!');
    }
}
