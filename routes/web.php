<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);
Route::get('tasks/stats/done-per-month', [TaskController::class, 'statsDonePerMonth'])->name('tasks.stats');






