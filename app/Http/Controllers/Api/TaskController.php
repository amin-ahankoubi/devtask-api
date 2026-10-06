<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Requests\TaskFilterRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index(TaskFilterRequest $request)
    {
        $filters = $request->validated();

        $tasks = $request->user()
            ->tasks()
            ->filter($filters)
            ->orderedBy($filters['sort'], $filters['direction'])
            ->paginate($filters['per_page'] ?? 10)
            ->withQueryString();

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $request->user()
            ->tasks()
            ->create($request->validated());

        return new TaskResource($task);
    }
    public function update(UpdateTaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return response()->noContent();
    }
}
