@extends('layouts.app2')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm text-gray-500">Users</h3>
            <p class="text-2xl font-semibold mt-2">1,248</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm text-gray-500">Revenue</h3>
            <p class="text-2xl font-semibold mt-2">$12,450</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm text-gray-500">Orders</h3>
            <p class="text-2xl font-semibold mt-2">320</p>
        </div>
    </div>
@endsection
