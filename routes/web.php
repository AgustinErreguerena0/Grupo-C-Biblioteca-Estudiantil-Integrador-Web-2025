<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BibliotecarioController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\BibliotecarioLoginController;


// Middleware guest actualizado
Route::middleware('guest:bibliotecario,miembro')->group(function () {
    Route::get('/', [BibliotecarioLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [BibliotecarioLoginController::class, 'login'])->name('bibliotecario.login');
});

// Logout protegido
Route::post('/logout', [BibliotecarioLoginController::class, 'logout'])
    ->middleware('auth:bibliotecario,miembro')
    ->name('logout');

// Rutas protegidas solo para bibliotecarios autenticados
Route::prefix('bibliotecario')
    ->middleware('auth:bibliotecario') 
    ->group(function () {  
    Route::view('inicio', 'bibliotecario.inicio')->name('bibliotecario.inicio');
    Route::get('alta-miembro', function () {
        return view('bibliotecario.alta-miembro');
    })->name('bibliotecario.alta-miembro');
    Route::post('alta-miembro', [BibliotecarioController::class, 'altaMiembro'])->name('bibliotecario.miembro.alta'); // ¡NOMBRE DE RUTA CAMBIADO!
    Route::view('circulacion', 'bibliotecario.circulacion')->name('bibliotecario.circulacion');
    Route::view('devolucion', 'bibliotecario.devolucion')->name('bibliotecario.devolucion');
    Route::view('ejemplares', 'bibliotecario.ejemplares')->name('bibliotecario.ejemplares');
    Route::get('miembros', [BibliotecarioController::class, 'miembros'])->name('bibliotecario.miembros');
    Route::view('prestamo', 'bibliotecario.prestamo')->name('bibliotecario.prestamo');
    
    // Rutas de préstamos
    Route::post('prestamo/buscar-miembro', [BibliotecarioController::class, 'buscarMiembro']) ->name('prestamo.buscarMiembro');
    Route::post('prestamo/buscar-ejemplar', [BibliotecarioController::class, 'buscarEjemplar']) ->name('prestamo.buscarEjemplar');
    Route::post('prestamo/guardar', [BibliotecarioController::class, 'guardarPrestamo']) ->name('prestamo.guardar');

    // Ruta de devoluciones
    Route::post('prestamo/devolver', [BibliotecarioController::class, 'procesarDevolucion'])->name('prestamo.devolver');

    // Rutas de catálogo
    Route::get('catalogo', [BibliotecarioController::class, 'catalogo'])->name('bibliotecario.catalogo');
    Route::get('alta-catalogo', [BibliotecarioController::class, 'altaCatalogo'])->name('bibliotecario.catalogo.alta');

    // Procesar alta (nueva ruta POST)
    Route::post('alta-catalogo', [BibliotecarioController::class, 'storeCatalogo'])->name('bibliotecario.catalogo.store');

    Route::get('catalogo/detalle/{id}', [BibliotecarioController::class, 'detalleCatalogo'])->name('bibliotecario.catalogo.detalle');
    Route::get('catalogo/ejemplares/{id}', [BibliotecarioController::class, 'ejemplaresCatalogo'])->name('bibliotecario.catalogo.ejemplares');

    Route::post('catalogo/ejemplares/{id}', [BibliotecarioController::class, 'storeEjemplar']) ->name('bibliotecario.ejemplar.store');

});

// Rutas para miembros
Route::prefix('miembro')
    ->middleware('auth:miembro')
    ->group(function () {
        Route::get('catalogo',            [MiembroController::class, 'catalogo'])->name('miembro.catalogo');
        Route::get('catalogo/detalle/{id}', [MiembroController::class, 'detalleCatalogo'])->name('miembro.catalogo.detalle');
    });

//Ruta de errores
Route::get('/sesion-expirada', function () {
    return view('errors.419');
})->name('session.expired');