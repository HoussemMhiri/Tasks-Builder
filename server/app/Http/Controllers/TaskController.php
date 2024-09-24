<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Notifications\TaskCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        Gate::authorize('index', Task::class);

        $user = auth()->user();
        $searchQuery = $request->query('q');
        $statusFilter = $request->query('status');
        $tasksSearch = $user->tasks();

        if ($searchQuery) {
            $tasksSearch->where('todo', 'LIKE', '%' . $searchQuery . '%');
        }

        if ($statusFilter) {
            switch ($statusFilter) {
                case 'complete':
                    $status = 1;
                    break;
                case 'uncomplete':
                    $status = 0;
                    break;
                case 'all':
                default:
                    $status = null;
                    break;
            }

            if ($status !== null) {
                $tasksSearch->where('isDone', 'LIKE', $status);
            }
        }

        $tasks = $tasksSearch->get();

        return response()->json([
            'tasks' => $tasks
        ], 200);
    }

    public function store(StoreTaskRequest $request)
    {
        Gate::authorize('store', Task::class);

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

        return response()->json($request->saveTask($task, $request), 201);
    }


    public function destroy(Task $task)
    {
        Gate::authorize('destroy', $task);

        $task->delete();

        return response('', 204);
    }
}
