<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TipoAdministrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('docentes')->insert([
            // Add your docente data here
            [
                'tipo_categoria' => 'Admin.Lab', 
                 'controlo_estado' =>'',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [
                'tipo_categoria' => 'Admin.Enf', 
                 'controlo_estado' =>'',  'created_at' => now(), 'updated_at' => now(),        
                
            ]
            
          
            
                
        
        ]);
    }
}
