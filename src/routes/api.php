<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;

// Trampa: Si no envían token, respondemos 401 limpio en lugar de Error 500
Route::get('/login', function () {
    return response()->json(['error' => 'No autorizado. Se requiere un token Bearer válido.'], 401);
})->name('login');

// Rutas Públicas (Lectura)
Route::get('/eventos', [EventoController::class, 'index']);
Route::get('/eventos/{id}', [EventoController::class, 'show']);

// Rutas Protegidas por Keycloak (Escritura)
Route::middleware('auth:api')->group(function () {
    Route::post('/eventos', [EventoController::class, 'store']);
    Route::put('/eventos/{id}', [EventoController::class, 'update']);
    Route::delete('/eventos/{id}', [EventoController::class, 'destroy']);
});