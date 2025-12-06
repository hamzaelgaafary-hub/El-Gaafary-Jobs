<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

use App\Models\Employer;
use App\Models\Job;

test('example', function () {
    expect(true)->toBeTrue();
});


it('belongs to an employer', function () {
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_id' => $employer->id,
    ]);
    expect($job->employer->is($employer))->toBeTrue();
});




