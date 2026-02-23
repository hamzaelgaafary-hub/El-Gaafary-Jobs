<?php

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Closure;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $this->panelUser = User::factory()->create([
        'email' => 'employer@employer.com',
    ]);

    $this->editableUser = User::factory()->create();
    $this->employerOwner = User::factory()->create();
    $this->employer = Employer::factory()->create([
        'user_id' => $this->employerOwner->id,
    ]);
    $this->job = Job::factory()->create([
        'employer_id' => $this->employer->id,
    ]);
});

it('redirects guests from protected admin pages to admin login', function (string $routeName, Closure $parametersResolver): void {
    $this->get(route($routeName, $parametersResolver($this)))
        ->assertRedirect();
})->with('admin-protected-pages');

it('allows authenticated panel users to access protected admin pages', function (string $routeName, Closure $parametersResolver): void {
    $this->actingAs($this->panelUser)
        ->get(route($routeName, $parametersResolver($this)))
        ->assertOk();
})->with('admin-protected-pages');

it('forbids authenticated users who do not pass admin panel access check', function (): void {
    $unauthorizedUser = User::factory()->create([
        'email' => 'unauthorized@example.com',
    ]);

    $this->actingAs($unauthorizedUser)
        ->get(route('filament.Admin.pages.dashboard'))
        ->assertForbidden();
});

it('allows guests to view admin authentication pages', function (string $routeName): void {
    $this->get(route($routeName))->assertOk();
})->with([
    'login' => 'filament.Admin.auth.login',
    'register' => 'filament.Admin.auth.register',
]);

dataset('admin-protected-pages', [
    'dashboard' => [
        'filament.Admin.pages.dashboard',
        fn ($test): array => [],
    ],
    'users index' => [
        'filament.Admin.resources.users.index',
        fn ($test): array => [],
    ],
    'users create' => [
        'filament.Admin.resources.users.create',
        fn ($test): array => [],
    ],
    'users edit' => [
        'filament.Admin.resources.users.edit',
        fn ($test): array => ['record' => $test->editableUser],
    ],
    'jobs index' => [
        'filament.Admin.resources.jobs.index',
        fn ($test): array => [],
    ],
    'jobs create' => [
        'filament.Admin.resources.jobs.create',
        fn ($test): array => [],
    ],
    'jobs edit' => [
        'filament.Admin.resources.jobs.edit',
        fn ($test): array => ['record' => $test->job],
    ],
    'employers index' => [
        'filament.Admin.resources.employers.index',
        fn ($test): array => [],
    ],
    'employers create' => [
        'filament.Admin.resources.employers.create',
        fn ($test): array => [],
    ],
    'employers edit' => [
        'filament.Admin.resources.employers.edit',
        fn ($test): array => ['record' => $test->employer],
    ],
    'tags index' => [
        'filament.Admin.resources.tags.index',
        fn ($test): array => [],
    ],
]);

it('shows created records on resource index pages', function (): void {
    $this->actingAs($this->panelUser);

    // Create identifiable records
    $user = User::factory()->create(['name' => 'ListUserTest']);
    $employer = Employer::factory()->create(['name' => 'ListEmployerTest']);
    $job = Job::factory()->create(['title' => 'ListJobTest', 'employer_id' => $employer->id]);

    // Index pages should be reachable and contain the created records' identifiers
    $this->get(route('filament.Admin.resources.users.index'))
        ->assertOk()
        ->assertSee('ListUserTest');

    $this->get(route('filament.Admin.resources.employers.index'))
        ->assertOk()
        ->assertSee('ListEmployerTest');

    $this->get(route('filament.Admin.resources.jobs.index'))
        ->assertOk()
        ->assertSee('ListJobTest');
});
