<?php

use App\Models\User;
use Filament\Panel;
use Spatie\Permission\Models\Role;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

it('allows a user with the admin role to access the Admin panel', function () {
    $user = User::factory()->create();

    Role::firstOrCreate(['name' => 'Admin']);
    $user->assignRole('Admin');

    $panel = Panel::make('Admin');

    expect($user->canAccessPanel($panel))->toBeTrue();
});

it('denies a user without the admin role from accessing the Admin panel', function () {
    $user = User::factory()->create();

    $panel = Panel::make('Admin');

    expect($user->canAccessPanel($panel))->toBeFalse();
});

it('allows a user with the employer role to access the Employer panel', function () {
    $user = User::factory()->create();

    Role::firstOrCreate(['name' => 'Employer']);
    $user->assignRole('Employer');

    $panel = Panel::make('Employer');

    expect($user->canAccessPanel($panel))->toBeTrue();
});

it('denies a user without the employer role from accessing the Employer panel', function () {
    $user = User::factory()->create();

    $panel = Panel::make('Employer');

    expect($user->canAccessPanel($panel))->toBeFalse();
});

it('denies access to an unrelated panel regardless of roles', function () {
    $user = User::factory()->create();

    Role::firstOrCreate(['name' => 'Admin']);
    $user->assignRole('Admin');

    $panel = Panel::make('SomeOther');

    expect($user->canAccessPanel($panel))->toBeFalse();
});