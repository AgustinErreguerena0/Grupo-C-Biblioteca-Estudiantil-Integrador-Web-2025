<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo; 
use App\Models\Miembro; 

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
        
        $catalogoItem = Catalogo::with(['creators', 'subjects', 'publisher', 'ejemplares'])->find($id);

    
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
        $catalogoItem = Catalogo::with('ejemplares')->find($id);
        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado para ver ejemplares.');
        }
        return view('bibliotecario.ejemplares', compact('catalogoItem'));
    }
}
