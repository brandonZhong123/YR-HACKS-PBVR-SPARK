<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'code' => $this->faker->unique()->bothify('CS###'),
            'grade' => $this->faker->numberBetween(1, 12),
            'subject' => $this->faker->word,
            'type' => $this->faker->randomElement(['core', 'elective']),
        ];
    }
}
