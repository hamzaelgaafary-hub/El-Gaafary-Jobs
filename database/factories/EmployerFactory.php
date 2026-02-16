<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
<<<<<<< HEAD
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employer>
=======
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
>>>>>>> 328b122 (First commit from New pulled version)
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'logo' => $this->faker->imageUrl(),
            'user_id' => user::factory(),
        ];
    }
}
