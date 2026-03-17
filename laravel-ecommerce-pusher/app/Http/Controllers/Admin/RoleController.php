<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update(['name' => $request->name]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        // Prevent deleting super_admin
        if ($role->name == 'super_admin') {
            return back()->with('error', 'Cannot delete Super Admin role');
        }

        $role->delete();
        return back()->with('success', 'Role deleted successfully');
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
