<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BibliotecarioController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\BibliotecarioLoginController;


// Rutas accesibles para invitados (usuarios no autenticados)
// Si un usuario autenticado intenta acceder a estas, será redirigido por el middleware RedirectIfAuthenticated.
Route::middleware('guest')->group(function () { // Usa el middleware 'guest' de forma general
    Route::get('/', [BibliotecarioLoginController::class, 'showLoginForm'])->name('login'); //
    Route::post('/login', [BibliotecarioLoginController::class, 'login'])->name('bibliotecario.login'); //
});

// Logout protegido por el middleware de autenticación
Route::post('/logout', [BibliotecarioLoginController::class, 'logout']) //
    ->middleware('auth') // Protege la ruta de logout, asegurando que solo los usuarios logueados puedan cerrar sesión
    ->name('logout'); //

// Rutas protegidas solo para bibliotecarios autenticados
Route::prefix('bibliotecario')->middleware('auth:bibliotecario')->group(function () { //
    Route::view('inicio', 'bibliotecario.inicio')->name('bibliotecario.inicio'); //
    Route::view('alta-miembro', 'bibliotecario.alta-miembro')->name('bibliotecario.alta-miembro'); //
    Route::view('circulacion', 'bibliotecario.circulacion')->name('bibliotecario.circulacion'); //
    Route::view('devolucion', 'bibliotecario.devolucion')->name('bibliotecario.devolucion'); //
    Route::view('ejemplares', 'bibliotecario.ejemplares')->name('bibliotecario.ejemplares'); //
    Route::get('miembros', [BibliotecarioController::class, 'miembros'])->name('bibliotecario.miembros'); //
    Route::view('prestamo', 'bibliotecario.prestamo')->name('bibliotecario.prestamo'); //

    // Rutas de catálogo
    Route::get('catalogo', [BibliotecarioController::class, 'catalogo'])->name('bibliotecario.catalogo'); //
    Route::get('alta-catalogo', [BibliotecarioController::class, 'altaCatalogo'])->name('bibliotecario.catalogo.alta'); //
    Route::get('catalogo/detalle/{id}', [BibliotecarioController::class, 'detalleCatalogo'])->name('bibliotecario.catalogo.detalle'); //
    Route::get('catalogo/ejemplares/{id}', [BibliotecarioController::class, 'ejemplaresCatalogo'])->name('bibliotecario.catalogo.ejemplares'); //
});

// Rutas protegidas para miembros autenticados
Route::prefix('miembro')->middleware('auth:miembro')->group(function () { // // Agrega el middleware auth:miembro
    Route::get('catalogo', [MiembroController::class, 'catalogo'])->name('miembro.catalogo'); //
    Route::get('catalogo/detalle/{id}', [MiembroController::class, 'detalleCatalogo'])->name('miembro.catalogo.detalle'); //
});

// Ruta de errores
Route::get('/sesion-expirada', function () { //
    return view('errors.419'); //
})->name('session.expired'); //