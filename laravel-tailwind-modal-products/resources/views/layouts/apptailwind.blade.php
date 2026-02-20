<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Admin')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 text-gray-800">

<div class="flex h-screen overflow-hidden">

  <!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-white border-r hidden md:flex flex-col">
    
    {{-- Logo --}}
    <div class="h-16 flex items-center justify-center border-b">
        <span class="text-xl font-bold text-indigo-600">
          <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> 
                    </a>
                </div> 
        </span>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-4 py-6 space-y-2 text-gray-700">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 rounded-lg
           {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-600' : 'hover:bg-gray-100' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8" />
            </svg>
            Dashboard
        </a>

        {{-- Users --}}
        <a href="{{ route('users-index') }}"
           class="flex items-center px-4 py-2 rounded-lg
           {{ request()->routeIs('users.*') ? 'bg-indigo-100 text-indigo-600' : 'hover:bg-gray-100' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path d="M17 20h5v-2a4 4 0 0 0-4-4h-1" />
                <circle cx="9" cy="7" r="4" />
            </svg>
            Users
        </a>

        {{-- Products --}}
        <a href="{{ route('users-index') }}"
           class="flex items-center px-4 py-2 rounded-lg
           {{ request()->routeIs('products.*') ? 'bg-indigo-100 text-indigo-600' : 'hover:bg-gray-100' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path d="M20 7H4M20 7l-1 12H5L4 7m4 0V4h8v3" />
            </svg>
            Products
        </a>

        {{-- Settings --}}
        <a href="{{ route('users-index') }}"
           class="flex items-center px-4 py-2 rounded-lg
           {{ request()->routeIs('users-index') ? 'bg-indigo-100 text-indigo-600' : 'hover:bg-gray-100' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path d="M12 15.5A3.5 3.5 0 1 0 12 8.5a3.5 3.5 0 0 0 0 7z" />
            </svg>
            Settings
        </a>

    </nav>

    {{-- Footer --}}
    <div class="p-4 border-t text-sm text-gray-500">
        © {{ date('Y') }} Your Company
    </div>
</aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col overflow-hidden">

    <!-- Top Navbar -->
   <header class="h-16 bg-white border-b flex items-center  justify-between px-6">

    <!-- Left -->
     @include('layouts.navigation-custom-1')

    <!-- Right -->
    <div class="relative">
       
    </div>
</header>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('hidden')
    }


</script>


    <!-- Content -->
    <main class="flex-1 overflow-y-auto p-6 space-y-6">

      <!-- Page Header -->
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
        <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
          New Report
        </button>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-5 rounded shadow">
          <p class="text-sm text-gray-500">Users</p>
          <h2 class="text-2xl font-bold mt-1">1,248</h2>
        </div>
        <div class="bg-white p-5 rounded shadow">
          <p class="text-sm text-gray-500">Revenue</p>
          <h2 class="text-2xl font-bold mt-1">$32,400</h2>
        </div>
        <div class="bg-white p-5 rounded shadow">
          <p class="text-sm text-gray-500">Orders</p>
          <h2 class="text-2xl font-bold mt-1">312</h2>
        </div>
        <div class="bg-white p-5 rounded shadow">
          <p class="text-sm text-gray-500">Pending</p>
          <h2 class="text-2xl font-bold mt-1">19</h2>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded shadow lg:col-span-2">
          <h3 class="font-semibold mb-4">Sales Overview</h3>
          <div class="h-64 flex items-center justify-center text-gray-400">
            Chart Placeholder
          </div>
        </div>

        <div class="bg-white p-5 rounded shadow">
          <h3 class="font-semibold mb-4">Traffic</h3>
          <div class="h-64 flex items-center justify-center text-gray-400">
            Chart Placeholder
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="bg-white rounded shadow overflow-hidden">
        <div class="p-4 border-b font-semibold">Recent Users</div>

        <table class="w-full text-sm">
          <thead class="bg-gray-50 text-left">
            <tr>
              <th class="p-3">Name</th>
              <th>Email</th>
              <th>Status</th>
              <th class="text-right pr-4">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t">
              <td class="p-3">John Doe</td>
              <td>john@example.com</td>
              <td>
                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                  Active
                </span>
              </td>
              <td class="text-right pr-4">
                <button class="text-blue-600">Edit</button>
              </td>
            </tr>
            <tr class="border-t">
              <td class="p-3">Jane Smith</td>
              <td>jane@example.com</td>
              <td>
                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                  Pending
                </span>
              </td>
              <td class="text-right pr-4">
                <button class="text-blue-600">Edit</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  @yield('content')
    </main>

    <!-- Footer -->
    <footer class="h-12 bg-white border-t flex items-center justify-center text-sm text-gray-500">
      © 2026 Admin Dashboard
    </footer>

  </div>
</div>

<script>
 /*  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('hidden')
  } */
</script>

</body>
</html>
