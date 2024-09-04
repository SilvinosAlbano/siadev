<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example students data
        $students = [
            [
                'student_id' => (string) Str::uuid(),
                'complete_name' => 'John Doe',
                'gender' => 'Male',
                'place_of_birth' => 'New York',
                'date_of_birth' => '2000-01-01',
                'nre' => 'NRE001',
                'department_id' => (string) Str::uuid(),
                'semester_id' => (string) Str::uuid(),
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
                'department_id' => (string) Str::uuid(),
                'semester_id' => (string) Str::uuid(),
                'start_year' => 2024,
                'student_image' => null,
                'observation' => null,
            ],
            // Add more students as needed
        ];

        // Seed students and create corresponding users
        foreach ($students as $studentData) {
            // Create the student
            $student = Student::create($studentData);

            // Check if a user with the same username already exists
            $existingUser = User::where('username', $student->nre)->first();

            if (!$existingUser) {
                // Create the corresponding user using NRE as username
                User::create([
                    'username' => $student->nre, // Use NRE as username
                    'password' => Hash::make('password'), // Default password
                    'student_id' => $student->student_id,
                ]);
            } else {
                // Handle the duplicate username scenario (log, notify, or skip)
                echo "User with username {$student->nre} already exists. Skipping creation.\n";
            }
        }
    }
}
