<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolepermissionController extends Controller
{
    public function edit(Role $role)
    {
        $permissions = Permission::where('guard_name', 'admin')
            ->get()
            ->groupBy(function ($permission) {
                return explode('.', $permission->name)[0];
            });

           

        return view('admin.roles.permission-matrix', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(Role $role)
    {
        $permissions = request('permissions');

        $role->syncPermissions($permissions);

        return back()->with('success', 'Permissions Updated');
    }

    public function permissionMatrix()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        $permissions = Permission::all();

        return view('admin.roles.permission-matrix', compact('roles', 'permissions'));
    }

    public function updatePermissions(Request $request)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'array'
        ]);

        foreach ($request->permissions as $roleName => $perms) {
            $role = Role::where('name', $roleName)->first();
            if ($role->name == 'super_admin')
                continue;  // prevent editing super_admin
            $role->syncPermissions($perms);
        }

        return back()->with('success', 'Permissions updated successfully');
    }
}
