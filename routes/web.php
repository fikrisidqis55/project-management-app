<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
Route::get('/projects', [ProjectController::class, 'index']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::put('/projects/{id}', [ProjectController::class, 'update']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

Route::get('/milestones', [MilestoneController::class, 'index']);
Route::post('/milestones', [MilestoneController::class, 'store']);
Route::put('/milestones/{milestone}', [MilestoneController::class, 'update']);
Route::delete('/milestones/{milestone}', [MilestoneController::class, 'destroy']);

Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications/{notification}/markAsRead', [NotificationController::class, 'markAsRead']);
// });


Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
