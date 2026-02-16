<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\employer;
=======
use App\Models\Employer;
use App\Models\User;
>>>>>>> 328b122 (First commit from New pulled version)
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        employer::factory(10)->create();

=======
        Employer::factory(10)->create();
        user::factory(10)->create();
>>>>>>> 328b122 (First commit from New pulled version)
    }
}
