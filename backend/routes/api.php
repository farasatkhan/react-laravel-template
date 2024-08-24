<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'getAllUsers']);
Route::get('/users/{id}', [UserController::class, 'getUser']);
Route::post('/users', [UserController::class, 'createUser']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
Route::put('/users', [UserController::class, 'UpdateEmail']);