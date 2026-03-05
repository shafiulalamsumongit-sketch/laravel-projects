<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto mt-10  pb-10  pr-4 pl-4">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto  grid grid-cols-1 md:grid-cols-4 gap-6  pr-4 pl-4">
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
    <div class="max-w-7xl mx-auto mt-10  pb-10  pr-4 pl-4">
        <div class="flex flex-wrap items-center gap-4 mb-6">
            <!-- Search -->
            <input type="text" placeholder="Search users..." class="w-full md:w-1/3 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
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

    <div class="max-w-7xl mx-auto mt-10 mb-10  pr-4 pl-4">

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden mb-10">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Products</h2>
                    <p class="text-sm text-gray-500">Manage your store items</p>
                </div>

                <a href="#" class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm hover:bg-indigo-700 transition">
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
    <div class="max-w-7xl mx-auto mt-1 mb-10  pr-4 pl-4">
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
                        <div class="h-10 w-10 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold">
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
                        <div class="h-10 w-10 flex items-center justify-center rounded-full bg-rose-100 text-rose-600 font-bold">
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
                        <div class="h-10 w-10 flex items-center justify-center rounded-full bg-gray-200 text-gray-700 font-bold">
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



    <div class="max-w-7xl mx-auto mt-10  pb-10  pr-4 pl-4">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <div class="bg-white p-8 rounded-xl shadow">
            <div class="m-auto space-y-6">
                <div class="flex gap-4 bg-red-100 p-4 rounded-md">
                    <div class="w-max">
                        <div class="h-10 w-10 flex rounded-full bg-gradient-to-b from-red-100 to-red-300 text-red-700">
                            <span class="material-icons material-icons-outlined m-auto" style="font-size:20px">gpp_bad</span>
                        </div>
                    </div>
                    <div class="space-y-1 text-sm">
                        <h6 class="font-medium text-red-900">Fatal error</h6>
                        <p class="text-red-700 leading-tight">Your internet connection was lost, we can't upload your
                            photo.</p>
                    </div>
                </div>
                <div class="flex gap-4 bg-red-500 p-4 rounded-md">
                    <div class="w-max">
                        <div class="h-10 w-10 flex rounded-full bg-gradient-to-b from-red-100 to-red-300 text-red-700">
                            <span class="material-icons material-icons-outlined m-auto" style="font-size:20px">gpp_bad</span>
                        </div>
                    </div>
                    <div class="space-y-1 text-sm">
                        <h6 class="font-medium text-white">Fatal error</h6>
                        <p class="text-red-100 leading-tight">Your internet connection was lost, we can't upload your
                            photo.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-2 mt-16">
            <!-- Alert Success -->
            <div class="bg-green-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center mx-auto max-w-lg">
                <svg viewBox="0 0 24 24" class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                    <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                    </path>
                </svg>
                <span class="text-green-800">Your account has been saved.</span>
            </div>
            <!-- End Alert Success -->
            <!-- Alert Error -->
            <div class="bg-red-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center mx-auto max-w-lg">
                <svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                    <path fill="currentColor" d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z">
                    </path>
                </svg>
                <span class="text-red-800"> Your email address is invalid. </span>
            </div>
            <!-- End Alert Error -->
            <!-- Alert Warning -->
            <div class="bg-orange-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center mx-auto max-w-lg">
                <svg viewBox="0 0 24 24" class="text-yellow-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                    <path fill="currentColor" d="M23.119,20,13.772,2.15h0a2,2,0,0,0-3.543,0L.881,20a2,2,0,0,0,1.772,2.928H21.347A2,2,0,0,0,23.119,20ZM11,8.423a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Zm1.05,11.51h-.028a1.528,1.528,0,0,1-1.522-1.47,1.476,1.476,0,0,1,1.448-1.53h.028A1.527,1.527,0,0,1,13.5,18.4,1.475,1.475,0,0,1,12.05,19.933Z">
                    </path>
                </svg>
                <span class="text-yellow-800">
                    You are currently on the Free plan.
                </span>
            </div>
            <!-- End Alert Warning -->
            <!-- Alert Info -->
            <div class="bg-blue-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center mx-auto max-w-lg">
                <svg viewBox="0 0 24 24" class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                    <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z">
                    </path>
                </svg>
                <span class="text-blue-800"> We've updated a few things. </span>
            </div>
            <!-- End Alert Info -->
        </div>
    </div>
</x-app-layout>
