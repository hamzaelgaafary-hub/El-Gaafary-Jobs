<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\job;
use App\Models\User;
use App\Models\Tag;
//  use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserStatusEnum;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test admin',
            'email' => 'admin@admin.com',
            'status' => UserStatusEnum::admin->value,
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
        
    }   
}
