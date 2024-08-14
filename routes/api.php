<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\FingerprintController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\RefactionsController;
use App\Http\Controllers\RegistersController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShelvesController;
use App\Http\Controllers\TypesController;
use Illuminate\Http\Request;
use App\Models\Refaction;

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

    Route::prefix('racks')->middleware(['auth:sanctum', 'role:a'])->group(function(){
        Route::get('all', [RackController::class, 'index']);
        Route::post('create', [RackController::class, 'storeRack']);
        Route::put('update/{id}', [RackController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('delete/{id}', [RackController::class, 'destroy'])->where('id', '[0-9]+');
        Route::get('by/{id}', [RackController::class, 'show']);
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
        Route::delete('delete/{id}', [TypesController::class, 'deleteType'])->where('id', '[0-9]+');
    });

    Route::prefix('refactions')->middleware(['auth:sanctum'])->group(function() {
        Route::get('all-minus', [RefactionsController::class, 'readAllRefactionsMinus']);
        
        Route::middleware('role:a')->group(function(){
            Route::get('all', [RefactionsController::class, 'readAllRefactions']);
            Route::post('create', [RefactionsController::class, 'createRefaction']);
            Route::get('by/{id}', [RefactionsController::class, 'readRefactionById'])->where('id', '[0-9]+');
            Route::post('update/{id}', [RefactionsController::class, 'editRefaction'])->where('id', '[0-9]+');
            Route::put('taking/{id}', [RefactionsController::class, 'takingRefaction'])->where('id', '[0-9]+');
            Route::put('replenishment/{id}', [RefactionsController::class, 'replenishmentRefaction'])->where('id', '[0-9]+');
            Route::delete('delete/{id}', [RefactionsController::class, 'deleteRefaction'])->where('id', '[0-9]+');
        });
    });

    Route::prefix('reports')->middleware(['auth:sanctum'])->group(function() {
        Route::middleware('role:a')->group(function(){
            Route::get('all', [RegistersController::class, 'allReports']);
            Route::put('update/{id}', [RegistersController::class, 'editReport'])->where('id', '[0-9]+');
            Route::get('by-id/{id}', [RegistersController::class, 'byIdReports'])->where('id', '[0-9]+');
        });

        Route::get('by-user', [RegistersController::class, 'byUserReports']);
        Route::post('create', [RegistersController::class, 'createReport'])->name('cReport');
        Route::get('by-user/{id}', [RegistersController::class, 'byIDUserReports'])->where('id', '[0-9]+');
    });

    Route::prefix('fp')->middleware(['auth:sanctum', 'role:a'])->group(function() {
        Route::post('save-digital-fp', [FingerprintController::class, 'storeFingerprint']);
        Route::post('check-digital-fp', [FingerprintController::class, 'checkingFingerprint']);
    });
});