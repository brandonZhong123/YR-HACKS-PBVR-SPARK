<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'individual_course_id' => 1, // Replace with dynamic course ID if needed
            'name' => $this->faker->word(),
            'completed' => false,
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'), // Random date between now and 1 month from now
            'feedback' => $this->faker->sentence(),
            'mark' => $this->faker->numberBetween(0, 100),
            'weight' => $this->faker->numberBetween(1, 100),
        ];
    }
}
