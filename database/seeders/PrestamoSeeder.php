<?php

namespace Database\Seeders;

use App\Models\Prestamo;
use Illuminate\Database\Seeder;

class PrestamoSeeder extends Seeder
{
    public function run()
    {
        $prestamo = Prestamo::create([
            'fecha_prestamo' => now()->subDays(5),
            'devuelto' => false,
            'id_miembro' => 1,
        ]);

        $prestamo->ejemplares()->attach([1]);
    }
}

