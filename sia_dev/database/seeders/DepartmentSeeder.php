<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Define the departments data
        $departments = [
            [
                'department_id' => '83cca938-f283-3cab-8e50-efa4b9a8ddde',
                'department_name' => 'Desenvolvimento',
                'faculty' => 'Ciência de Saúde',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'department_id' => '91efb1e4-2e9d-4f72-bd62-59e40a09e6b6',
                'department_name' => 'Pesquisa e Inovação',
                'faculty' => 'Engenharia',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'department_id' => 'b65d90ae-6e9f-4d46-bce4-bd6b37d48976',
                'department_name' => 'Administração',
                'faculty' => 'Administração e Negócios',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'department_id' => 'd2d8d4f2-f032-47b7-88ae-6a2a5b71682d',
                'department_name' => 'Matemática Aplicada',
                'faculty' => 'Ciências Exatas',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'department_id' => 'c9e7415b-cb89-493e-82f0-03e30e905d82',
                'department_name' => 'Biologia Molecular',
                'faculty' => 'Ciências Biológicas',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Insert departments into the database
        DB::table('departments')->insert($departments);

        $this->command->info('Departments table seeded successfully!');
    }
}
