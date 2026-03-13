<?php

namespace Database\Seeders;

use App\Enums\UserStatusEnum;
//  use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\EmployerSeeder;
use Database\Seeders\JobSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'Admin@Admin.com',
            'type' => 'Admin',
            'status' => UserStatusEnum::Admin->value,
            'password' => '123456789',
        ]);
        User::factory()->create([
            'name' => 'Test Employer',
            'email' => 'Employer@Employer.com',
            'type' => 'Employer',
            'status' => UserStatusEnum::Employer->value,
            'password' => '123456789',
        ]);
        User::factory()->create([
            'name' => 'Test job seeker',
            'email' => 'jobseeker@jobseeker.com',
            'status' => UserStatusEnum::JobSeeker->value,
            'password' => '123456789',
        ]);
        
        $this->call([     
            //EmployerSeeder::class,
            JobSeeder::class,
        ]);
    }
}
