<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolesAndPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed roles and permissions
        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_all_permissions_exist(): void
    {
        $expectedPermissions = [
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
            'apply_jobs',
            'manage_users',
            'manage_employers_profiles',
        ];

        foreach ($expectedPermissions as $permission) {
            expect(Permission::where('name', $permission)->exists())
                ->toBeTrue("Permission '{$permission}' should exist");
        }
    }

    public function test_admin_has_all_permissions(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();

        $expectedPermissions = [
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
            'apply_jobs',
            'manage_users',
            'manage_employers_profiles',
        ];

        foreach ($expectedPermissions as $permission) {
            expect($adminRole->hasPermissionTo($permission))
                ->toBeTrue("Admin role should have '{$permission}' permission");
        }

        expect($adminRole->permissions()->count())
            ->toBe(count($expectedPermissions), 'Admin should have all permissions');
    }

    public function test_employer_has_correct_permissions(): void
    {
        $employerRole = Role::where('name', 'Employer')->first();

        $expectedPermissions = ['view_jobs', 'create_jobs', 'edit_jobs', 'delete_jobs'];

        foreach ($expectedPermissions as $permission) {
            expect($employerRole->hasPermissionTo($permission))
                ->toBeTrue("Employer role should have '{$permission}' permission");
        }

        $unexpectedPermissions = ['apply_jobs', 'manage_users', 'manage_employers_profiles'];
        foreach ($unexpectedPermissions as $permission) {
            expect($employerRole->hasPermissionTo($permission))
                ->toBeFalse("Employer role should NOT have '{$permission}' permission");
        }

        expect($employerRole->permissions()->count())
            ->toBe(count($expectedPermissions), 'Employer should have exactly 4 permissions');
    }

    public function test_jobseeker_has_correct_permissions(): void
    {
        $jobseekerRole = Role::where('name', 'JobSeeker')->first();

        $expectedPermissions = ['view_jobs', 'apply_jobs'];

        foreach ($expectedPermissions as $permission) {
            expect($jobseekerRole->hasPermissionTo($permission))
                ->toBeTrue("JobSeeker role should have '{$permission}' permission");
        }

        $unexpectedPermissions = ['create_jobs', 'edit_jobs', 'delete_jobs', 'manage_users', 'manage_employers_profiles'];
        foreach ($unexpectedPermissions as $permission) {
            expect($jobseekerRole->hasPermissionTo($permission))
                ->toBeFalse("JobSeeker role should NOT have '{$permission}' permission");
        }

        expect($jobseekerRole->permissions()->count())
            ->toBe(count($expectedPermissions), 'JobSeeker should have exactly 2 permissions');
    }

    public function test_user_with_admin_role_can_perform_actions(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');

        expect($admin->hasRole('Admin'))->toBeTrue();
        expect($admin->hasPermissionTo('view_jobs'))->toBeTrue();
        expect($admin->hasPermissionTo('create_jobs'))->toBeTrue();
        expect($admin->hasPermissionTo('edit_jobs'))->toBeTrue();
        expect($admin->hasPermissionTo('delete_jobs'))->toBeTrue();
        expect($admin->hasPermissionTo('apply_jobs'))->toBeTrue();
        expect($admin->hasPermissionTo('manage_users'))->toBeTrue();
        expect($admin->hasPermissionTo('manage_employers_profiles'))->toBeTrue();
    }

    public function test_user_with_employer_role_can_perform_actions(): void
    {
        $employer = User::factory()->create();
        $employer->assignRole('Employer');

        expect($employer->hasRole('Employer'))->toBeTrue();
        expect($employer->hasPermissionTo('view_jobs'))->toBeTrue();
        expect($employer->hasPermissionTo('create_jobs'))->toBeTrue();
        expect($employer->hasPermissionTo('edit_jobs'))->toBeTrue();
        expect($employer->hasPermissionTo('delete_jobs'))->toBeTrue();
        expect($employer->hasPermissionTo('apply_jobs'))->toBeFalse();
        expect($employer->hasPermissionTo('manage_users'))->toBeFalse();
        expect($employer->hasPermissionTo('manage_employers_profiles'))->toBeFalse();
    }

    public function test_user_with_jobseeker_role_can_perform_actions(): void
    {
        $jobseeker = User::factory()->create();
        $jobseeker->assignRole('JobSeeker');

        expect($jobseeker->hasRole('JobSeeker'))->toBeTrue();
        expect($jobseeker->hasPermissionTo('view_jobs'))->toBeTrue();
        expect($jobseeker->hasPermissionTo('apply_jobs'))->toBeTrue();
        expect($jobseeker->hasPermissionTo('create_jobs'))->toBeFalse();
        expect($jobseeker->hasPermissionTo('edit_jobs'))->toBeFalse();
        expect($jobseeker->hasPermissionTo('delete_jobs'))->toBeFalse();
        expect($jobseeker->hasPermissionTo('manage_users'))->toBeFalse();
        expect($jobseeker->hasPermissionTo('manage_employers_profiles'))->toBeFalse();
    }
}
