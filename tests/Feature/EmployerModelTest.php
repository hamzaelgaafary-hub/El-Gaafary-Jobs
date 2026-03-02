<?php

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has a user relationship and returns the correct user', function () {
    $user = User::factory()->create();
    $Employer = Employer::factory()->create(['user_id' => $user->id]);

    $this->assertTrue($Employer->user()->exists());
    $this->assertEquals($user->id, $Employer->user->id);
});

it('has many jobs and the association works', function () {
    $Employer = Employer::factory()->create();

    // Create jobs that explicitly set the expected foreign key
    $jobA = Job::factory()->create(['Employer_id' => $Employer->id]);
    $jobB = Job::factory()->create(['Employer_id' => $Employer->id]);

    $jobs = $Employer->job; // note: relationship defined as `job()` in model

    $this->assertCount(2, $jobs);
    expect($jobs->pluck('id')->toArray())->toContain($jobA->id)->toContain($jobB->id);
});
