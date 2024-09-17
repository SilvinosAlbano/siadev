<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DocenteMateriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('docente_materia')->insert([
            [
                'id_docente_materia' => Str::uuid(),
                'id_funcionario' => '06eec12a-8e7d-4091-8b80-95ec26b95f13', // Replace with actual funcionario UUID
                'id_materia' => '0ded374e-0a18-483c-8a0d-1f85cb586bc6',
                'data_inicio' => '2023-09-01',
                'data_fim' => null,
                'status' => 'Ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_docente_materia' => Str::uuid(),
                'id_funcionario' => '06eec12a-8e7d-4091-8b80-95ec26b95f13',
                'id_materia' => '0ded374e-0a18-483c-8a0d-1f85cb586bc6',
                'data_inicio' => '2022-09-01',
                'data_fim' => '2023-09-01',
                'status' => 'Concluído',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
