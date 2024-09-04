<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Department;
use App\Models\Semester;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $departments = Department::all();
        $semesters = Semester::all();

        Student::factory()->count(10)->create([
            'department_id' => $departments->random()->department_id,
            'semester_id' => $semesters->random()->semester_id,
        ]);
    }
}
