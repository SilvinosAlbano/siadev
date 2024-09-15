<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelSemestre;
use Carbon\Carbon;

class SemestreSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $semestres = [
            [
                'id_semestre' => 'd31b7134-2136-4235-9b4e-7420d971e9fa',
                'numero_semestre' => 1,
                'ano_academico' => '2024',
                'id_programa_estudo' => 'd9c2b6a8-b7c9-4bca-bc6e-1c0e9a6451ea', // Bacharelato em Parteira
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semestre' => 'fd593edc-efc2-46d1-9fb5-8d0f81f245d6',
                'numero_semestre' => 2,
                'ano_academico' => '2024',
                'id_programa_estudo' => 'd9c2b6a8-b7c9-4bca-bc6e-1c0e9a6451ea', // Bacharelato em Parteira
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        ModelSemestre::insert($semestres);
    }
}
