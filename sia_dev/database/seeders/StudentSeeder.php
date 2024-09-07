<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $departments = DB::table('departamento')->pluck('id_departamento')->toArray();
        $semesters = DB::table('semesters')->pluck('semester_id')->toArray();

        $students = [
            [
                'student_id' => (string) Str::uuid(),
                'complete_name' => 'John Doe',
                'gender' => 'Male',
                'place_of_birth' => 'New York',
                'date_of_birth' => '2000-01-01',
                'nre' => 'NRE001',
                'department_id' => $departments[array_rand($departments)],
                'semester_id' => $semesters[array_rand($semesters)],
                'start_year' => 2024,
                'student_image' => null,
                'observation' => null,
            ],
            [
                'student_id' => (string) Str::uuid(),
                'complete_name' => 'Jane Smith',
                'gender' => 'Female',
                'place_of_birth' => 'Los Angeles',
                'date_of_birth' => '2001-02-02',
                'nre' => 'NRE002',
                'department_id' => $departments[array_rand($departments)],
                'semester_id' => $semesters[array_rand($semesters)],
                'start_year' => 2024,
                'student_image' => null,
                'observation' => null,
            ],
            [
                'student_id' => (string) Str::uuid(),
                'complete_name' => 'Pedro Modolay',
                'gender' => 'Male',
                'place_of_birth' => 'New York',
                'date_of_birth' => '1990-01-01',
                'nre' => 'NRE003',
                'department_id' => $departments[array_rand($departments)],
                'semester_id' => $semesters[array_rand($semesters)],
                'start_year' => 2024,
                'student_image' => null,
                'observation' => null,
            ],
            [
                'student_id' => (string) Str::uuid(),
                'complete_name' => 'Afonso Coolay',
                'gender' => 'Female',
                'place_of_birth' => 'Los Angeles',
                'date_of_birth' => '1992-02-02',
                'nre' => 'NRE004',
                'department_id' => $departments[array_rand($departments)],
                'semester_id' => $semesters[array_rand($semesters)],
                'start_year' => 2024,
                'student_image' => null,
                'observation' => null,
            ],
            // Add more students as needed
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
