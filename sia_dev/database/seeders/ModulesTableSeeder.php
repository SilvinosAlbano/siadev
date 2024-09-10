<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModulesTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Define the modules data with unique UUIDs
        $modules = [
            [
                'id_module' => 'd2d8d3e7-bf3f-4c0d-a05b-f6e1d1a6726e',
                'module_name' => 'Gestão Docentes',
                'description' => 'teachers',
                'module_key' => 'teachers',
                'created_at' => $now,
                'updated_at' => null,
            ],
            [
                'id_module' => 'b1e7c3d9-0c5f-4b78-8731-ef7e3e1b8c6e',
                'module_name' => 'Gestão Usuários',
                'description' => 'users',
                'module_key' => 'users',
                'created_at' => $now,
                'updated_at' => null,
            ],
            [
                'id_module' => 'f2d3c4b1-9189-4e27-9b5a-f7e6a7f8d8e9',
                'module_name' => 'Gestão Estudantes',
                'description' => 'students',
                'module_key' => 'students',
                'created_at' => $now,
                'updated_at' => null,
            ],
            [
                'id_module' => 'c2e8e8b6-4d4a-4b2e-bc1b-3c4e5f6a7a8b',
                'module_name' => 'Gestão Disciplinas',
                'description' => 'subjects',
                'module_key' => 'subjects',
                'created_at' => $now,
                'updated_at' => null,
            ],
            [
                'id_module' => 'a7d8f2e0-8d4e-4b7f-8b2a-3c8e4f9d5e6a',
                'module_name' => 'Gestão Classes',
                'description' => 'classes',
                'module_key' => 'classes',
                'created_at' => $now,
                'updated_at' => null,
            ],
            [
                'id_module' => 'e9c3b7e8-9f1c-4d6e-8a9b-2c7e8f6d4a9b',
                'module_name' => 'Gestão Atendedimentos',
                'description' => 'attendences',
                'module_key' => 'attendences',
                'created_at' => $now,
                'updated_at' => null,
            ],
        ];

        // Insert modules into the database
        DB::table('modules')->insert($modules);

        $this->command->info('Modules table seeded successfully!');
    }
}
