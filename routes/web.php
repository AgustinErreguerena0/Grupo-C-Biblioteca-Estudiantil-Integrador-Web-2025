<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BibliotecarioController; // Importa tu controlador BibliotecarioController
use App\Http\Controllers\MiembroController;
// Página principal
Route::get('/', function () {
    return view('index');
});

// Bibliotecario
Route::prefix('bibliotecario')->group(function () {
    Route::view('inicio', 'bibliotecario.inicio');
    Route::view('alta-miembro', 'bibliotecario.alta-miembro');
    Route::view('circulacion', 'bibliotecario.circulacion');
    Route::view('devolucion', 'bibliotecario.devolucion');

    // Dentro de Route::prefix('bibliotecario')->group(function () { ... });
    Route::get('miembros', [BibliotecarioController::class, 'miembros'])->name('bibliotecario.miembros');
    Route::view('prestamo', 'bibliotecario.prestamo');

    // Rutas para el Catálogo (actualizada para usar el controlador)
    Route::get('catalogo', [BibliotecarioController::class, 'catalogo'])->name('bibliotecario.catalogo');

    // Rutas para el CRUD y Ejemplares del Catálogo (usando el controlador y IDs dinámicos)
    Route::get('alta-catalogo', [BibliotecarioController::class, 'altaCatalogo'])->name('bibliotecario.catalogo.alta');
    // Ruta para mostrar los detalles de un catálogo específico
    Route::get('catalogo/detalle/{id}', [BibliotecarioController::class, 'detalleCatalogo'])->name('bibliotecario.catalogo.detalle');
    // Rutas para modificar y eliminar
    Route::get('catalogo/modificar/{id}', [BibliotecarioController::class, 'modificarCatalogo'])->name('bibliotecario.catalogo.modificar');
    Route::delete('catalogo/eliminar/{id}', [BibliotecarioController::class, 'eliminarCatalogo'])->name('bibliotecario.catalogo.eliminar');
    // Ruta para ver los ejemplares de un catálogo específico
    Route::get('catalogo/ejemplares/{id}', [BibliotecarioController::class, 'ejemplaresCatalogo'])->name('bibliotecario.catalogo.ejemplares');
});

Route::prefix('miembro')->group(function () {
    // Ruta para la página de catálogo del miembro
    // Cambiado de 'inicio' a 'catalogo' en la URL y el nombre de la ruta
    Route::get('catalogo', [MiembroController::class, 'catalogo'])->name('miembro.catalogo'); // <-- ¡CAMBIO AQUÍ!

    // Ruta para ver el detalle de un catálogo específico desde la vista del miembro
    Route::get('catalogo/detalle/{id}', [MiembroController::class, 'detalleCatalogo'])->name('miembro.catalogo.detalle');

    // Si tienes esta línea: Route::view('detalle-catalogo', 'miembro.detalle-catalogo');
    // puedes eliminarla si ya estás usando la ruta dinámica de arriba.
});
Route::get('probar-conexion', function () {
    try {
        DB::connection()->getPdo();
        return "Conexión a la base de datos exitosa";
    } catch (\Exception $e) {
        return "No se pudo conectar a la base de datos <br> Error: " . $e->getMessage();
    }
});
