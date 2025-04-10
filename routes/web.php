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


Route::get('/register', [UserController::class, 'get_register'])->name('get_register');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'get_login'])->name('get_login');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function() {
    Route::get('/', [TasksController::class, 'index'])->name('app');
    Route::get('/tasks', [TasksController::class, 'create'])->name('get_create_task');
    Route::post('/tasks', [TasksController::class, 'store'])->name('create_task');
    
    
    Route::group([], function() {
        Route::get('/tasks/{id}', [TasksController::class, 'update'])->name('get_update_task');
        Route::put('/tasks/{id}', [TasksController::class, 'edit'])->name('update_task');
        Route::delete('/tasks/{id}', [TasksController::class, 'delete'])->name('delete_task');
    })->middleware('validate-task-id');
});