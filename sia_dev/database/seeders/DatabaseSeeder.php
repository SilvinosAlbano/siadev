<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            FaculdadeSeeder::class,
            DepartamentoSeeder::class,
            ProgramaEstudoSeeder::class,
            SemestreSeeder::class,
            UnidadeCurricularSeeder::class,
            StudentSeeder::class,
            UserSeeder::class,
            RolesTableSeeder::class,
            ModulesTableSeeder::class,
            StudentModulesRolesSeeder::class,
            CurriculoEstudanteSeeder::class,
        ]);
    }
}
