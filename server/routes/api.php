<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Notifications\NotificationController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//AUTH
Route::post('/register', [UserController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->name('auth.login')->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout')->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    // Tasks
    Route::apiResource('tasks', TaskController::class);

    //Notifications
    Route::get('/notifications', [NotificationController::class, 'fetch'])->name('notification.fetch');
    Route::put('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notification.destroy');

    //User
    Route::get('/user', [UserController::class, 'fetch'])->name('auth.fetch');
    Route::put('/user/update', [UserController::class, 'update'])->name('auth.update');
});
