<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CurriculoEstudanteSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Fetch all students from the database
        $students = DB::table('students')->get();
        if ($students->isEmpty()) {
            $this->command->info('No students found in the database.');
            return;
        }

        // Define IDs based on your existing data
        $programaEstudoId = 'd9c2b6a8-b7c9-4bca-bc6e-1c0e9a6451ea'; // Example ID from ProgramaEstudoSeeder
        $semestreId = 'd31b7134-2136-4235-9b4e-7420d971e9fa'; // Example ID from UnidadeCurricularSeeder

        // Check if these IDs exist
        if (!DB::table('programa_estudo')->where('id_programa_estudo', $programaEstudoId)->exists()) {
            $this->command->error('Invalid id_programa_estudo: ' . $programaEstudoId);
            return;
        }

        if (!DB::table('semestre')->where('id_semestre', $semestreId)->exists()) {
            $this->command->error('Invalid id_semestre: ' . $semestreId);
            return;
        }

        $curriculosEstudantes = [];

        foreach ($students as $student) {
            // Add a debug statement to verify student IDs
            $this->command->info('Processing student ID: ' . $student->id_student);

            $curriculosEstudantes[] = [
                'id_curriculo_student' => (string) Str::uuid(),
                'id_student' => $student->id_student,
                'id_programa_estudo' => $programaEstudoId,
                'id_semestre' => $semestreId,
                'data_inicio' => $now,
                'data_fim' => null, // Set an end date if applicable
                'status' => 'Ativo',
                // 'created_at' => $now,
                // 'updated_at' => $now,
            ];
        }

        // Insert records into the curriculo_student table
        DB::table('curriculo_student')->insert($curriculosEstudantes);

        $this->command->info('Curriculo Student table seeded successfully with all students!');
    }
}
