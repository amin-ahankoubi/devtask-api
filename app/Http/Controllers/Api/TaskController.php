<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(
            \App\Models\Task::all()
        );
    }

    public function store(StoreTaskRequest $request)
    {
        $task = \App\Models\Task::create(
            $request->validated()
        );

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = \App\Models\Task::findOrFail($id);

        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(int $id)
    {
        $task = \App\Models\Task::findOrFail($id);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ], 200);
    }
}
