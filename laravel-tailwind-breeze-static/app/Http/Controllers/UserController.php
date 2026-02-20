<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // echo "hello"; exit;
        //return User::latest()->get();
        $users = User::latest()->get();
       return view('users.index', compact(var_name: 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);
    }

    public function show(User $user)
    {
        echo "hello 11111";
        exit;
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only('name', 'email'));
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
