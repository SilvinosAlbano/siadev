<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MateriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('materia')->insert([
            [
                'id_materia' => '0ded374e-0a18-483c-8a0d-1f85cb586bc6',
                'materia' => 'Mathematics',
                'codigo_materia' => 'MAT101',
                'creditos' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_materia' => Str::uuid(),
                'materia' => 'Physics',
                'codigo_materia' => 'PHY101',
                'creditos' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
