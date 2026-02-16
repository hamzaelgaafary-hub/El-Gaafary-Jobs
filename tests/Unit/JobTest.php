<?php

use App\Models\Employer;
use App\Models\Job;

test('example', function () {
    expect(true)->toBeTrue();
});


<<<<<<< HEAD
it('belongs to an employer', function () {
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_id' => $employer->id,
    ]);
    expect($job->employer->is($employer))->toBeTrue();
=======
it('belongs to an Employer', function () {
    $Employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'Employer_id' => $Employer->id,
    ]);
    expect($job->Employer->is($Employer))->toBeTrue();
>>>>>>> 328b122 (First commit from New pulled version)
});



<<<<<<< HEAD
it('can have tags', function () {
    $job = Job::factory()->create(); 

    $job->tag('frontend');

    expect($job->tags)->toHaveCount(1);
=======
it('can have Tags', function () {
    $job = Job::factory()->create(); 

    $job->Tag('frontend');

    expect($job->Tags)->toHaveCount(1);
>>>>>>> 328b122 (First commit from New pulled version)
});