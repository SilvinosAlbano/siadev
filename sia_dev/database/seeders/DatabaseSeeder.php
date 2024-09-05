<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            DepartmentSeeder::class,
            SemesterSeeder::class,
            StudentSeeder::class,
            UserSeeder::class,
            RolesTableSeeder::class,
            ModulesTableSeeder::class,
            StudentModulesRolesSeeder::class,
        ]);
    }
}
