<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tags = Tag::factory(3)->create();

        Tag::factory()->hasJobs(10)->create();

        Job::factory(10)->hasAttached($Tags)->create(new Sequence([
            'featured' => false,
            'type' => 'Full Time',
        ], [
            'featured' => true,
            'type' => 'Part Time',
        ]));
    }
}
