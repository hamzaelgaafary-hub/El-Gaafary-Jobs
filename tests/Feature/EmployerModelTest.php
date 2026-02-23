<?php

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has a user relationship and returns the correct user', function () {
    $user = User::factory()->create();
    $employer = Employer::factory()->create(['user_id' => $user->id]);

    $this->assertTrue($employer->user()->exists());
    $this->assertEquals($user->id, $employer->user->id);
});

it('has many jobs and the association works', function () {
    $employer = Employer::factory()->create();

    // Create jobs that explicitly set the expected foreign key
    $jobA = Job::factory()->create(['employer_id' => $employer->id]);
    $jobB = Job::factory()->create(['employer_id' => $employer->id]);

    $jobs = $employer->job; // note: relationship defined as `job()` in model

    $this->assertCount(2, $jobs);
    expect($jobs->pluck('id')->toArray())->toContain($jobA->id)->toContain($jobB->id);
});
