<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
// Página principal
Route::get('/', function () {
    return view('index');
});

// Bibliotecario
Route::prefix('bibliotecario')->group(function () {
    Route::view('inicio', 'bibliotecario.inicio');
    Route::view('alta-catalogo', 'bibliotecario.alta-catalogo');
    Route::view('alta-miembro', 'bibliotecario.alta-miembro');
    Route::view('catalogo', 'bibliotecario.catalogo');
    Route::view('circulacion', 'bibliotecario.circulacion');
    Route::view('detalle-catalogo', 'bibliotecario.detalle-catalogo');
    Route::view('devolucion', 'bibliotecario.devolucion');
    Route::view('ejemplares', 'bibliotecario.ejemplares');
    Route::view('miembros', 'bibliotecario.miembros');
    Route::view('prestamo', 'bibliotecario.prestamo');
});

// Miembro
Route::prefix('miembro')->group(function () {
    Route::view('inicio', 'miembro.inicio');
    Route::view('detalle-catalogo', 'miembro.detalle-catalogo');
});

Route::get('probar-conexion', function(){
    try{
        DB::connection()->getPdo();
        return "Conexión a la base de datos exitosa";
    }catch(\Exception $e){
        return "No se pudo conectar a la base de datos <br> Error: ".$e->getMessage();
    }

});