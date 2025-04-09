<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidateIdOnURL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TasksController::class, 'index'])->name('app');

Route::get('/register', [UserController::class, 'get_register']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'get_login']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/tasks', [TasksController::class, 'create']);
Route::post('/tasks', [TasksController::class, 'store']);


Route::group([], function() {
    Route::get('/tasks/{id}', [TasksController::class, 'update']);
    Route::put('/tasks/{id}', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::delete('/tasks/{id}', [TasksController::class, 'delete']);
})->middleware('validate-task-id');
