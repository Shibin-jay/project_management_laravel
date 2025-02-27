<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/projects', [ProjectController::class, 'store']); // Create project
    Route::get('/projects', [ProjectController::class, 'index']); // List projects
    Route::get('/projects/{id}', [ProjectController::class, 'show']); // Get project
    Route::put('/projects/{id}', [ProjectController::class, 'update']); // Update project
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']); // Delete project

    Route::post('/projects/{project_id}/tasks', [TaskController::class, 'store']); // Create task
    Route::get('/projects/{project_id}/tasks', [TaskController::class, 'index']); // List tasks
    Route::put('/tasks/{id}', [TaskController::class, 'update']); // Update task
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // Delete task
    Route::put('/tasks/{id}/status', [TaskController::class, 'updateStatus']); // Update task status with remarks

    Route::get('/projects/{id}/report', [ReportController::class, 'generateReport']);
});
