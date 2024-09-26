<?php

namespace App\Http\Requests;

use App\Models\Task;
use App\Notifications\TaskCompleted;
use Illuminate\Http\Request;

trait saveTaskTrait
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'todo' => ['nullable', 'string', 'required_without_all:isDone,end_before'],
            'isDone' => ['nullable', 'boolean', 'required_without_all:todo,end_before'],
            'end_before' => ['nullable', 'date', 'required_without_all:todo,isDone'],
        ];
    }




    public function saveTask(Task $task, Request $request = null)
    {
        $data = $this->only([
            'todo',
            'isDone',
            'end_before',
        ]) + ['user_id' => auth()->id()];


        $task->fill($data)->save();

        $user = auth()->user();

        if ($task->isDone === true && !$request->query('taskUpdated')) {
            $user->notify(new TaskCompleted($task));
        }

        return $task;
    }
}
