<?php

namespace Database\Seeders;
use App\Models\Catalogo;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    public function run()
    {
        $catalogo1 = Catalogo::create([
            'title' => 'Cien años de soledad',
            'subject' => 'Novela',
            'description' => 'Obra maestra del realismo mágico',
            'date' => '1967-05-30',
            'type' => 'Libro',
            'identifier' => 'ISBN1234567890',
            'language' => 'Español',
            'format' => 'Impreso',
            'rights' => 'Reservados',
            'id_bibliotecario' => 1,
            'id_publisher' => 1,
        ]);

        $catalogo1->creators()->attach([1]);
        $catalogo1->subjects()->attach([1]);

        $catalogo2 = Catalogo::create([
            'title' => 'Harry Potter y la piedra filosofal',
            'subject' => 'Novela juvenil',
            'description' => 'Inicio de la saga mágica',
            'date' => '1997-06-26',
            'type' => 'Libro',
            'identifier' => 'ISBN9876543210',
            'language' => 'Español',
            'format' => 'Impreso',
            'rights' => 'Reservados',
            'id_bibliotecario' => 1,
            'id_publisher' => 2,
        ]);

        $catalogo2->creators()->attach([2]);
        $catalogo2->subjects()->attach([2]);
    }
}

