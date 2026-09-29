<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\Api\TaskController;
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/tasks', [TaskController::class, 'index']);
    
    Route::post('/tasks', [TaskController::class, 'store']);
    
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

});