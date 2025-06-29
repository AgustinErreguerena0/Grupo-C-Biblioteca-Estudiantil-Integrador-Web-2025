<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;
use App\Models\Miembro;
use App\Models\Proveedor; // <--- Añadir esta línea

class BibliotecarioController extends Controller
{

    public function catalogo(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $catalogItems = Catalogo::query()
            ->when($searchQuery, function ($query, $searchQuery) {

                $query->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%')
                    ->orWhereHas('creators', function ($q) use ($searchQuery) {
                        $q->where('creator', 'like', '%' . $searchQuery . '%');
                    })
                    ->orWhereHas('subjects', function ($q) use ($searchQuery) {
                        $q->where('subject', 'like', '%' . $searchQuery . '%');
                    })
                    ->orWhereHas('publisher', function ($q) use ($searchQuery) {
                        $q->where('publisher', 'like', '%' . $searchQuery . '%');
                    });
            })
            ->with(['creators', 'subjects', 'publisher'])
            ->get();

        return view('bibliotecario.catalogo', compact('catalogItems'));
    }

    public function miembros(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $miembros = Miembro::query()
            ->when($searchQuery, function ($query, $searchQuery) {

                $query->where('nombre', 'like', '%' . $searchQuery . '%')
                    ->orWhere('apellido', 'like', '%' . $searchQuery . '%')
                    ->orWhere('dni', 'like', '%' . $searchQuery . '%')
                    ->orWhere('correo', 'like', '%' . $searchQuery . '%')
                    ->orWhere('telefono', 'like', '%' . $searchQuery . '%')
                    ->orWhere('direccion', 'like', '%' . $searchQuery . '%')
                    ->orWhere('tipo_miembro', 'like', '%' . $searchQuery . '%')
                    ->orWhere('usuario', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        return view('bibliotecario.miembros', compact('miembros'));
    }


    public function detalleCatalogo($id)
    {

        // Asegurarse de cargar la relación 'proveedor' dentro de 'ejemplares'
        $catalogoItem = Catalogo::with(['creators', 'subjects', 'publisher', 'ejemplares.proveedor'])->find($id);


        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado.');
        }

        return view('bibliotecario.detalle-catalogo', compact('catalogoItem'));
    }


    public function altaCatalogo()
    {
        return view('bibliotecario.alta-catalogo');
    }


    public function ejemplaresCatalogo($id)
    {
        // Cargar el item de catálogo, sus ejemplares y los proveedores de esos ejemplares
        $catalogoItem = Catalogo::with('ejemplares.proveedor')->find($id);

        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado para ver ejemplares.');
        }

        // Obtener todos los proveedores para el menú desplegable en el formulario de "Nuevo Ejemplar"
        $proveedores = Proveedor::all();

        // Pasar tanto el catalogoItem como los proveedores a la vista
        return view('bibliotecario.ejemplares', compact('catalogoItem', 'proveedores'));
    }
}