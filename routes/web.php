<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\TasksController;

Route::get('/token', function () {
    return csrf_token(); 
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
Route::get('/tasks/{task}/show', [TasksController::class, 'show'])->name('tasks.show');
Route::post('/tasks/{task}/toggle-status', [TasksController::class, 'toggleStatus'])->name('tasks.toggle-status');
Route::get('/tasks/completed', [TasksController::class, 'completed'])->name('tasks.completed');
Route::get('/tasks/priority/{priority}', [TasksController::class, 'priority'])->name('tasks.priority');
