<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(
            Task::all()
        );
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create(
            $request->validated()
        );

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {

        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ], 200);
    }
}
