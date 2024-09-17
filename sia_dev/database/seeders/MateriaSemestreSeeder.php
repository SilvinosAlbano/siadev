<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MateriaSemestreSeeder extends Seeder
{
    public function run()
    {
        DB::table('materia_semestre')->insert([
            [
                'id_materia_semestre' => Str::uuid(),
                'id_materia' => '0ded374e-0a18-483c-8a0d-1f85cb586bc6', // Replace with actual materia UUID
                'id_semestre' => 'd31b7134-2136-4235-9b4e-7420d971e9fa', // Replace with actual semester UUID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_materia_semestre' => Str::uuid(),
                'id_materia' => '0ded374e-0a18-483c-8a0d-1f85cb586bc6', // Replace with actual materia UUID
                'id_semestre' => 'd31b7134-2136-4235-9b4e-7420d971e9fa', // Replace with actual semester UUID
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
