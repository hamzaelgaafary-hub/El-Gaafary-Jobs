<?php

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Closure;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    $this->panelUser = User::factory()->create([
        'email' => 'Employer@Employer.com',
    ]);

    $this->editableUser = User::factory()->create();
    $this->EmployerOwner = User::factory()->create();
    $this->Employer = Employer::factory()->create([
        'user_id' => $this->EmployerOwner->id,
    ]);
    $this->job = Job::factory()->create([
        'Employer_id' => $this->Employer->id,
    ]);
});

it('redirects guests from protected Admin pages to Admin login', function (string $routeName, Closure $parametersResolver): void {
    $this->get(route($routeName, $parametersResolver($this)))
        ->assertRedirect();
})->with('Admin-protected-pages');

it('allows authenticated panel users to access protected Admin pages', function (string $routeName, Closure $parametersResolver): void {
    $this->actingAs($this->panelUser)
        ->get(route($routeName, $parametersResolver($this)))
        ->assertOk();
})->with('Admin-protected-pages');

it('forbids authenticated users who do not pass Admin panel access check', function (): void {
    $unauthorizedUser = User::factory()->create([
        'email' => 'unauthorized@example.com',
    ]);

    $this->actingAs($unauthorizedUser)
        ->get(route('filament.Admin.pages.dashboard'))
        ->assertForbidden();
});

it('allows guests to view Admin authentication pages', function (string $routeName): void {
    $this->get(route($routeName))->assertOk();
})->with([
    'login' => 'filament.Admin.auth.login',
    'register' => 'filament.Admin.auth.register',
]);

dataset('Admin-protected-pages', [
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
    'Employers index' => [
        'filament.Admin.resources.Employers.index',
        fn ($test): array => [],
    ],
    'Employers create' => [
        'filament.Admin.resources.Employers.create',
        fn ($test): array => [],
    ],
    'Employers edit' => [
        'filament.Admin.resources.Employers.edit',
        fn ($test): array => ['record' => $test->Employer],
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
    $Employer = Employer::factory()->create(['name' => 'ListEmployerTest']);
    $job = Job::factory()->create(['title' => 'ListJobTest', 'Employer_id' => $Employer->id]);

    // Index pages should be reachable and contain the created records' identifiers
    $this->get(route('filament.Admin.resources.users.index'))
        ->assertOk()
        ->assertSee('ListUserTest');

    $this->get(route('filament.Admin.resources.Employers.index'))
        ->assertOk()
        ->assertSee('ListEmployerTest');

    $this->get(route('filament.Admin.resources.jobs.index'))
        ->assertOk()
        ->assertSee('ListJobTest');
});

it('switches locale through filament-language-switcher route and keeps locale in session', function (): void {
    $this->get(route('filament-language-switcher.switch', ['code' => 'ar']))
        ->assertRedirect();

    $this->assertEquals('ar', session('locale'));
    $this->assertNotNull(cookie('filament_language_switcher_locale'));

    $this->actingAs($this->panelUser)
        ->withSession(['locale' => 'ar'])
        ->get(route('filament.Admin.pages.dashboard'))
        ->assertOk();

    $this->assertEquals('ar', app()->getLocale());
});
