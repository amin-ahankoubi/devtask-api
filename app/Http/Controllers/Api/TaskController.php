<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return \App\Models\Task::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:todo,in-progress,done',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = \App\Models\Task::create($validated);

        return $task;
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:todo,in-progress,done',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = \App\Models\Task::findOrFail($id);

        $task->update($validated);

        return $task;
    }

    public function destroy(int $id)
    {
        $task = \App\Models\Task::findOrFail($id);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }
}
