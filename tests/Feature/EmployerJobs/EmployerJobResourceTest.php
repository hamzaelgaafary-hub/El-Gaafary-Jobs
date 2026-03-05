<?php

namespace Tests\Feature\EmployerJobs;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('only shows jobs belonging to employers owned by the authenticated user', function () {
    $user = User::factory()->create([
        'type' => 'Employer',
    ]);

    // user has two employers
    $employerA = Employer::factory()->for($user)->create();
    $employerB = Employer::factory()->for($user)->create();

    // a job that belongs to a different user
    $otherEmployer = Employer::factory()->create();

    $jobA = Job::factory()->for($employerA)->create();
    $jobB = Job::factory()->for($employerB)->create();
    $jobOther = Job::factory()->for($otherEmployer)->create();

    actingAs($user);

    // hitting the panel page will load the same query used by the
    // resource; confirming the HTTP response shows the right titles is a
    // more realistic end‑to‑end check.
    $this->get('/Employer/employer-jobs')
        ->assertOk()
        ->assertSee($jobA->title)
        ->assertSee($jobB->title)
        ->assertDontSee($jobOther->title);
});
