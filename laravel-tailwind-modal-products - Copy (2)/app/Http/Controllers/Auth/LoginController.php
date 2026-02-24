<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('authmanuallogin.login');
    }

    public function login(Request $request)
    {
        
    // echo "login"; exit;
    
    $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid credentials'
            ]);
        }

        $request->session()->regenerate();

        // 🔑 CREATE SANCTUM TOKEN AFTER LOGIN
        $token = auth()->user()->createToken('web-token')->plainTextToken;

        // store token for frontend usage
        session(['api_token' => $token]);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        auth()->user()?->tokens()->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
return redirect('/login');
       // return redirect('/login-manual');
    }
}
