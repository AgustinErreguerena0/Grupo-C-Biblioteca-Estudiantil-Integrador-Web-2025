<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;
use App\Models\Creator;
use App\Models\Publisher;
use App\Models\Subject;
use App\Models\Ejemplar;

class MiembroController extends Controller
{
    /**
     * Muestra la página de catálogo del miembro con funcionalidad de búsqueda.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    // ¡IMPORTANTE! Renombrado de 'inicio' a 'catalogo'
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

        // ¡IMPORTANTE! Asegúrate de que la vista sea 'miembro.catalogo'
        return view('miembro.catalogo', compact('catalogItems'));
    }

    /**
     * Muestra los detalles de un ítem de catálogo específico para el miembro.
     * (Este método ya estaba correcto y no necesita cambios)
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function detalleCatalogo($id)
    {
        $catalogoItem = Catalogo::with(['creators', 'subjects', 'publisher', 'ejemplares'])->find($id);

        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado.');
        }

        return view('miembro.detalle-catalogo', compact('catalogoItem'));
    }
}