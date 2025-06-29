<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BibliotecarioController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\BibliotecarioLoginController;
// Página principal (formulario de inicio de sesión)
Route::get('/', [BibliotecarioLoginController::class, 'showLoginForm'])->name('bibliotecario.login.form');
Route::post('/login', [BibliotecarioLoginController::class, 'login'])->name('bibliotecario.login');
Route::post('/logout', [BibliotecarioLoginController::class, 'logout'])->name('logout');

// Bibliotecario
Route::prefix('bibliotecario')->group(function () {
    Route::view('inicio', 'bibliotecario.inicio')->name('bibliotecario.inicio');
    Route::view('alta-miembro', 'bibliotecario.alta-miembro');
    Route::view('circulacion', 'bibliotecario.circulacion');
    Route::view('devolucion', 'bibliotecario.devolucion');

    
    Route::get('miembros', [BibliotecarioController::class, 'miembros'])->name('bibliotecario.miembros');
    Route::view('prestamo', 'bibliotecario.prestamo');

    // Rutas para el Catálogo 
    Route::get('catalogo', [BibliotecarioController::class, 'catalogo'])->name('bibliotecario.catalogo');

    
    Route::get('alta-catalogo', [BibliotecarioController::class, 'altaCatalogo'])->name('bibliotecario.catalogo.alta');
    // Ruta para mostrar los detalles de un catálogo específico
    Route::get('catalogo/detalle/{id}', [BibliotecarioController::class, 'detalleCatalogo'])->name('bibliotecario.catalogo.detalle');
   
    Route::get('catalogo/ejemplares/{id}', [BibliotecarioController::class, 'ejemplaresCatalogo'])->name('bibliotecario.catalogo.ejemplares');
});

Route::prefix('miembro')->group(function () {

    Route::get('catalogo', [MiembroController::class, 'catalogo'])->name('miembro.catalogo'); // <-- ¡CAMBIO AQUÍ!

    // Ruta para ver el detalle de un catálogo específico desde la vista del miembro
    Route::get('catalogo/detalle/{id}', [MiembroController::class, 'detalleCatalogo'])->name('miembro.catalogo.detalle');

});
