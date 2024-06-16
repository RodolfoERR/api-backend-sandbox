<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::prefix('users')->group(function() {
        // Route::post('register', [UsersController::class, 'createUser']);
        Route::post('log-in', [AccessController::class, 'logIn']);
        
        Route::middleware(['active', 'auth:sanctum'])->group(function(){
            // Route::get('get-Myself', [UsersController::class, 'getMyself']);
            Route::delete('log-out', [AccessController::class, 'logOut']);
        });
    });
});