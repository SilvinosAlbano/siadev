<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\ModelDepartamento;
use App\Models\ModelSemestre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'id_student' => (string) Str::uuid(),
            'complete_name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'place_of_birth' => $this->faker->city,
            'date_of_birth' => $this->faker->date(),
            'nre' => $this->faker->numberBetween(100000, 999999),
            'id_departamento' => ModelDepartamento::factory(), // Ensure that Department exists
            'semester_id' => Semester::factory(), // Ensure that Semester exists
            'start_year' => $this->faker->year(),
            'student_image' => $this->faker->imageUrl(150, 150),
            'observation' => $this->faker->paragraph,
        ];
    }
}
