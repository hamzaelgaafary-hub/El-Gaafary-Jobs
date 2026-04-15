<?php

use App\Models\User;
use Filament\Facades\Filament;

it('redirects employer users away from admin panel', function () {
    $employer = User::factory()->create([
        'type' => 'Employer',
        'email' => 'employer@test.com',
        'password' => bcrypt('password'),
    ]);

    // Check canAccessPanel returns false for Admin panel
    $adminPanel = Filament::getPanel('Admin');
    expect($employer->canAccessPanel($adminPanel))->toBeFalse();
});

it('allows employer users to access employer panel', function () {
    $employer = User::factory()->create([
        'type' => 'Employer',
        'email' => 'employer@test.com',
        'password' => bcrypt('password'),
    ]);

    // Check canAccessPanel returns true for Employer panel
    $employerPanel = Filament::getPanel('Employer');
    expect($employer->canAccessPanel($employerPanel))->toBeTrue();
});

it('allows admin users to access admin panel', function () {
    $admin = User::factory()->create([
        'type' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    // Check canAccessPanel returns true for Admin panel
    $adminPanel = Filament::getPanel('Admin');
    expect($admin->canAccessPanel($adminPanel))->toBeTrue();
});

it('redirects admin users away from employer panel', function () {
    $admin = User::factory()->create([
        'type' => 'Admin',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    // Check canAccessPanel returns false for Employer panel
    $employerPanel = Filament::getPanel('Employer');
    expect($admin->canAccessPanel($employerPanel))->toBeFalse();
});
