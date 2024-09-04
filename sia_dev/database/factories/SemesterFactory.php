<?php

namespace Database\Factories;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SemesterFactory extends Factory
{
    protected $model = Semester::class;

    public function definition()
    {
        return [
            'semester_id' => (string) Str::uuid(),
            'semester_name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
