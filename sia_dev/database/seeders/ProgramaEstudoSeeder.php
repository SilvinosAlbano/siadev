<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelProgramaEstudo;
use Carbon\Carbon;

class ProgramaEstudoSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $programasEstudo = [
            [
                'id_programa_estudo' => 'c4c82e2b-3f8f-4f98-83c3-0bb0b46d7b4b',
                'id_departamento' => 'b9f83367-7a25-4cb7-8c2f-3c7e91b50cdb', // Related to Enfarmagem
                'nome_programa' => 'Licenciatura em Enfarmagem',
                'duracao_anos' => 4,
                'tipo_programa' => 'Licenciatura',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_programa_estudo' => 'd9c2b6a8-b7c9-4bca-bc6e-1c0e9a6451ea',
                'id_departamento' => '91efb1e4-2e9d-4f72-bd62-59e40a09e6b6', // Related to Parteira
                'nome_programa' => 'Bacharelato em Parteira',
                'duracao_anos' => 3,
                'tipo_programa' => 'Bacharelato',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        ModelProgramaEstudo::insert($programasEstudo);
    }
}
