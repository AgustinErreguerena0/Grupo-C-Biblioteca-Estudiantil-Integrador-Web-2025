<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        Proveedor::create(['proveedor' => 'Distribuidora Sudamericana']);
        Proveedor::create(['proveedor' => 'Librería El Ateneo']);
    }
}
