<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Employer_id' => Employer::factory(),
            'title' => fake()->jobTitle(),
            'salary' => fake()->numberBetween(30000, 150000), // Store as an integer
            'location' => fake()->address(),
            'url' => fake()->url(),
            'type' => fake()->randomElement(['Full Time', 'Part Time', 'Freelance']),
            'featured' => fake()->boolean(),
        ];
    }
}
