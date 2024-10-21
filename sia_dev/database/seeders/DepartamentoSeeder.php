<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelDepartamento;
use Carbon\Carbon;

class DepartamentoSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Define the departments data
        $departamento = [
            [
                'id_departamento' => 'b9f83367-7a25-4cb7-8c2f-3c7e91b50cdb',
                'nome_departamento' => 'Enfermagem',
                'id_faculdade' => '1d1b3f74-16f0-4b14-bd36-4eae2a6b3c1d',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_departamento' => '91efb1e4-2e9d-4f72-bd62-59e40a09e6b6',
                'nome_departamento' => 'Parteira',
                'id_faculdade' => '1d1b3f74-16f0-4b14-bd36-4eae2a6b3c1d',
                'created_at' => $now,
                'updated_at' => $now,
                
            ],
        ];

        // Insert departments into the database
        ModelDepartamento::insert($departamento); // Use the model to insert data

        $this->command->info('Departments table seeded successfully!');
    }
}
