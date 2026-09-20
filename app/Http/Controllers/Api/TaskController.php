<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTaskRequest;

use App\Http\Requests\UpdateTaskRequest;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return \App\Models\Task::all();
    }

    public function store(StoreTaskRequest $request)
    {
        $task = \App\Models\Task::create(
            $request->validated()
        );

        return $task;
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = \App\Models\Task::findOrFail($id);

        $task->update($request->validated());

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
