<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/tasks', [TaskController::class, 'index']);

    Route::post('/tasks', [TaskController::class, 'store']);

    Route::put('/tasks/{task}', [TaskController::class, 'update']);

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

});

