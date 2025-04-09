<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Group;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $groups = Group::get();
        return view('tasks.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $thumbnailPath = null;

        $request->validate([
            'name' => 'required|alpha_dash:ascii|max:255',
            'description' => 'nullable',
            'group_id' => 'required|exists:groups,id',
            'thumbnail' => 'nullable|image|max:2048'
        ]);
        
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'group_id' => $request->group_id,
            'thumbnail' => $thumbnailPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('app')->with('success', 'Task created successfully!');
    }

    public function update(string $id)
    {
        $task = $this->find_by_id($id);
        $groups = Group::get();

        if(!$task)
        {
            abort(404);
        }
        return view('tasks.update', compact('task', 'groups'));
    }

    public function edit(Request $request, string $id)
    {
        $thumbnailPath = null;

        $request->validate([
            'name' => 'required|alpha_dash:ascii|max:255',
            'description' => 'nullable',
            'group_id' => 'required|exists:groups,id',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Task::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'group_id' => $request->group_id,
            'thumbnail' => $thumbnailPath,
            'updated_at' => now()
        ]);

        return redirect()->route('app')->with('success', 'Task updated successfully!');
    }

    public function delete(string $id)
    {
        Task::where('id', $id)->delete();
        return redirect()->route('app')->with('success', 'Task deleted successfully!');
    }

    private function find_by_id(string $id)
    {
        return Task::find($id);
    }
}
