<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Admin')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex flex-col min-h-screen">

    {{-- Top Header --}}
    <header class="bg-white shadow">
        <div class="flex justify-between items-center px-6 h-16">
            <div class="font-bold text-xl">AdminPanel</div>

            <div class="relative">
                <button class="flex items-center gap-2 focus:outline-none">
                    <span>Admin</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown --}}
                <div class="absolute right-0 mt-2 w-40 bg-white shadow rounded hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-gray-200">
            <nav class="p-4 space-y-2">
                <a href="#" class="block px-4 py-2 rounded bg-gray-800">Dashboard</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-800">Users</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-800">Settings</a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    <footer class="bg-white border-t">
        <div class="px-6 py-4 flex justify-between items-center text-sm text-gray-600">
            <span>© {{ date('Y') }} AdminPanel</span>
            <div class="flex gap-4">
                <a href="#" class="hover:text-blue-600">Privacy</a>
                <a href="#" class="hover:text-blue-600">Terms</a>
                <a href="#" class="hover:text-blue-600">Support</a>
            </div>
        </div>
    </footer>

</div>

</body>
</html>
