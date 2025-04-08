<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tasks')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $id = DB::table('tasks')->insertGetId([
            'name' => $request->name,
            'description' => $request->description,
            'group_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->where('id', $id)->update([
            'group_id' => $id,
        ]);

        return redirect()->route('app')->with('success', 'Task created successfully!');
    }

    public function update(string $id)
    {
        $task = $this->find_by_id($id);

        if(!$task)
        {
            abort(404);
        }
        return view('tasks.update', compact('task'));
    }

    public function edit(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        DB::table('tasks')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_at' => now()
        ]);

        return redirect()->route('app')->with('success', 'Task updated successfully!');
    }

    public function delete(string $id)
    {
        DB::table('tasks')->where('id', $id)->delete();
        return redirect()->route('app')->with('success', 'Task deleted successfully!');
    }

    private function find_by_id(string $id)
    {
        return DB::table('tasks')->find($id);
    }
}
