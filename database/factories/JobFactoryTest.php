<?php

namespace Tests\Unit;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the JobFactory can create a job.
     */
    public function test_it_can_create_a_job(): void
    {
        $job = Job::factory()->create();

        $this->assertInstanceOf(Job::class, $job);
        $this->assertInstanceOf(Employer::class, $job->Employer);

        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'title' => $job->title,
            'salary' => $job->salary,
            'location' => $job->location,
            'Employer_id' => $job->Employer_id,
        ]);
    }
}
