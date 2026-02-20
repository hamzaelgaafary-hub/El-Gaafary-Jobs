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


it('belongs to an Employer', function () {
    $Employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'Employer_id' => $Employer->id,
    ]);
    expect($job->Employer->is($Employer))->toBeTrue();
});




