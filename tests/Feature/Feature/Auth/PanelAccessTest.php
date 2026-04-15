<?php

use App\Models\User;
use Filament\Facades\Filament;

it('allows admin users to access admin panel', function () {
    $admin = User::factory()->create(['type' => 'Admin']);

    $panel = Filament::getPanel('Admin');

    expect($admin->canAccessPanel($panel))->toBeTrue();
});

it('prevents employer users from accessing admin panel', function () {
    $employer = User::factory()->create(['type' => 'Employer']);

    $panel = Filament::getPanel('Admin');

    expect($employer->canAccessPanel($panel))->toBeFalse();
});

it('allows employer users to access employer panel', function () {
    $employer = User::factory()->create(['type' => 'Employer']);

    $panel = Filament::getPanel('Employer');

    expect($employer->canAccessPanel($panel))->toBeTrue();
});

it('prevents admin users from accessing employer panel', function () {
    $admin = User::factory()->create(['type' => 'Admin']);

    $panel = Filament::getPanel('Employer');

    expect($admin->canAccessPanel($panel))->toBeFalse();
});

it('allows jobseeker users to access jobseeker panel', function () {
    $jobseeker = User::factory()->create(['type' => 'JobSeeker']);

    $panel = Filament::getPanel('jobseeker');

    expect($jobseeker->canAccessPanel($panel))->toBeTrue();
});

it('prevents employer users from accessing jobseeker panel', function () {
    $employer = User::factory()->create(['type' => 'Employer']);

    $panel = Filament::getPanel('jobseeker');

    expect($employer->canAccessPanel($panel))->toBeFalse();
});
