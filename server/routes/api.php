<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */



Route::post('/register', [UserController::class, 'register'])->name('auth.register')->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->name('auth.login')->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout')->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class);
});
