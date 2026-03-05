<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class AdminSampleUserSeeder extends Seeder
{
    public function run(): void
    {
        // Reset permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Create Roles (if not exists)
        |--------------------------------------------------------------------------
        */

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'admin'
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'admin'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Sample Permissions (optional)
        |--------------------------------------------------------------------------
        */

        $permissions = [
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }

        // Super Admin gets ALL permissions
        $superAdminRole->syncPermissions(
            Permission::where('guard_name','admin')->get()
        );

        // Normal admin gets limited permissions
        $adminRole->syncPermissions([
            'product.view',
            'product.create',
            'product.edit'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Super Admin User
        |--------------------------------------------------------------------------
        */

        $superAdmin = Admin::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123')
            ]
        );

        $superAdmin->assignRole($superAdminRole);

        /*
        |--------------------------------------------------------------------------
        | Create Normal Admin User
        |--------------------------------------------------------------------------
        */

        $admin = Admin::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Normal Admin',
                'password' => Hash::make('password123')
            ]
        );

        $admin->assignRole($adminRole);
    }
}
