<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employer>
 */
class employerFactory extends Factory
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
            'website' => $this->faker->url(),
            'logo' => $this->faker->image(),
            'description' => $this->faker->paragraph,
            'user_id' => user::factory(),

        ];
    }

    /*
     public function configure()
    {
        return $this->afterCreating(function (Employer $employer) {
            // إضافة ترجمة إنجليزية
            $employer->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                'description' => $this->faker->paragraph,
            ]);

            // إضافة ترجمة عربية (ممكن تستخدم بيانات ثابتة أو مكتبة Faker عربية)
            $employer->translations()->updateOrCreate(
                ['locale' => 'ar'],
                 [
                    'description' => 'تفاصيل الوظيفة باللغة العربية هنا...',
            ]);

            // إضافة ترجمة تركيه (ممكن تستخدم بيانات ثابتة أو مكتبة Faker عربية)
            $employer->translations()->updateOrCreate(
                ['locale' => 'tr'],
                 [
                    'description' => 'İş detayları Türkçe olarak burada...',
            ]);
        });
    }
        */
}
