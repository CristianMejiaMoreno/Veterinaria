<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RazaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', function(){
    return view('clientes.index');
})->name('clientes.index');

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get( '/', [HomeController::class, 'index'])->name('home');
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/clientes/TomSelect', [ClienteController::class, 'clientesForTomSelect'])->name('cliente.TomSelect');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.index');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('cliente.show');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente.store');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('cliente.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('cliente.delete');
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/mascotas/gatos', [MascotasController::class, 'getGatos'])->name('mascota.gatos');
    Route::get('/mascotas/perros', [MascotasController::class, 'getPerros'])->name('mascota.perros');
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/especies', [EspecieController::class, 'index'])->name('especie.index');
    Route::get('especies/TomSelect', [EspecieController::class, 'especiesForTomSelect'])->name('especie.TomSelect');
    Route::get('/especies/{id}', [EspecieController::class, 'show'])->name('especie.show');
    Route::put('/especies/{id}', [EspecieController::class, 'update'])->name('especie.update');
    Route::delete('/especies/{id}', [EspecieController::class, 'destroy'])->name('especie.delete');
    Route::post('/especies', [EspecieController::class, 'store'])->name('especie.store');
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/razas', [RazaController::class, 'index'])->name('raza.index');
    Route::post('/razas', [RazaController::class, 'store'])->name('raza.store');
    Route::get('razas/TomSelect', [RazaController::class, 'razasForTomSelect'])->name('raza.TomSelect');
    Route::get('/razas/{id}', [RazaController::class, 'show'])->name('raza.show');
    Route::put('/razas/{id}', [RazaController::class, 'update'])->name('raza.update');
    Route::delete('/razas/{id}', [RazaController::class, 'destroy'])->name('raza.delete');
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/mascotas', [MascotasController::class, 'index'])->name('mascota.index');
    Route::post('/mascotas', [MascotasController::class, 'store'])->name('mascota.store');
    Route::get('/mascotas/{id}', [MascotasController::class, 'show'])->name('mascota.show');
    Route::put('/mascotas/{id}', [MascotasController::class, 'update'])->name('mascota.update');
    Route::delete('/mascotas/{id}', [MascotasController::class, 'destroy'])->name('mascota.delete');

});

Auth::routes();
