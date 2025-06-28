<?php


namespace Database\Seeders;

use App\Models\Creator;
use Illuminate\Database\Seeder;

class CreatorSeeder extends Seeder
{
    public function run()
    {
        Creator::create(['creator' => 'Gabriel García Márquez']);
        Creator::create(['creator' => 'J.K. Rowling']);
    }
}
