<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShelvesController;
use App\Http\Controllers\TypesController;

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

Route::prefix('prueba')->group(function(){

});

Route::prefix('v1')->group(function() {
    Route::prefix('users')->group(function() {
        Route::post('log-in', [AccessController::class, 'logIn']);
        
        Route::middleware(['auth:sanctum', 'role:a'])->group(function(){
            Route::get('get-Myself', [UsersController::class, 'getMyself']);
            
            Route::get('all-users', [UserController::class, 'index']);
            Route::post('create', [UserController::class, 'store']);
            Route::get('show/{id}', [UserController::class, 'show'])->where('id', '[0-9]+');;
            Route::put('update/{id}', [UserController::class, 'update'])->where('id', '[0-9]+');;
            Route::delete('delete/{id}', [UserController::class, 'destroy'])->where('id', '[0-9]+');;
        });
        
        Route::middleware(['active', 'auth:sanctum'])->group(function(){
            Route::delete('log-out', [AccessController::class, 'logOut']);
        });
    });
    
    Route::prefix('roles')->middleware(['auth:sanctum', 'role:a'])->group(function(){
        Route::get('all-roles', [RoleController::class, 'index']);
        Route::post('create', [RoleController::class, 'store']);
        Route::get('show/{id}', [RoleController::class, 'show'])->where('id', '[0-9]+');
        Route::put('update/{id}', [RoleController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('delete/{id}', [RoleController::class, 'destroy'])->where('id', '[0-9]+');
    });

    Route::prefix('locations')->middleware(['auth:sanctum', 'role:a'])->group(function(){
        Route::post('create', [ShelvesController::class, 'createLocation']);
        Route::get('all-locations', [ShelvesController::class, 'getShelves']);
        Route::get('by/{id}', [ShelvesController::class, 'getByID'])->where('id', '[0-9]+');
        Route::put('update/{id}', [ShelvesController::class, 'updateLocation'])->where('id', '[0-9]+');
        Route::delete('delete/{id}', [ShelvesController::class, 'removeLocation'])->where('id', '[0-9]+');
    });

    Route::prefix('types')->middleware(['auth:sanctum', 'role:a'])->group(function() {
        Route::get('all-types', [TypesController::class, 'readTypes']);
        Route::post('create', [TypesController::class, 'createType']);
        Route::put('update/{id}', [TypesController::class, 'updateType'])->where('id', '[0-9]+');
    });

    Route::prefix('refactions')->middleware(['auth:sanctum', 'role:a'])->group(function() {
        
    });
});
