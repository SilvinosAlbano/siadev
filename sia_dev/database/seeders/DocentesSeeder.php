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
        DB::table('docentes')->insert([
            // Add your docente data here
            [
                'nome_docente' => 'John Doe', 'sexo' => 'Masculino','id_municipio'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde', 'id_posto_administrativo'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde',
                  'id_suco' => '83cca938-f283-3cab-8e50-efa4b9a8ddde', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014/06/06',
                'id_estatuto' => '83cca938-f283-3cab-8e50-efa4b9a8ddde', 'id_departamento'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde', 'observacao' => 'Diak',    'photo_docente' =>'mamuk',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [  'nome_docente' => 'Ambere','sexo' => 'Femenino', 'id_municipio'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde','id_suco' => '83cca938-f283-3cab-8e50-efa4b9a8ddde','id_posto_administrativo'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde',
                'data_moris' => '1997-02-25','nacionalidade' => 'Timorense','nivel_educacao' => 'S1', 'area_especialidade'=>'Saude',
                'universidade_origem' => 'ICS', 'ano_inicio' => '2014/06/06','id_estatuto' => '83cca938-f283-3cab-8e50-efa4b9a8ddde', 'id_departamento'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde',
                'observacao' => 'Diak', 'photo_docente' =>'mamuk', 'created_at' => now(),'updated_at' => now(),             
                
            ],

            [
                'nome_docente' => 'Mario', 'sexo' => 'Masculino','id_municipio'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde', 'id_posto_administrativo'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde',
                  'id_suco' => '83cca938-f283-3cab-8e50-efa4b9a8ddde', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014/06/06',
                'id_estatuto' => '83cca938-f283-3cab-8e50-efa4b9a8ddde', 'id_departamento'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde', 'observacao' => 'Diak',    'photo_docente' =>'mamuk',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
          
            
                
        
        ]);
    }
}
