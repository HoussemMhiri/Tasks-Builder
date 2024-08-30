<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class TaskPolicy
{

    public function index(User $user)
    {
        return $user !== null;
    }

    public function store(User $user)
    {
        return $user !== null;
    }

    public function show(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
