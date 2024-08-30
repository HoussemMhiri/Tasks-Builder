<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function index()
    {
        Gate::authorize('index', Task::class);

        $user = auth()->user();

        $tasks = $user->tasks;

        return response()->json([
            'tasks' => $tasks
        ], 200);
    }

    public function store(StoreTaskRequest $request)
    {
        /*     Gate::authorize('store', Task::class); */

        return response()->json($request->saveTask(new Task()), 201);
    }


    public function show(Task $task)
    {
        Gate::authorize('show', $task);

        return response()->json([
            'task' => $task
        ], 200);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        return response()->json($request->saveTask($task), 201);
    }


    public function destroy(Task $task)
    {
        Gate::authorize('destroy', $task);

        $task->delete();

        return response('', 204);
    }
}
