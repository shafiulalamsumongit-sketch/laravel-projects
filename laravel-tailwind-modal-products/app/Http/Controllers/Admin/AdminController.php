<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
         $this->middleware('role:super_admin');
    }

    public function index()
    {
        // $admins = Admin::with('roles')->latest()->get();
        // return view('admin.admins.index', compact('admins'));
        $this->authorize('viewAny', Admin::class);
        $admins = \App\Models\Admin::with('roles')->latest()->paginate(1);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $admin->assignRole($request->role);

        return redirect()
            ->route('admin.admins.index')
            ->with('success', 'Admin created successfully');
    }

    public function edit(Admin $admin)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'role' => 'required'
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $admin->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $admin->syncRoles([$request->role]);

        return redirect()
            ->route('admin.admins.index')
            ->with('success', 'Admin updated successfully');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return back()->with('success', 'Admin deleted successfully');
    }
}
