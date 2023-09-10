<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PrestamosController;
use App\Models\Libro;
use App\Models\Prestamo;

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

Route::get('/', [LibrosController::class, 'mostrarLibros']);
Route::get('/mostrarLibros', [LibrosController::class, 'mostrarLibros']);
Route::get('/crearLibroForm', [LibrosController::class, 'crearLibroForm']);
Route::post('/crearLibro', [LibrosController::class, 'crearLibro'])->name('crearLibro');
Route::get('/detallesLibro/{id}', [LibrosController::class, 'detallesLibro']);
Route::get('/editarLibroForm/{id}', [LibrosController::class, 'editarLibroForm']);
Route::post('/editarLibro', [LibrosController::class, 'editarLibro'])->name('editarLibro');
Route::get('/eliminarLibro/{id}', [ LibrosController::class, 'eliminarLibro']);
Route::post('/filtrarLibros', [LibrosController::class, 'filtrarLibros'])->name('filtrarLibros');

Route::get('/mostrarPrestamos', [PrestamosController::class, 'mostrarPrestamos']);
Route::get('/crearPrestamoForm', [PrestamosController::class, 'crearPrestamoForm']);
Route::get('/crearPrestamoLibroForm/{id}', [PrestamosController::class, 'crearPrestamoLibroForm']);
Route::post('/crearPrestamo', [PrestamosController::class, 'crearPrestamo'])->name('crearPrestamo');
Route::get('/detallesPrestamo/{id}', [PrestamosController::class, 'detallesPrestamo']);
Route::get('/cerrarPrestamo/{id}', [PrestamosController::class, 'cerrarPrestamo']);
Route::post('/filtrarPrestamos', [PrestamosController::class, 'filtrarPrestamos'])->name('filtrarPrestamos');
