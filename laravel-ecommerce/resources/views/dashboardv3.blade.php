@extends('layouts.appdashboardv3')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-gray-600 dark:text-gray-300">Total Sales</h2>
        <p class="text-2xl font-bold text-indigo-600 mt-2">$12,450</p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-gray-600 dark:text-gray-300">Users</h2>
        <p class="text-2xl font-bold text-indigo-600 mt-2">1,245</p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-gray-600 dark:text-gray-300">Orders</h2>
        <p class="text-2xl font-bold text-indigo-600 mt-2">320</p>
    </div>

</div>

@endsection
