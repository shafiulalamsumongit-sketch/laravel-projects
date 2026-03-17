<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index() {
        $customers = User::where('role','!=','admin')->withCount('orders')->latest()->paginate(20);
        return view('admin.customers.index', compact('customers'));
    }
    public function show(User $user) {
        return view('admin.customers.show', ['customer' => $user->load('orders')]);
    }
}
