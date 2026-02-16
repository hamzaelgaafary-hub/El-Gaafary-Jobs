<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Spatie\Permission\PermissionRegistrar;



class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Job permissions
        $permissions = [
            'view_jobs',
            'create_jobs',
            'edit_jobs',
            'delete_jobs',
            'apply_jobs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        Role::firstOrCreate(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        Role::firstOrCreate(['name' => 'employer'])
            ->givePermissionTo(['view_jobs', 'create_jobs', 'edit_jobs', 'delete_jobs']);

        Role::firstOrCreate(['name' => 'jobseeker'])
            ->givePermissionTo(['view_jobs', 'apply_jobs']);
    }
}


