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
                'nome_docente' => 'John Doe', 'sexo' => 'Masculino','municipio'=>'Aileu', 'posto_administrativo'=>'Remexio',
                  'suco' => 'Acumau', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014',
                'categoria_estatuto' => 'Permanente', 'departamento'=>'Saude', 'observacao' => 'Diak',    'photo_docente' =>'mamuk',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [  'nome_docente' => 'Ambere','sexo' => 'Femenino', 'municipio'=>'Aileu','suco' => 'Acubilitoho','posto_administrativo'=>'Likidoe',
                'data_moris' => '1997-02-25','nacionalidade' => 'Timorense','nivel_educacao' => 'S1', 'area_especialidade'=>'Saude',
                'universidade_origem' => 'ICS', 'ano_inicio' => '2014','categoria_estatuto' => 'Permanente', 'departamento'=>'Saude',
                'observacao' => 'Diak', 'photo_docente' =>'mamuk', 'created_at' => now(),'updated_at' => now(),             
                
            ],

            [
                'nome_docente' => 'Mario', 'sexo' => 'Masculino','municipio'=>'Aileu', 'posto_administrativo'=>'Remexio',
                  'suco' => 'Acumau', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014',
                'categoria_estatuto' => 'Permanente', 'departamento'=>'Saude', 'observacao' => 'Diak',    'photo_docente' =>'mamuk',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [  'nome_docente' => 'Paul','sexo' => 'Femenino', 'municipio'=>'Aileu','suco' => 'Acubilitoho','posto_administrativo'=>'Likidoe',
                'data_moris' => '1997-02-25','nacionalidade' => 'Timorense','nivel_educacao' => 'S1', 'area_especialidade'=>'Saude',
                'universidade_origem' => 'ICS', 'ano_inicio' => '2014','categoria_estatuto' => 'Permanente', 'departamento'=>'Saude',
                'observacao' => 'Diak', 'photo_docente' =>'mamuk', 'created_at' => now(),'updated_at' => now(),             
                
            ],
            [
                'nome_docente' => 'Anu Doe', 'sexo' => 'Masculino','municipio'=>'Aileu', 'posto_administrativo'=>'Remexio',
                  'suco' => 'Acumau', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014',
                'categoria_estatuto' => 'Permanente', 'departamento'=>'Saude', 'observacao' => 'Diak',    'photo_docente' =>'mamuk',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [  'nome_docente' => 'Jose Ambere','sexo' => 'Femenino', 'municipio'=>'Aileu','suco' => 'Acubilitoho','posto_administrativo'=>'Likidoe',
                'data_moris' => '1997-02-25','nacionalidade' => 'Timorense','nivel_educacao' => 'S1', 'area_especialidade'=>'Saude',
                'universidade_origem' => 'ICS', 'ano_inicio' => '2014','categoria_estatuto' => 'Permanente', 'departamento'=>'Saude',
                'observacao' => 'Diak', 'photo_docente' =>'mamuk', 'created_at' => now(),'updated_at' => now(),             
                
            ],


            [
                'nome_docente' => 'Aman Doe', 'sexo' => 'Masculino','municipio'=>'Aileu', 'posto_administrativo'=>'Remexio',
                  'suco' => 'Acumau', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014',
                'categoria_estatuto' => 'Permanente', 'departamento'=>'Saude', 'observacao' => 'Diak',    'photo_docente' =>'mamuk',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [  'nome_docente' => 'Francisco','sexo' => 'Femenino', 'municipio'=>'Aileu','suco' => 'Acubilitoho','posto_administrativo'=>'Likidoe',
                'data_moris' => '1997-02-25','nacionalidade' => 'Timorense','nivel_educacao' => 'S1', 'area_especialidade'=>'Saude',
                'universidade_origem' => 'ICS', 'ano_inicio' => '2014','categoria_estatuto' => 'Permanente', 'departamento'=>'Saude',
                'observacao' => 'Diak', 'photo_docente' =>'mamuk', 'created_at' => now(),'updated_at' => now(),             
                
            ],

            [
                'nome_docente' => 'Martino', 'sexo' => 'Masculino','municipio'=>'Aileu', 'posto_administrativo'=>'Remexio',
                  'suco' => 'Acumau', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014',
                'categoria_estatuto' => 'Permanente', 'departamento'=>'Saude', 'observacao' => 'Diak',    'photo_docente' =>'mamuk',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [  'nome_docente' => 'Mariano','sexo' => 'Femenino', 'municipio'=>'Aileu','suco' => 'Acubilitoho','posto_administrativo'=>'Likidoe',
                'data_moris' => '1997-02-25','nacionalidade' => 'Timorense','nivel_educacao' => 'S1', 'area_especialidade'=>'Saude',
                'universidade_origem' => 'ICS', 'ano_inicio' => '2014','categoria_estatuto' => 'Permanente', 'departamento'=>'Saude',
                'observacao' => 'Diak', 'photo_docente' =>'mamuk', 'created_at' => now(),'updated_at' => now(),             
                
            ],
            [
                'nome_docente' => 'Anu Ajoni', 'sexo' => 'Masculino','municipio'=>'Aileu', 'posto_administrativo'=>'Remexio',
                  'suco' => 'Acumau', 'data_moris' => '1998-02-25',  'nacionalidade' => 'Timorense',
                'nivel_educacao' => 'S1', 'area_especialidade'=>'Saude', 'universidade_origem' => 'ICS', 'ano_inicio' => '2014',
                'categoria_estatuto' => 'Permanente', 'departamento'=>'Saude', 'observacao' => 'Diak',    'photo_docente' =>'mamuk',  'created_at' => now(), 'updated_at' => now(),        
                
            ],
            [  'nome_docente' => 'Constancio Ambere','sexo' => 'Femenino', 'municipio'=>'Aileu','suco' => 'Acubilitoho','posto_administrativo'=>'Likidoe',
                'data_moris' => '1997-02-25','nacionalidade' => 'Timorense','nivel_educacao' => 'S1', 'area_especialidade'=>'Saude',
                'universidade_origem' => 'ICS', 'ano_inicio' => '2014','categoria_estatuto' => 'Permanente', 'departamento'=>'Saude',
                'observacao' => 'Diak', 'photo_docente' =>'mamuk', 'created_at' => now(),'updated_at' => now(),             
                
            ],
            
                
        
        ]);
    }
}
