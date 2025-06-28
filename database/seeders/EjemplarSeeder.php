<?php

namespace Database\Seeders;

use App\Models\Ejemplar;
use Illuminate\Database\Seeder;

class EjemplarSeeder extends Seeder
{
    public function run()
    {
        Ejemplar::create([
            'id_catalogo' => 1,
            'ubicacion' => 'Estantería A1',
            'procedencia' => 'Compra',
            'estado_material' => 'Bueno',
            'disponibilidad' => true,
            'id_proveedor' => 1,
        ]);

        Ejemplar::create([
            'id_catalogo' => 2,
            'ubicacion' => 'Estantería B2',
            'procedencia' => 'Donación',
            'estado_material' => 'Excelente',
            'disponibilidad' => true,
            'id_proveedor' => 2,
        ]);
    }
}
