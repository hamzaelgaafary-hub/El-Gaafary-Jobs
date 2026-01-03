<?php

namespace Database\Seeders;

use App\Models\employer;
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
        
        $this->call(JobSeeder::class);
        
    }
}
