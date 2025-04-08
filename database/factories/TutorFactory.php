<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tutor>
 */
class TutorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subjects' => json_encode(['MCR3U1', 'MPM2D1', 'ICS4U1']),
            'phone_number' => '1-123-456-789',
            'user_id' => User::factory(),
        ];
    }
}
