<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HabilitacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('habilitacao')->insert([
            // Add your docente data here
            [
                'id_funcionario' => 'b23193c6-df4d-4c1a-851c-d1ecc10137df',  'habilitacao' => 'Licenciatura','area_especialidade' => 'Saude',
                 'controlo_estado' =>'',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [
                'id_funcionario' => 'b23193c6-df4d-4c1a-851c-d1ecc10137df',  'habilitacao' => 'Licenciatura','area_especialidade' => 'Enfermagem',
                 'controlo_estado' =>'',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            
          
            
                
        
        ]);
    }
}
