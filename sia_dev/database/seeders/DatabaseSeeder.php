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
            StudentSeeder::class,
            UserSeeder::class,
            RolesTableSeeder::class,
            ModulesTableSeeder::class,
            StudentModulesRolesSeeder::class,
            MateriaSeeder::class,
            DocentesSeeder::class,
            MatriculaSeeder::class,
            MateriaSemestreSeeder::class,
            DocenteMateriaSeeder::class,
        ]);
    }
}
