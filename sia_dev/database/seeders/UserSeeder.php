<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            if (!User::where('username', $student->nre)->exists()) {
                User::create([
                    'user_id' => (string) Str::uuid(),
                    'username' => $student->nre,
                    'password' => Hash::make('password'),
                    'student_id' => $student->student_id,
                ]);
            }
        }
    }
}
