<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Job;
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
            'employer_id' => Employer::factory(),
            'url' => fake()->url(),
            'featured' => fake()->boolean(),
            'location' => fake()->address(),
            'type' => fake()->randomElement(['full-time', 'part-time', 'contract', 'internship']),
            'salary' => fake()->numberBetween(30000, 150000), // Store as an integer
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Job $job) {
            // إضافة ترجمة إنجليزية
            $job->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                'title' => $this->faker->jobTitle,
                'description' => $this->faker->paragraph,
            ]);

            // إضافة ترجمة عربية (ممكن تستخدم بيانات ثابتة أو مكتبة Faker عربية)
            $job->translations()->updateOrCreate(
                ['locale' => 'ar'],
                 [
                    'title' => $this->faker->randomElement(['مطور برمجيات محترف', 'مصمم ويب', 'مدير مشاريع']),
                    'description' => 'تفاصيل الوظيفة باللغة العربية هنا...',
            ]);
            // إضافة ترجمة تركيه (ممكن تستخدم بيانات ثابتة أو مكتبة Faker عربية)
            $job->translations()->updateOrCreate(
                ['locale' => 'tr'],
                 [
                    'title' => $this->faker->randomElement(['Mühendis', 'Tasarımcı', 'Proje Müdürü']),
                    'description' => 'İş detayları Türkçe olarak burada...',
            ]);
        });
    }
}
