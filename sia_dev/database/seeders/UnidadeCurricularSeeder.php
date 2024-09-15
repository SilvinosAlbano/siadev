<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UnidadeCurricularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $unidadesCurriculares = [
            [
                'id_unidade_curricular' => 'e77f2e7d-d6e5-4d3e-9c14-758bbd6b972b',
                'unidade_curricular' => 'Microbiologia I',
                'creditos' => 6,
                'id_semestre' => 'd31b7134-2136-4235-9b4e-7420d971e9fa', // Referencing the first semestre
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_unidade_curricular' => 'b40d6d6e-89b4-4c47-b6f6-2b9c3f8b8d86',
                'unidade_curricular' => 'Microbiologia II',
                'creditos' => 6,
                'id_semestre' => 'fd593edc-efc2-46d1-9fb5-8d0f81f245d6', // Referencing the second semestre
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('unidade_curricular')->insert($unidadesCurriculares);
    }
}
