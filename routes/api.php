<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskApiController;

Route::get('/tasks', [TaskApiController::class, 'index']);
Route::post('/tasks', [TaskApiController::class, 'store']);
Route::get('/tasks/{id}', [TaskApiController::class, 'show']);
Route::put('/tasks/{id}', [TaskApiController::class, 'update']);
Route::delete('/tasks/{id}', [TaskApiController::class, 'destroy']);
