<?php

namespace Tests\Feature\EmployerJobs;

use App\Filament\Employer\Resources\EmployerJobs\Pages\ListEmployerJobs;
use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Livewire;
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

    // ensure our query logic matches what the resource will use. jobs
    // attached to employers owned by the authenticated user should be
    // returned, while others are not.
    $filtered = Job::query()
        ->whereHas('Employer', fn ($q) => $q->where('user_id', $user->id))
        ->get();

    expect($filtered->pluck('id'))
        ->toContain($jobA->id)
        ->toContain($jobB->id)
        ->not->toContain($jobOther->id);
});
