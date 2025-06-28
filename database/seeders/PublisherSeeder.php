<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    public function run()
    {
        Publisher::create(['publisher' => 'Penguin Random House']);
        Publisher::create(['publisher' => 'Planeta']);
    }
}

