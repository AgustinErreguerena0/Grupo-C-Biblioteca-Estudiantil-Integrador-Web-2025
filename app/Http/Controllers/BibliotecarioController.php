<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Catalogo;
use App\Models\Miembro;
use App\Models\Proveedor;
use App\Models\Creator;
use App\Models\Subject;
use App\Models\Publisher;
use App\Models\Ejemplar;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Hash;

class BibliotecarioController extends Controller
{
    ////////////////////////////////////////////////////////////////////////////////////////////////

    // GET: muestra el formulario con listas para selects múltiples
    public function altaCatalogo()
    {
        $publishers = Publisher::all();
        $creators   = Creator::all();
        $subjects   = Subject::all();

        return view('bibliotecario.alta-catalogo', compact('publishers', 'creators', 'subjects'));
    }

   
    public function storeCatalogo(Request $request)
    {
        $messages = [
            'creators.required' => 'Debes elegir al menos un autor.',
        ];

        $data = $request->validate([
            'title'            => 'required|string|max:100',
            'description'      => 'nullable|string',
            'date'             => 'nullable|date',
            'identifier'       => 'nullable|string|max:100|unique:catalogos,identifier',
            'language'         => 'nullable|string|max:100',
            'format'           => 'nullable|string|max:100',
            'rights'           => 'nullable|string|max:100',
            'type'             => 'required|string|max:100',
            'id_bibliotecario' => 'required|integer|exists:bibliotecarios,id_bibliotecario',
            'id_publisher'     => 'nullable|integer|exists:publishers,id_publisher',
            'creators'         => 'required|array|min:1',
            'creators.*'       => 'integer|exists:creators,id_creator',
            'subjects'         => 'nullable|array',
            'subjects.*'       => 'integer|exists:subjects,id_subject',
        ], $messages);

        // —————— Comprobación de duplicados ——————
        $exists = Catalogo::where('title', $data['title'])
            ->where('type', $data['type'])
            ->whereHas('creators', function($q) use ($data) {
                $q->whereIn('creators.id_creator', $data['creators']);
            })
            ->withCount('creators')
            ->get()
            ->filter(function($catalogo) use ($data) {
                return $catalogo->creators_count === count($data['creators']);
            })
            ->isNotEmpty();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'duplicate' => 'Ya existe un catálogo con ese Título, Tipo y Conjunto de Creadores.'
                ]);
        }
        // ———————————————————————————————

        // Creamos el catálogo
        $catalogo = Catalogo::create($data);

        // Sincronizamos las relaciones muchos a muchos
        $catalogo->creators()->sync($request->input('creators', []));
        $catalogo->subjects()->sync($request->input('subjects', []));

        return redirect()
            ->route('bibliotecario.catalogo')
            ->with('success', 'Catálogo creado correctamente.');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function storeEjemplar(Request $request, $id)
    {
        $messages = [
            'id_publico.required'      => 'El identificador público es obligatorio.',
            'id_publico.unique'        => 'Este identificador ya existe.',
            'ubicacion.required'       => 'La ubicación es obligatoria.',
            'procedencia.required'     => 'La procedencia es obligatoria.',
            'estado_material.required' => 'Debes elegir un estado.',
            'disponibilidad.required'  => 'Debes elegir la disponibilidad.',
            'id_proveedor.integer'     => 'Proveedor inválido.',
            'id_proveedor.exists'      => 'El proveedor seleccionado no existe.',
        ];

        $data = $request->validate([
            'id_publico'      => 'required|string|max:100|unique:ejemplares,id_publico',
            'ubicacion'       => 'required|string',
            'procedencia'     => ['required', Rule::in(['Compra','Canje','Donación'])],
            'estado_material' => ['required', Rule::in(['Bueno','Daño leve','Daño medio','Indeterminado'])],
            'disponibilidad'  => ['required', Rule::in(['Disponible','No disponible'])],
            'id_proveedor'    => 'nullable|integer|exists:proveedores,id_proveedor',
        ], $messages);

        // Asociar con el catálogo
        $data['id_catalogo'] = $id;

        Ejemplar::create($data);

        return redirect()
            ->route('bibliotecario.catalogo.ejemplares', $id)
            ->with('success', 'Ejemplar agregado correctamente.');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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

    // Método para almacenar un nuevo miembro
    public function altaMiembro(Request $request)
    {
        $messages = [
            'nombre.required'       => 'El nombre es obligatorio.',
            'apellido.required'     => 'El apellido es obligatorio.',
            'dni.required'          => 'El DNI es obligatorio.',
            'dni.unique'            => 'Ya existe un miembro con este DNI.',
            'correo.required'       => 'El correo electrónico es obligatorio.',
            'correo.email'          => 'El formato del correo electrónico no es válido.',
            'correo.unique'         => 'Ya existe un miembro con este correo electrónico.',
            'telefono.required'     => 'El teléfono es obligatorio.',
            'direccion.required'    => 'La dirección es obligatoria.',
            'tipo_miembro.required' => 'El tipo de miembro es obligatorio.',
            'tipo_miembro.in'       => 'El tipo de miembro seleccionado no es válido.',
            'usuario.required'      => 'El usuario es obligatorio.',
            'usuario.unique'        => 'Ya existe un miembro con este usuario.',
        ];

        $validatedData = $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'dni'          => 'required|string|max:20|unique:miembros,dni',
            'correo'       => 'required|string|email|max:255|unique:miembros,correo',
            'telefono'     => 'required|string|max:255',
            'direccion'    => 'required|string|max:255',
            'tipo_miembro' => ['required', Rule::in(['Estudiante', 'Profesor', 'Investigador'])],
            'usuario'      => 'required|string|max:255|unique:miembros,usuario',
        ], $messages);

        // La contraseña será el DNI hasheado
        $validatedData['contraseña'] = Hash::make($request->dni);

        Miembro::create($validatedData);

        return redirect()
            ->route('bibliotecario.alta-miembro')
            ->with('success', 'Miembro agregado correctamente.');
    }

    public function detalleCatalogo($id)
    {
        $catalogoItem = Catalogo::with(['creators', 'subjects', 'publisher', 'ejemplares.proveedor'])
            ->find($id);

        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado.');
        }

        return view('bibliotecario.detalle-catalogo', compact('catalogoItem'));
    }

    public function ejemplaresCatalogo($id)
    {
        $catalogoItem = Catalogo::with('ejemplares.proveedor')->find($id);

        if (!$catalogoItem) {
            abort(404, 'Catálogo no encontrado para ver ejemplares.');
        }

        $proveedores = Proveedor::all();

        return view('bibliotecario.ejemplares', compact('catalogoItem', 'proveedores'));
    }

    public function buscarMiembro(Request $request)
    {
        $request->validate(['dni' => 'required|string']);

        $miembro = Miembro::where('dni', $request->dni)->first();
        if (!$miembro) {
            return response()->json(['error' => 'Miembro no encontrado.'], 404);
        }

        return response()->json([
            'nombre'   => $miembro->nombre,
            'apellido' => $miembro->apellido
        ]);
    }

    public function buscarEjemplar(Request $request)
    {
        $request->validate(['id_publico' => 'required|string']);

        $ejemplar = Ejemplar::where('id_publico', $request->id_publico)
            ->where('disponibilidad', 'Disponible')
            ->with('catalogo.creators', 'catalogo.subjects')
            ->first();

        if (!$ejemplar) {
            return response()->json(['error' => 'Ejemplar no disponible o no encontrado.'], 404);
        }

        return response()->json([
            'id_ejemplar' => $ejemplar->id_ejemplar,
            'id_publico'  => $ejemplar->id_publico,
            'ubicacion'   => $ejemplar->ubicacion,
            'titulo'      => $ejemplar->catalogo->title ?? '',
            'creador'     => $ejemplar->catalogo->creators->pluck('creator')->join(', '),
            'asunto'      => $ejemplar->catalogo->subjects->pluck('subject')->join(', ')
        ]);
    }

    public function guardarPrestamo(Request $request)
    {
        \Log::debug('📥 Datos recibidos en guardarPrestamo', $request->all());

        $request->validate([
            'dni'         => 'required|string',
            'ejemplares'  => 'required|array|min:1',
            'ejemplares.*'=> 'integer|exists:ejemplares,id_ejemplar'
        ]);

        $miembro = Miembro::where('dni', $request->dni)->first();
        if (!$miembro) {
            return response()->json(['error' => 'Miembro no encontrado.'], 404);
        }

        try {
            DB::beginTransaction();

            $prestamo = Prestamo::create([
                'id_miembro'     => $miembro->id_miembro,
                'fecha_prestamo' => now(),
                'devuelto'       => false
            ]);

            foreach ($request->ejemplares as $idEjemplar) {
                $existe = DB::table('ejemplar_prestamo')
                    ->where('id_prestamo', $prestamo->id_prestamo)
                    ->where('id_ejemplar', $idEjemplar)
                    ->exists();

                if (!$existe) {
                    DB::table('ejemplar_prestamo')->insert([
                        'id_prestamo' => $prestamo->id_prestamo,
                        'id_ejemplar' => $idEjemplar
                    ]);

                    Ejemplar::where('id_ejemplar', $idEjemplar)
                        ->update(['disponibilidad' => 'No disponible']);
                }
            }

            DB::commit();

            return response()->json([
                'success'     => true,
                'message'     => 'Préstamo registrado correctamente.',
                'id_prestamo' => $prestamo->id_prestamo,
                'fecha'       => $prestamo->fecha_prestamo
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al guardar préstamo: ' . $e->getMessage());
            return response()->json(['error' => 'Error al guardar el préstamo.'], 500);
        }
    }

    public function procesarDevolucion(Request $request)
    {
        $request->validate(['id_prestamo' => 'required|integer']);

        try {
            $prestamo = Prestamo::find($request->id_prestamo);
            if (!$prestamo) {
                return response()->json(['error' => 'Préstamo inexistente.'], 404);
            }
            if ($prestamo->devuelto) {
                return response()->json(['error' => 'Este préstamo ya fue devuelto.'], 400);
            }

            $ejemplares = DB::table('ejemplar_prestamo')
                ->where('id_prestamo', $prestamo->id_prestamo)
                ->pluck('id_ejemplar');

            Ejemplar::whereIn('id_ejemplar', $ejemplares)
                ->update(['disponibilidad' => 'Disponible']);

            $prestamo->devuelto = true;
            $prestamo->save();

            return response()->json([
                'success' => true,
                'message' => 'Devolución registrada correctamente.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en devolución: ' . $e->getMessage());
            return response()->json(['error' => 'Error al procesar la devolución.'], 500);
        }
    }
}
