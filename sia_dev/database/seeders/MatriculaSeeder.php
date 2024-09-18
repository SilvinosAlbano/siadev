<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MatriculaSeeder extends Seeder
{
    public function run()
    {
        DB::table('matricula')->insert([
            [
                'id_matricula' => Str::uuid(),
                'id_student' => '3e5b9619-cfd3-4f4d-bdd9-e36e3ded1b15',
                'id_programa_estudo' => 'c4c82e2b-3f8f-4f98-83c3-0bb0b46d7b4b',
                'id_semestre' => 'd31b7134-2136-4235-9b4e-7420d971e9fa',
                'data_inicio' => '2023-09-01',
                'data_fim' => null,
                'status' => 'Ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matricula' => Str::uuid(),
                'id_student' => 'd7accbc8-c784-4c30-acc4-7e27ebf61f35',
                'id_programa_estudo' => 'c4c82e2b-3f8f-4f98-83c3-0bb0b46d7b4b',
                'id_semestre' => 'd31b7134-2136-4235-9b4e-7420d971e9fa',
                'data_inicio' => '2023-09-01',
                'data_fim' => null,
                'status' => 'Concluído',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
