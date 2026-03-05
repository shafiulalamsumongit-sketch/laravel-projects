<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:super_admin');
    }

    public function dashboard()
    {
        $admin = auth('admin')->user();
        $role = $admin->getRoleNames()->first();

        return view('admin.dashboard', compact('role'));
    }
}
