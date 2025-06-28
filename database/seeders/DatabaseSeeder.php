<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta los seeders de la base de datos.
     */
    public function run(): void
    {
        $this->call([
            BibliotecarioSeeder::class,
            PublisherSeeder::class,
            CreatorSeeder::class,
            SubjectSeeder::class,
            CatalogoSeeder::class,
            ProveedorSeeder::class,
            EjemplarSeeder::class,
            MiembroSeeder::class,
            PrestamoSeeder::class,
        ]);
    }
}
