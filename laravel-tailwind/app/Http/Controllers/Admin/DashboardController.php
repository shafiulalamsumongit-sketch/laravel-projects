<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue  = Order::where('payment_status', 'paid')->sum('total');
        $totalOrders   = Order::count();
        $totalCustomers = User::where('role', '!=', 'admin')->count();
        $totalProducts = Product::count();
        $recentOrders  = Order::with('user')->latest()->take(5)->get();
        $lowStock      = Product::with('category')->where('stock', '<=', 10)->where('stock', '>', 0)->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalRevenue', 'totalOrders', 'totalCustomers', 'totalProducts',
            'recentOrders', 'lowStock'
        ));
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
        }
        return back()->withErrors(['email' => 'Invalid credentials or insufficient permissions.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
