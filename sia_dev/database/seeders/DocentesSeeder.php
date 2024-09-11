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
                  'id_suco' => '83cca938-f283-3cab-8e50-efa4b9a8ddde', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense','categoria' => 'Docente',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014/06/06',
                'id_estatuto' => '83cca938-f283-3cab-8e50-efa4b9a8ddde', 'id_departamento'=>'83cca938-f283-3cab-8e50-efa4b9a8ddde', 'observacao' => 'Diak','id_tipo_categoria' => '0a5b5b4e-2e08-45dd-8bb8-1371444268b4','photo_docente' =>'mamuk','controlo_estado' =>'',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            
          
            
                
        
        ]);
    }
}
