<?php

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



it('can have Tags', function () {
    $job = Job::factory()->create(); 

    $job->Tag('frontend');

    expect($job->Tags)->toHaveCount(1);
});