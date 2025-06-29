<?php

namespace Database\Seeders;

use App\Models\Miembro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MiembroSeeder extends Seeder
{
    public function run()
    {
        Miembro::create([
            'nombre' => 'Pepe',
            'apellido' => 'Pérez',
            'dni' => '123456378',
            'correo' => 'carlos@example.com',
            'telefono' => '11123d45678',
            'direccion' => 'Calle Falsa 123',
            'tipo_miembro' => 'Estudiante',
            'usuario' => 'carlos1s223',
            'contraseña' => Hash::make('123456'),
        ]);
    }
}
