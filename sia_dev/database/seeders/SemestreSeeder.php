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

        $semestre = [
            [
                'id_semestre' => 'd31b7134-2136-4235-9b4e-7420d971e9fa',
                'periodo' => 1,
                'ano_academico' => '2024',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_semestre' => 'fd593edc-efc2-46d1-9fb5-8d0f81f245d6',
                'periodo' => 2,
                'ano_academico' => '2024',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        ModelSemestre::insert($semestre);
    }
}
