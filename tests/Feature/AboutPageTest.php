<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the about page with platform stats', function () {
    // create some records to count
    \App\Models\Job::factory(3)->create();
    \App\Models\Employer::factory(2)->create();
    \App\Models\User::factory(4)->create(['type' => 'JobSeeker']);

    $response = $this->get('/about');

    $response->assertOk();
    // use assertSeeHtml to handle encoding
    $response->assertSeeHtml('About & Contact');
    $response->assertSee('jobs posted');
    $response->assertSee('employers');
    $response->assertSee('job seekers');
});
