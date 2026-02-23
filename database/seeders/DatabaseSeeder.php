<?php

namespace Database\Seeders;

use App\Enums\UserStatusEnum;
//  use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@admin.com',
            'status' => UserStatusEnum::Admin->value,
            'password' => '123456789',
        ]);
        User::factory()->create([
            'name' => 'Test Employer',
            'email' => 'employer@employer.com',
            'status' => UserStatusEnum::Employer->value,
            'password' => '123456789',
        ]);
        User::factory()->create([
            'name' => 'Test job seeker',
            'email' => 'jobseeker@jobseeker.com',
            'status' => UserStatusEnum::JobSeeker->value,
            'password' => '123456789',
        ]);
        $this->call(JobSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);

    }
}
