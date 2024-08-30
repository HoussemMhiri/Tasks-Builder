<?php

namespace App\Http\Requests;

use App\Models\Task;

trait saveTaskTrait
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'todo' => ['required', 'string'],
            'isDone' => ['nullable', 'boolean'],
            'end_before' => ['nullable', 'date'],
        ];
    }


    public function saveTask(Task $task)
    {
        $data = $this->only([
            'todo',
            'isDone',
            'end_before',
        ]) + ['user_id' => auth()->id()];


        $task->fill($data)->save();

        return $task;
    }
}
