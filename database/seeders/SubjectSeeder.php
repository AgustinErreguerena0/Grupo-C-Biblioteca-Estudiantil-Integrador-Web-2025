<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        Subject::create(['subject' => 'Literatura']);
        Subject::create(['subject' => 'Fantasía']);
    }
}

