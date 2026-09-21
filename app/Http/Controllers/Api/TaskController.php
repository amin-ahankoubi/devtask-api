<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskFilterRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(TaskFilterRequest $request)
    {
        $filters = $request->validated();

        $sort = $filters['sort'] ?? 'created_at';
        $direction = $filters['direction'] ?? 'desc';

        $tasks = Task::query()
            ->filter($filters)
            ->orderedBy($sort, $direction)
            ->paginate(2);

        return TaskResource::collection($tasks);
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
