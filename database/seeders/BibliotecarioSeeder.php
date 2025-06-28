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
            'nombre' => 'Ana',
            'apellido' => 'González',
            'contraseña' => Hash::make('admin123'),
        ]);
    }
}
