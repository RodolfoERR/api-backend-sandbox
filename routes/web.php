<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('loginweb');
});

// Rutas para mostrar las vistas de login
// Route::get('login', function () {
//     return view('loginweb');
// })->name('login');

// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('/userscrud', function () {
//         return view('users_crud');
//     });

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     });
// });