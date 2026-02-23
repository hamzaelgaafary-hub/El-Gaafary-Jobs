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
        'email' => 'employer@employer.com',
    ]);

    $this->employer = Employer::factory()->create([
        'user_id' => $this->panelUser->id,
    ]);

    $this->job = Job::factory()->create([
        'employer_id' => $this->employer->id,
    ]);
});

it('redirects guests from protected employer pages to employer login', function (string $routeName, Closure $parametersResolver): void {
    $this->get(route($routeName, $parametersResolver($this)))
        ->assertRedirect(route('filament.Employer.auth.login'));
})->with('employer-protected-pages');

it('allows authenticated panel users to access employer pages', function (string $routeName, Closure $parametersResolver): void {
    $this->actingAs($this->panelUser)
        ->get(route($routeName, $parametersResolver($this)))
        ->assertOk();
})->with('employer-accessible-pages');

it('forbids creating an employer record through employer panel resource', function (): void {
    $this->actingAs($this->panelUser)
        ->get(route('filament.Employer.resources.employers.create'))
        ->assertForbidden();
});

it('forbids authenticated users who do not pass employer panel access check', function (): void {
    $unauthorizedUser = User::factory()->create([
        'email' => 'not-allowed@example.com',
    ]);

    $this->actingAs($unauthorizedUser)
        ->get(route('filament.Employer.pages.dashboard'))
        ->assertForbidden();
});

it('builds employer jobs navigation label from authenticated user', function (): void {
    $this->actingAs($this->panelUser);

    expect(EmployerJobResource::getNavigationLabel())
        ->toBe("{$this->panelUser->name}'s Jobs");
});

it('links users employers and jobs through defined relationships', function (): void {
    $user = User::factory()->create();
    $employer = Employer::factory()->create([
        'user_id' => $user->id,
    ]);
    $jobs = Job::factory()->count(2)->create([
        'employer_id' => $employer->id,
    ]);

    expect($user->Employer->is($employer))->toBeTrue();
    expect($employer->user->is($user))->toBeTrue();
    expect($employer->job)->toHaveCount(2);
    expect($employer->job->pluck('id')->all())
        ->toEqualCanonicalizing($jobs->pluck('id')->all());
});

it('attaches tags to employer jobs via the helper method', function (): void {
    $this->job->Tag('Backend');
    $this->job->refresh();

    $tag = Tag::query()->where('name', 'backend')->first();

    expect($this->job->Employer->is($this->employer))->toBeTrue();
    expect($this->job->Tags)->toHaveCount(1);
    expect($this->job->Tags->first()->name)->toBe('backend');
    expect($tag)->not->toBeNull();
    expect($tag->jobs->contains($this->job))->toBeTrue();
});

it('keeps employer resource create and delete capabilities disabled', function (): void {
    expect(EmployerPanelEmployerResource::canCreate())->toBeFalse();
    expect(EmployerPanelEmployerResource::canDelete($this->employer))->toBeFalse();
});

dataset('employer-protected-pages', [
    'dashboard' => [
        'filament.Employer.pages.dashboard',
        fn ($test): array => [],
    ],
    'employer jobs index' => [
        'filament.Employer.resources.employer-jobs.index',
        fn ($test): array => [],
    ],
    'employer jobs create' => [
        'filament.Employer.resources.employer-jobs.create',
        fn ($test): array => [],
    ],
    'employer jobs edit' => [
        'filament.Employer.resources.employer-jobs.edit',
        fn ($test): array => ['record' => $test->job],
    ],
    'employers index' => [
        'filament.Employer.resources.employers.index',
        fn ($test): array => [],
    ],
    'employers create' => [
        'filament.Employer.resources.employers.create',
        fn ($test): array => [],
    ],
    'employers view' => [
        'filament.Employer.resources.employers.view',
        fn ($test): array => ['record' => $test->employer],
    ],
    'employers edit' => [
        'filament.Employer.resources.employers.edit',
        fn ($test): array => ['record' => $test->employer],
    ],
]);

dataset('employer-accessible-pages', [
    'dashboard' => [
        'filament.Employer.pages.dashboard',
        fn ($test): array => [],
    ],
    'employer jobs index' => [
        'filament.Employer.resources.employer-jobs.index',
        fn ($test): array => [],
    ],
    'employer jobs create' => [
        'filament.Employer.resources.employer-jobs.create',
        fn ($test): array => [],
    ],
    'employer jobs edit' => [
        'filament.Employer.resources.employer-jobs.edit',
        fn ($test): array => ['record' => $test->job],
    ],
    'employers index' => [
        'filament.Employer.resources.employers.index',
        fn ($test): array => [],
    ],
    'employers view' => [
        'filament.Employer.resources.employers.view',
        fn ($test): array => ['record' => $test->employer],
    ],
    'employers edit' => [
        'filament.Employer.resources.employers.edit',
        fn ($test): array => ['record' => $test->employer],
    ],
]);
