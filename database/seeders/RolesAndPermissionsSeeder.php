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
    /*
    public function run(): void
    {
        
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Manager role has the same permissions as Admin
        
        $ManagerRole = Role::firstOrCreate(['name' => 'Manager']);
        $AdminRole = Role::firstOrCreate(['name' => 'Admin']);
        $EmployerRole = Role::firstOrCreate(['name' => 'Employer']);
        $JobSeekerRole = Role::firstOrCreate(['name' => 'JobSeeker']);

        $ManagerRole->syncPermissions([
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
            'manage_users',
            'manage_Employers_profiles',
        ]);
        // Job permissions
        $permissions = [
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
            'apply_jobs',
            'manage_users',
            'manage_Employers_profiles',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $AdminRole->givePermissionTo(Permission::all());
        $EmployerRole->givePermissionTo(['view_jobs', 'create_jobs', 'edit_jobs', 'delete_jobs']);
        $JobSeekerRole->givePermissionTo(['view_jobs', 'apply_jobs']);
    
        }
    */

    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // permissions
        Permission::firstOrCreate(['name' => 'view_jobs']);
        Permission::firstOrCreate(['name' => 'create_jobs']);
        Permission::firstOrCreate(['name' => 'edit_jobs']);
        Permission::firstOrCreate(['name' => 'delete_jobs']);
        Permission::firstOrCreate(['name' => 'apply_jobs']);
        Permission::firstOrCreate(['name' => 'manage_users']);
        Permission::firstOrCreate(['name' => 'manage_Employers_profiles']);

        // Admin role
        $AdminRole = Role::firstOrCreate(['name' => 'Admin']);
        $AdminRole->syncPermissions([
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
            'manage_users',
            'manage_Employers_profiles',
        ]);

        // Manager role (full system access like Admin)
        $ManagerRole = Role::firstOrCreate(['name' => 'Manager']);
        $ManagerRole->syncPermissions([
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
            'manage_users',
            'manage_Employers_profiles',
        ]);

        // Employer role
        $EmployerRole = Role::firstOrCreate(['name' => 'Employer']);
        $EmployerRole->syncPermissions([
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
        ]);

        //  JobSeeker role
        $JobSeekerRole = Role::firstOrCreate(['name' => 'JobSeeker']);
        $JobSeekerRole->syncPermissions([
            'view_jobs',
            'apply_jobs',
        ]);
    }
}
