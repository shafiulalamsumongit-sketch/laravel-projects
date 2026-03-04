<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
            $permissions = [
                'product.view',
                'product.create',
                'product.edit',
                'product.delete',
                'user.manage',
                'order.manage',
            ];

            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission, 'guard_name' => 'admin']);
            }

            $superAdmin = Role::create(['name' => 'super_admin', 'guard_name' => 'admin']);
            $admin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);

            $superAdmin->givePermissionTo(Permission::all());
            $admin->givePermissionTo(['product.view','product.create','product.edit']);
    }
}
