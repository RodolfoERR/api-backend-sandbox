<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// routes/api.php
Route::prefix('v1')->group(function() {
    Route::prefix('users')->group(function() {
        // Route::post('register', [UsersController::class, 'createUser']);
        Route::post('log-in', [AccessController::class, 'logIn']);
        
        Route::middleware(['auth:sanctum', ''])->group(function(){
            Route::get('all-users', [UserController::class, 'index']);
            Route::post('create', [UserController::class, 'store']);
            Route::get('show/{id}', [UserController::class, 'show']);
            Route::put('update/{id}', [UserController::class, 'update']);
            Route::delete('delete/{id}', [UserController::class, 'destroy']);
        });
        
        Route::middleware(['active', 'auth:sanctum'])->group(function(){
            // Route::get('get-Myself', [UsersController::class, 'getMyself']);
            Route::delete('log-out', [AccessController::class, 'logOut']);
        });
    });
    
    Route::prefix('roles')->middleware(['auth:sanctum'])->group(function(){
        Route::get('all-roles', [RoleController::class, 'index']);
        Route::post('create', [RoleController::class, 'store']);
        Route::get('show/{id}', [RoleController::class, 'show']);
        Route::put('update/{id}', [RoleController::class, 'update']);
        Route::delete('delete/{id}', [RoleController::class, 'destroy']);
    });
});
