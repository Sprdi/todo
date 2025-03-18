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

Route::post('/lists/create', [ListsController::class, 'create']);
Route::put('/lists/update/{id}', [ListsController::class, 'update']);
Route::delete('/lists/delete/{id}', [ListsController::class, 'delete']);

Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::post('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
Route::put('/tasks/update/{id}', [TasksController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/delete/{id}', [TasksController::class, 'delete'])->name('tasks.delete');
