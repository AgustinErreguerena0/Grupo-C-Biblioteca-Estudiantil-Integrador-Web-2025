<?php

namespace Database\Seeders;

use App\Models\Ejemplar;
use Illuminate\Database\Seeder;

class EjemplarSeeder extends Seeder
{
    public function run()
    {
        Ejemplar::create([
            'id_publico' => 'EJ0001',
            'ubicacion' => 'Estantería A1',
            'procedencia' => 'Compra',
            'estado_material' => 'Bueno',
            'disponibilidad' => 'Disponible',
            'id_catalogo' => 1,
            'id_proveedor' => 1,
        ]);

        Ejemplar::create([
            'id_publico' => 'EJ0002',
            'ubicacion' => 'Estantería B2',
            'procedencia' => 'Donación',
            'estado_material' => 'Excelente',
            'disponibilidad' => 'No disponible',
            'id_catalogo' => 2,
            'id_proveedor' => 2,
        ]);
    }
}
