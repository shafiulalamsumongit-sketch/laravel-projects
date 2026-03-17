<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return response()->json($request->user()->load('addresses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $request->user()->id],
            'phone' => ['nullable', 'string'],
        ]);

        $request->user()->update($request->only('name', 'email', 'phone'));
        return response()->json($request->user());
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 422);
        }

        $request->user()->update(['password' => Hash::make($request->password)]);
        return response()->json(['message' => 'Password updated successfully']);
    }

    public function addresses(Request $request)
    {
        return response()->json($request->user()->addresses);
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'label'         => ['required', 'string'],
            'first_name'    => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'address_line1' => ['required', 'string'],
            'city'          => ['required', 'string'],
            'state'         => ['required', 'string'],
            'postal_code'   => ['required', 'string'],
            'country'       => ['required', 'string'],
        ]);

        if ($request->is_default) {
            $request->user()->addresses()->update(['is_default' => false]);
        }

        $address = $request->user()->addresses()->create($request->all());
        return response()->json($address, 201);
    }

    public function updateAddress(Request $request, Address $address)
    {
        if ($address->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($request->is_default) {
            $request->user()->addresses()->update(['is_default' => false]);
        }

        $address->update($request->all());
        return response()->json($address);
    }

    public function destroyAddress(Request $request, Address $address)
    {
        if ($address->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $address->delete();
        return response()->json(['message' => 'Address deleted']);
    }
}
