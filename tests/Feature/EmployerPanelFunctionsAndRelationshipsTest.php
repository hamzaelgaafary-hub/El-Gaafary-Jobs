<?php

use App\Filament\Employer\Resources\EmployerJobs\EmployerJobResource;
use App\Filament\Employer\Resources\Employers\EmployerResource as EmployerPanelEmployerResource;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;

beforeEach(function (): void {
    $this->panelUser = User::factory()->create([
        'name' => 'Employer Panel User',
        'email' => 'Employer@Employer.com',
    ]);

    $this->Employer = Employer::factory()->create([
        'user_id' => $this->panelUser->id,
    ]);

    $this->job = Job::factory()->create([
        'Employer_id' => $this->Employer->id,
    ]);
});

it('redirects guests from protected Employer pages to Employer login', function (string $routeName, Closure $parametersResolver): void {
    $this->get(route($routeName, $parametersResolver($this)))
        ->assertRedirect(route('filament.Employer.auth.login'));
})->with('Employer-protected-pages');

it('allows authenticated panel users to access Employer pages', function (string $routeName, Closure $parametersResolver): void {
    $this->actingAs($this->panelUser)
        ->get(route($routeName, $parametersResolver($this)))
        ->assertOk();
})->with('Employer-accessible-pages');

it('forbids creating an Employer record through Employer panel resource', function (): void {
    $this->actingAs($this->panelUser)
        ->get(route('filament.Employer.resources.Employers.create'))
        ->assertForbidden();
});

it('forbids authenticated users who do not pass Employer panel access check', function (): void {
    $unauthorizedUser = User::factory()->create([
        'email' => 'not-allowed@example.com',
    ]);

    $this->actingAs($unauthorizedUser)
        ->get(route('filament.Employer.pages.dashboard'))
        ->assertForbidden();
});

it('builds Employer jobs navigation label from authenticated user', function (): void {
    $this->actingAs($this->panelUser);

    expect(EmployerJobResource::getNavigationLabel())
        ->toBe("{$this->panelUser->name}'s Jobs");
});

it('links users Employers and jobs through defined relationships', function (): void {
    $user = User::factory()->create();
    $Employer = Employer::factory()->create([
        'user_id' => $user->id,
    ]);
    $jobs = Job::factory()->count(2)->create([
        'Employer_id' => $Employer->id,
    ]);

    expect($user->Employer->is($Employer))->toBeTrue();
    expect($Employer->user->is($user))->toBeTrue();
    expect($Employer->job)->toHaveCount(2);
    expect($Employer->job->pluck('id')->all())
        ->toEqualCanonicalizing($jobs->pluck('id')->all());
});

it('attaches tags to Employer jobs via the helper method', function (): void {
    $this->job->Tag('Backend');
    $this->job->refresh();

    $tag = Tag::query()->where('name', 'backend')->first();

    expect($this->job->Employer->is($this->Employer))->toBeTrue();
    expect($this->job->Tags)->toHaveCount(1);
    expect($this->job->Tags->first()->name)->toBe('backend');
    expect($tag)->not->toBeNull();
    expect($tag->jobs->contains($this->job))->toBeTrue();
});

it('keeps Employer resource create and delete capabilities disabled', function (): void {
    expect(EmployerPanelEmployerResource::canCreate())->toBeFalse();
    expect(EmployerPanelEmployerResource::canDelete($this->Employer))->toBeFalse();
});

dataset('Employer-protected-pages', [
    'dashboard' => [
        'filament.Employer.pages.dashboard',
        fn ($test): array => [],
    ],
    'Employer jobs index' => [
        'filament.Employer.resources.Employer-jobs.index',
        fn ($test): array => [],
    ],
    'Employer jobs create' => [
        'filament.Employer.resources.Employer-jobs.create',
        fn ($test): array => [],
    ],
    'Employer jobs edit' => [
        'filament.Employer.resources.Employer-jobs.edit',
        fn ($test): array => ['record' => $test->job],
    ],
    'Employers index' => [
        'filament.Employer.resources.Employers.index',
        fn ($test): array => [],
    ],
    'Employers create' => [
        'filament.Employer.resources.Employers.create',
        fn ($test): array => [],
    ],
    'Employers view' => [
        'filament.Employer.resources.Employers.view',
        fn ($test): array => ['record' => $test->Employer],
    ],
    'Employers edit' => [
        'filament.Employer.resources.Employers.edit',
        fn ($test): array => ['record' => $test->Employer],
    ],
]);

dataset('Employer-accessible-pages', [
    'dashboard' => [
        'filament.Employer.pages.dashboard',
        fn ($test): array => [],
    ],
    'Employer jobs index' => [
        'filament.Employer.resources.Employer-jobs.index',
        fn ($test): array => [],
    ],
    'Employer jobs create' => [
        'filament.Employer.resources.Employer-jobs.create',
        fn ($test): array => [],
    ],
    'Employer jobs edit' => [
        'filament.Employer.resources.Employer-jobs.edit',
        fn ($test): array => ['record' => $test->job],
    ],
    'Employers index' => [
        'filament.Employer.resources.Employers.index',
        fn ($test): array => [],
    ],
    'Employers view' => [
        'filament.Employer.resources.Employers.view',
        fn ($test): array => ['record' => $test->Employer],
    ],
    'Employers edit' => [
        'filament.Employer.resources.Employers.edit',
        fn ($test): array => ['record' => $test->Employer],
    ],
]);
