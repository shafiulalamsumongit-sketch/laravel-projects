<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorLoginController extends Controller
{
    public function __construct()
    {
       // $this->middleware('guest:vendor')->except('logout');
    }

    // 🔹 Show Login Form
    public function showLoginForm()
    {
        return view('vendor.auth.login');
    }

    // 🔹 Login Logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('vendor')->attempt(
            $request->only('email','password'),
            $request->filled('remember')
        )) {

            $request->session()->regenerate();

            return redirect()->route('vendor.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid vendor credentials.',
        ])->onlyInput('email');
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vendor.login');
    }
}
