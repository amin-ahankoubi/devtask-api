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

        $tasks = Task::query()
            ->filter($filters)
            ->orderedBy($filters['sort'], $filters['direction'])
            ->paginate($filters['per_page'] ?? 10)
            ->withQueryString();

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

        return response()->noContent();
    }
}
