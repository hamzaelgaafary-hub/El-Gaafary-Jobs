<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows employers and job seekers', function () {
    $employer = \App\Models\Employer::factory()->create(['name' => 'Acme Corp']);
    $seeker = \App\Models\User::factory()->create(['name' => 'Bob', 'type' => 'JobSeeker']);

    $response = $this->get('/employers');

    $response->assertOk();
    $response->assertSee('Acme Corp');
    $response->assertSee('Bob');
});

it('filters lists when query provided', function () {
    \App\Models\Employer::factory()->create(['name' => 'Foo']);
    \App\Models\Employer::factory()->create(['name' => 'Bar']);
    \App\Models\User::factory()->create(['name' => 'Carol', 'type' => 'JobSeeker']);
    \App\Models\User::factory()->create(['name' => 'Dave', 'type' => 'JobSeeker']);

    $response = $this->get('/employers?q=Foo');
    $response->assertSee('Foo');
    $response->assertDontSee('Bar');
    $response->assertDontSee('Carol');

    $response2 = $this->get('/employers?q=Dave');
    $response2->assertSee('Dave');
    $response2->assertDontSee('Carol');
});
