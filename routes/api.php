<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/projects', [ProjectController::class, 'index']);
    Route::post('/logout', [ProjectController::class, 'logout']);

});
