<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\ModelDocente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();
        $docentes = ModelDocente::all();

        foreach ($students as $student) {
            if (!User::where('username', $student->nre)->exists()) {
                User::create([
                    'user_id' => (string) Str::uuid(),
                    'username' => $student->nre,
                    'password' => Hash::make('password'),
                    'docente_student_id' => $student->student_id,
                    'tipo_usuario'=>'Estudante',
                ]);
            }
        }

        foreach ($docentes as $docente) {
            if (!User::where('username', $docente->nome_docente)->exists()) {
                User::create([
                    'user_id' => (string) Str::uuid(),
                    'username' => $student->nome_docente,
                    'password' => Hash::make('password'),
                    'docente_student_id' => $docente->id_docente,
                    'tipo_usuario'=>'Funcionario',
                ]);
            }
        }
    }
}
