<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelUser;
use App\Models\ModelStudent;
use App\Models\ModelDocente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $students = ModelStudent::all();
        $docentes = ModelDocente::all();

        foreach ($students as $student) {
            if (!ModelUser::where('username', $student->nre)->exists()) {
                ModelUser::create([
                    'user_id' => (string) Str::uuid(),
                    'username' => $student->nre,
                    'password' => Hash::make('password'),
                    'docente_id_student' => $student->id_student,
                    'tipo_usuario' => 'Estudante',
                ]);
            }
        }

        foreach ($docentes as $docente) {
            if (!ModelUser::where('username', $docente->nome_docente)->exists()) {
                ModelUser::create([
                    'user_id' => (string) Str::uuid(),
                    'username' => $student->nome_docente,
                    'password' => Hash::make('password'),
                    'docente_id_student' => $docente->id_docente,
                    'tipo_usuario' => 'Funcionario',
                ]);
            }
        }
    }
}
