<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Total Users</p>
            <p class="text-2xl font-bold text-gray-800">1,248</p>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Active Users</p>
            <p class="text-2xl font-bold text-green-600">1,032</p>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Admins</p>
            <p class="text-2xl font-bold text-indigo-600">12</p>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Suspended</p>
            <p class="text-2xl font-bold text-red-600">23</p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto mt-10  pb-10">
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <!-- Search -->
            <input type="text" placeholder="Search users..."
                class="w-full md:w-1/3 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

            <!-- Role Filter -->
            <select class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option>All Roles</option>
                <option>Admin</option>
                <option>Editor</option>
                <option>User</option>
            </select>

            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Filter
            </button>

            <button class="ml-auto px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                + Add User
            </button>
        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    <!-- User Row -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <img src="https://i.pravatar.cc/40" class="h-10 w-10 rounded-full">

                            <div>
                                <p class="font-semibold text-gray-800">Shafiul Alam</p>
                                <p class="text-xs text-gray-500">Joined Jan 12, 2025</p>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            shafiul@example.com
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                                Admin
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex gap-2">
                                <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                                    View
                                </button>
                                <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                                    Edit
                                </button>
                                <button class="px-3 py-1 border rounded-lg text-red-600 hover:bg-red-50">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- User Row -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <img src="https://i.pravatar.cc/41" class="h-10 w-10 rounded-full">

                            <div>
                                <p class="font-semibold text-gray-800">Rahim Uddin</p>
                                <p class="text-xs text-gray-500">Joined Feb 3, 2025</p>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            rahim@example.com
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-700">
                                User
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                Suspended
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex gap-2">
                                <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                                    View
                                </button>
                                <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                                    Edit
                                </button>
                                <button class="px-3 py-1 border rounded-lg text-red-600 hover:bg-red-50">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between mt-6 text-sm">
            <p class="text-gray-500">
                Showing 1–10 of 50 users
            </p>

            <div class="inline-flex gap-1">
                <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                    Prev
                </button>
                <button class="px-3 py-1 border rounded-lg bg-indigo-600 text-white">
                    1
                </button>
                <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                    2
                </button>
                <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                    Next
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-10 mb-10 ">

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden mb-10">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Products</h2>
                    <p class="text-sm text-gray-500">Manage your store items</p>
                </div>

                <a href="#"
                    class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition">
                    + Add Product
                </a>
            </div>

            <!-- Product List -->
            <ul class="divide-y">
                <!-- Product Item -->
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-5">
                        <!-- Image -->
                        <img src="https://placehold.co/60" class="h-14 w-14 rounded-xl object-cover border">

                        <!-- Info -->
                        <div>
                            <p class="font-semibold text-gray-800">
                                Wireless Headphones
                            </p>
                            <p class="text-sm text-gray-500">
                                Electronics • SKU: WH-2391
                            </p>
                            <p class="text-sm font-medium text-indigo-600">
                                ৳3,499
                            </p>
                        </div>
                    </div>

                    <!-- Status + Actions -->
                    <div class="flex items-center gap-4">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                            In Stock
                        </span>

                        <div class="flex gap-2">
                            <button class="px-3 py-1 text-sm rounded-lg border hover:bg-gray-100">
                                Edit
                            </button>
                            <button class="px-3 py-1 text-sm rounded-lg border text-red-600 hover:bg-red-50">
                                Delete
                            </button>
                        </div>
                    </div>
                </li>

                <!-- Product Item -->
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-5">
                        <img src="https://placehold.co/60" class="h-14 w-14 rounded-xl object-cover border">

                        <div>
                            <p class="font-semibold text-gray-800">
                                Smart Watch
                            </p>
                            <p class="text-sm text-gray-500">
                                Accessories • SKU: SW-8820
                            </p>
                            <p class="text-sm font-medium text-indigo-600">
                                ৳6,999
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            Low Stock
                        </span>

                        <div class="flex gap-2">
                            <button class="px-3 py-1 text-sm rounded-lg border hover:bg-gray-100">
                                Edit
                            </button>
                            <button class="px-3 py-1 text-sm rounded-lg border text-red-600 hover:bg-red-50">
                                Delete
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="max-w-7xl mx-auto mt-1 mb-10">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">
                    Recent Items
                </h2>
                <p class="text-sm text-gray-500">
                    Manage your latest records
                </p>
            </div>
            <ul class="divide-y">
                <!-- Item -->
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-10 w-10 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold">
                            A
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">
                                Article Title
                            </p>
                            <p class="text-sm text-gray-500">
                                Published 2 hours ago
                            </p>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                        Active
                    </span>
                </li>
                <!-- Item -->
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-10 w-10 flex items-center justify-center rounded-full bg-rose-100 text-rose-600 font-bold">
                            B
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">
                                Blog Post
                            </p>
                            <p class="text-sm text-gray-500">
                                Draft saved yesterday
                            </p>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                        Draft
                    </span>
                </li>
                <!-- Item -->
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-10 w-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-700 font-bold">
                            C
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">
                                Comment Review
                            </p>
                            <p class="text-sm text-gray-500">
                                Waiting for approval
                            </p>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                        Pending
                    </span>
                </li>
            </ul>
        </div>
    </div>
    </div>

</x-app-layout>