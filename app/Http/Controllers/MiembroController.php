<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;

class MiembroController extends Controller
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

        return view('miembro.catalogo', compact('catalogItems'));
    }

    public function detalleCatalogo($id)
    {
        $catalogoItem = Catalogo::with(['creators', 'subjects', 'publisher', 'ejemplares'])->find($id);

        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado.');
        }

        return view('miembro.detalle-catalogo', compact('catalogoItem'));
    }
}