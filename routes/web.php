<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\ProductosController;

Route::get('/', [PaginasController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [PaginasController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [PaginasController::class, 'contacto'])->name('contacto');
Route::get('/catalogo', [ProductosController::class, 'index'])->name('catalogo');
Route::get('/catalogo/{id}', [ProductosController::class, 'show'])->name('producto.detalle');