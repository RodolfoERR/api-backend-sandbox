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

// Ruta para el SSE en tu archivo de rutas (routes/web.php)
// Route::get('/sse/reports', function () {
//     return response()->stream(function () {
//         while (true) {
//             echo "data: " . json_encode(['message' => 'Esperando nuevas notificaciones...']) . "\n\n";
//             ob_flush();
//             flush();
//             sleep(1);
//         }
//     }, 200, [
//         'Content-Type' => 'text/event-stream',
//         'Cache-Control' => 'no-cache',
//         'Connection' => 'keep-alive',
//     ]);
// });

Route::get('/', function () {
    return view('loginweb');
});
// Rutas para mostrar las vistas de login
Route::prefix('views')->group(function(){
    Route::get('/', function () {
        return view('loginweb');
    });

    Route::get('login', function () {
        return view('loginweb');
    })->name('login');
    
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('userscrud', function () {
        return view('users_crud');
    })->name('userscrud');
    /*Líneas temporales para borrar.*/

    Route::get('types', function () {
        return view('types');
    })->name('types');

    Route::get('locations', function () {
        return view('locations');
    })->name('locations');

    Route::get('refacciones', function () {
        return view('refacciones');
    })->name('refacciones');

    Route::get('racks', function () {
        return view('racks');
    })->name('racks');

    Route::get('reports', function () {
        return view('reports');
    })->name('reports');
});