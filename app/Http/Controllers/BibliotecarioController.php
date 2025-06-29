<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo; // Importa el modelo Catalogo
use App\Models\Miembro; // Importa el modelo Miembro
use App\Models\Ejemplar; // Importa el modelo Ejemplar
use App\Models\Creator; // Importa el modelo Creator
use App\Models\Publisher; // Importa el modelo Publisher
use App\Models\Subject; // Importa el modelo Subject

class BibliotecarioController extends Controller
{
    // Método para la vista principal del catálogo con funcionalidad de búsqueda
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
            ->with(['creators', 'subjects', 'publisher']) // Carga ansiosa de relaciones
            ->get();

        return view('bibliotecario.catalogo', compact('catalogItems'));
    }
    // Nuevo método para la vista de miembros con funcionalidad de búsqueda
    public function miembros(Request $request)
    {
        $searchQuery = $request->input('search_query'); // Obtiene el valor del campo de búsqueda

        $miembros = Miembro::query()
            ->when($searchQuery, function ($query, $searchQuery) {
                // Aplica la búsqueda si hay un término de búsqueda
                $query->where('nombre', 'like', '%' . $searchQuery . '%')
                    ->orWhere('apellido', 'like', '%' . $searchQuery . '%')
                    ->orWhere('dni', 'like', '%' . $searchQuery . '%')
                    ->orWhere('correo', 'like', '%' . $searchQuery . '%')
                    ->orWhere('telefono', 'like', '%' . $searchQuery . '%')
                    ->orWhere('direccion', 'like', '%' . $searchQuery . '%')
                    ->orWhere('tipo_miembro', 'like', '%' . $searchQuery . '%')
                    ->orWhere('usuario', 'like', '%' . $searchQuery . '%');
            })
            ->get(); // Ejecuta la consulta y obtiene los resultados

        // Pasa los miembros a la vista
        return view('bibliotecario.miembros', compact('miembros'));
    }

    // Método para mostrar los detalles de un ítem de catálogo específico
    public function detalleCatalogo($id)
    {
        // Busca el ítem de catálogo por su ID y carga ansiosamente las relaciones necesarias
        $catalogoItem = Catalogo::with(['creators', 'subjects', 'publisher', 'ejemplares'])->find($id);

        // Si el ítem no se encuentra, abortar con un error 404
        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado.');
        }

        return view('bibliotecario.detalle-catalogo', compact('catalogoItem'));
    }

    // Métodos placeholder para las demás funcionalidades (deben ser implementados)
    public function altaCatalogo()
    {
        return view('bibliotecario.alta-catalogo');
    }

    public function modificarCatalogo($id)
    {
        $catalogoItem = Catalogo::find($id);
        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado para modificar.');
        }
        return view('bibliotecario.modificar-catalogo', compact('catalogoItem'));
    }

    public function eliminarCatalogo($id)
    {
        $catalogoItem = Catalogo::find($id);
        if ($catalogoItem) {
            $catalogoItem->delete();
            return redirect()->route('bibliotecario.catalogo')->with('success', 'Catálogo eliminado correctamente.');
        }
        return redirect()->route('bibliotecario.catalogo')->with('error', 'Catálogo no encontrado para eliminar.');
    }

    public function ejemplaresCatalogo($id)
    {
        $catalogoItem = Catalogo::with('ejemplares')->find($id);
        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado para ver ejemplares.');
        }
        return view('bibliotecario.ejemplares', compact('catalogoItem'));
    }
}
