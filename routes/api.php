<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');

Route::post('profile', [ProfileController::class, 'Store']);

Route::get('profile/{id}', [ProfileController::class, 'show']);

Route::put('profile/{id}', [ProfileController::class, 'update']);

Route::get('user/profile/{id}' , [UserController::class , 'GetProfile']);

Route::get('user/tasks/{id}' , [UserController::class , 'GetTasks']);

Route::get('task/user/{id}', [TaskController::class, 'GetUser']);

Route::post('tasks/{taskId}/categories' , [TaskController::class , 'AddCategoryToTask']);

Route::get('tasks/{taskId}/categories' , [TaskController::class , 'GetTaskCategory']);

Route::get('categories/{id}/tasks' , [TaskController::class , 'GetCategoryTasks']);

Route::post('register' , [UserController::class , 'register']);
Route::post('login' , [UserController::class , 'login']);
Route::post('logout' , [UserController::class , 'logout'])->middleware('auth:sanctum');

