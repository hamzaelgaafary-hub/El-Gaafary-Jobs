<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory(3)->create();

        Tag::factory()->hasJobs(10)->create();
        

        Job::factory(10)->hasAttached($tags)->create(new Sequence([
            'featured' => false,
            'type' => 'Full Time',
        ], [
            'featured' => true,
            'type' => 'Part Time',
        ]));
    }
}
