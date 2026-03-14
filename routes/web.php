<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CarritoController;

Route::get('/', [PaginasController::class, 'inicio'])->name('inicio');
Route::get('/nosotros', [PaginasController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [PaginasController::class, 'contacto'])->name('contacto');
Route::get('/catalogo', [ProductosController::class, 'index'])->name('catalogo');
Route::get('/catalogo/{id}', [ProductosController::class, 'show'])->name('producto.detalle');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::get('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::get('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');