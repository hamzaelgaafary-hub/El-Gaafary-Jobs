<?php

namespace Database\Seeders;

use App\Models\employer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        employer::factory(10)->create();
        user::factory(10)->create();
    }
}
