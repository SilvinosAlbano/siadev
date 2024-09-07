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
        $departamento = [
            [
                'id_departamento' => '83cca938-f283-3cab-8e50-efa4b9a8ddde',
                'departamento' => 'Desenvolvimento',
                'faculdade' => 'Ciência de Saúde',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_departamento' => '91efb1e4-2e9d-4f72-bd62-59e40a09e6b6',
                'departamento' => 'Pesquisa e Inovação',
                'faculdade' => 'Engenharia',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_departamento' => 'b65d90ae-6e9f-4d46-bce4-bd6b37d48976',
                'departamento' => 'Administração',
                'faculdade' => 'Administração e Negócios',
                'created_at' => $now,
                'updated_at' => $now,
            ],
           
        ];

        // Insert departments into the database
        DB::table('departamento')->insert($departamento);

        $this->command->info('Departments table seeded successfully!');
    }
}
