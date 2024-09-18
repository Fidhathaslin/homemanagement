<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'access-admin-panel',
            'dashboard-view',
            'users-view',
            'users-create',
            'users-edit',
            'users-update',
            'users-store',
            'users-delete',
            'roles-view',
            'roles-create',
            'roles-edit',
            'roles-delete',
            'permissions-view',
            'users-manage'

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission], ['guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin'], ['guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'web']);

        // Assign permissions to roles
        $superAdminRole->syncPermissions(Permission::all());

        $adminRole->syncPermissions($permissions);
    }
}
