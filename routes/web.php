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
    ->middleware('auth') // Protege el logout
    ->name('logout');

// Rutas protegidas solo para bibliotecarios autenticados
Route::prefix('bibliotecario')->middleware('auth:bibliotecario')->group(function () {
    Route::view('inicio', 'bibliotecario.inicio')->name('bibliotecario.inicio');
    Route::view('alta-miembro', 'bibliotecario.alta-miembro')->name('bibliotecario.alta-miembro');
    Route::view('circulacion', 'bibliotecario.circulacion')->name('bibliotecario.circulacion');
    Route::view('devolucion', 'bibliotecario.devolucion')->name('bibliotecario.devolucion');
    Route::view('ejemplares', 'bibliotecario.ejemplares')->name('bibliotecario.ejemplares');
    Route::get('miembros', [BibliotecarioController::class, 'miembros'])->name('bibliotecario.miembros');
    Route::view('prestamo', 'bibliotecario.prestamo')->name('bibliotecario.prestamo');

    // Rutas de catálogo
    Route::get('catalogo', [BibliotecarioController::class, 'catalogo'])->name('bibliotecario.catalogo');
    Route::get('alta-catalogo', [BibliotecarioController::class, 'altaCatalogo'])->name('bibliotecario.catalogo.alta');
    Route::get('catalogo/detalle/{id}', [BibliotecarioController::class, 'detalleCatalogo'])->name('bibliotecario.catalogo.detalle');
    Route::get('catalogo/ejemplares/{id}', [BibliotecarioController::class, 'ejemplaresCatalogo'])->name('bibliotecario.catalogo.ejemplares');
});

// Rutas para miembros (sin middleware porque no usaste uno)
// Rutas de miembro (sin middleware por ahora)
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