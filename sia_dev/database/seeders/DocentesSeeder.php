<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DocentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('funcionario')->insert([
            // Add your docente data here
            [
                'id_funcionario'=>'06eec12a-8e7d-4091-8b80-95ec26b95f13',
                'nome_funcionario' => 'Prof. Dr. SIlvino ALbano',
                'sexo' => 'Masculino',
                'id_municipio' => '00000000-0000-0000-0000-00000000000e',
                'id_posto_administrativo' => '00000000-0000-0000-0000-0000000001f3',
                'id_suco' => '00000000-0000-0000-0000-0000000001f3',
                'id_aldeias' => '00000000-0000-0000-0000-000000000922',
                'data_moris' => '1998-02-25',
                'nacionalidade' => 'Timorense',
                'categoria' => 'Docente',
                'ano_inicio' => '2014/06/06',
                'id_estatuto' => '83cca938-f283-3cab-8e50-efa4b9a8ddde',
                'observacao' => 'Diak',
                'no_contacto' => '77886654',
                'email' => 'itsilvioalbano@gmail.com',
                'id_tipo_categoria' => '0a5b5b4e-2e08-45dd-8bb8-1371444268b4',
                'photo_docente' => 'mamuk',
                'controlo_estado' => '',
                'created_at' => now(),
                'updated_at' => now(),

            ],



        ]);
    }
}
