<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $employerRole = Role::firstOrCreate(['name' => 'Employer']);
        $jobSeekerRole = Role::firstOrCreate(['name' => 'JobSeeker']);

        // Job permissions
        $permissions = [
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
            'apply_jobs',
            'manage_users',
            'manage_employers_profiles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $adminRole->givePermissionTo(Permission::all());
        $employerRole->givePermissionTo(['view_jobs', 'create_jobs', 'edit_jobs', 'delete_jobs']);
        $jobSeekerRole->givePermissionTo(['view_jobs', 'apply_jobs']);
    }
}
