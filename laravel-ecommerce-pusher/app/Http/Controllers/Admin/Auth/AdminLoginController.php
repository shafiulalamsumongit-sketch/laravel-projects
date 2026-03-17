<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:admin')->except('logout');
    }

    // 🔹 Show Login Form
    public function showLoginForm()
    {
        Log::info('User showLoginForm in');
        Log::info('This is some useful information.');
        Log::warning('Something could be going wrong.');
        Log::error('Something is really going wrong.');
        Log::info('User login', [
            'user_id' => 5,
            'ip' => request()->ip()
        ]);

        Log::channel('single')->info('Payment success');

        Log::warning('Unauthorized access attempt', [
            'user_id' => auth()->id(),
            'url' => request()->url()
        ]);

        return view('admin.auth.login');
    }

    // 🔹 Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt login
        if (Auth::guard('admin')->attempt(
            $request->only('email', 'password'),
            // $request->filled('remember')
        )) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid admin credentials.',
        ])->onlyInput('email');
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
