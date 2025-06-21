<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', function(){
    return view('clientes.index');
})->name('clientes.index');

Route::prefix('admin')->group(function(){
    Route::get( '/', [HomeController::class, 'index'])->name('home');
});

Route::prefix('admin')->group(function(){
    Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.index');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('cliente.show');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente.store');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('cliente.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('cliente.delete');
});

Route::prefix('admin')->group(function(){
    Route::get('/mascotas/gatos', [MascotasController::class, 'getGatos'])->name('mascota.gatos');
    Route::get('/mascotas/perros', [MascotasController::class, 'getPerros'])->name('mascota.perros');
});

Auth::routes();
