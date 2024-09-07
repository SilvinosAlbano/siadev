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
            'id_departamento' => $this->faker->uuid,
            'departamento' => $this->faker->word,
            'faculdade' => 'Ciência de Saúde', // or use a default value if needed
        ];
    }
}
