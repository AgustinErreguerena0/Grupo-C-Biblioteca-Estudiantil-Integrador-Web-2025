<?php

namespace Database\Seeders;

use App\Models\Bibliotecario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BibliotecarioSeeder extends Seeder
{
    public function run()
    {
        Bibliotecario::create([
            'nombre'    => 'Ana',
            'apellido'  => 'González',
            'dni'       => '12345678',
            'correo'    => 'ana.gonzalez@biblioteca.com',
            'telefono'  => '1122334455',
            'direccion' => 'Av. Siempre Viva 123',
            'usuario'   => 'ana_admin',
            'contraseña'=> Hash::make('admin123'),
        ]);
    }
}

