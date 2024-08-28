<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition()
    {
        return [
            'department_id' => $this->faker->uuid,
            'department_name' => $this->faker->word,
            'faculty' => 'Ciência de Saúde', // or use a default value if needed
        ];
    }
}
