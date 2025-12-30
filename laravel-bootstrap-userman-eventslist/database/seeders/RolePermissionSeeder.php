<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $admin      = Role::firstOrCreate(['name' => 'Admin']);
        $user       = Role::firstOrCreate(['name' => 'User']);

        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo([
            'view users',
            'create users',
            'edit users',
        ]);
    }
}
