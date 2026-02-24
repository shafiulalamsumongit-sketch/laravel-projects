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
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

{{-- ================= TOP MENU ================= --}}
<header class="bg-white shadow h-16 flex items-center px-6">
    <div class="flex justify-between w-full items-center">
        <span class="font-bold text-lg">AdminPanel</span>

        <div class="relative">
            <button class="flex items-center gap-2">
                Admin
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>
    </div>
</header>

{{-- ================= ASIDE + MAIN WRAPPER ================= --}}
<div class="flex flex-1">

   
<aside class="w-64 bg-white shadow-lg hidden md:flex flex-col">
    
    {{-- Logo --}}
    <div class="h-16 flex items-center justify-center border-b">
        <span class="text-xl font-bold text-indigo-600">
            AdminPanel
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


    {{-- ===== Main Content ===== --}}
    <main class="flex-1 p-6 overflow-y-auto">
        @yield('content')
    </main>

</div>

{{-- ================= FOOTER ================= --}}
<footer class="bg-white border-t h-14 flex items-center px-6 text-sm text-gray-600">
    <div class="flex justify-between w-full">
        <span>© {{ date('Y') }} AdminPanel</span>
        <div class="flex gap-4">
            <a href="#" class="hover:text-blue-600">Privacy</a>
            <a href="#" class="hover:text-blue-600">Terms</a>
            <a href="#" class="hover:text-blue-600">Support</a>
        </div>
    </div>
</footer>

</body>
</html>
