<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_orders'   => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue'  => Order::where('payment_status', 'paid')->sum('total'),
            'total_products' => Product::count(),
            'low_stock'      => Product::where('stock_quantity', '<', 10)->count(),
            'total_users'    => User::where('role', 'customer')->count(),
        ];

        $recentOrders = Order::with(['user', 'items'])
            ->latest()
            ->take(10)
            ->get();

        $topProducts = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take(5)
            ->get();

        $monthlySales = Order::where('payment_status', 'paid')
            ->selectRaw('MONTH(created_at) as month, SUM(total) as revenue, COUNT(*) as orders')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts', 'monthlySales'));
    }
}
