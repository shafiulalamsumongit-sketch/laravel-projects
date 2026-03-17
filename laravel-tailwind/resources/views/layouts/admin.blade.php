<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VueMart Admin — @yield('title', 'Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen overflow-hidden">
    <aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0">
        <div class="p-6 border-b border-gray-700">
            <h1 class="text-2xl font-bold text-blue-400">VueMart</h1>
            <p class="text-gray-400 text-sm">Admin Panel</p>
        </div>
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white' : '' }}">
                <i class="fa-solid fa-gauge w-5 text-center"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.products*') ? 'bg-blue-700 text-white' : '' }}">
                <i class="fa-solid fa-box w-5 text-center"></i><span>Products</span>
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.categories*') ? 'bg-blue-700 text-white' : '' }}">
                <i class="fa-solid fa-folder w-5 text-center"></i><span>Categories</span>
            </a>
            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.orders*') ? 'bg-blue-700 text-white' : '' }}">
                <i class="fa-solid fa-cart-shopping w-5 text-center"></i><span>Orders</span>
            </a>
            <a href="{{ route('admin.customers.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.customers*') ? 'bg-blue-700 text-white' : '' }}">
                <i class="fa-solid fa-users w-5 text-center"></i><span>Customers</span>
            </a>
            <a href="{{ route('admin.reviews.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.reviews*') ? 'bg-blue-700 text-white' : '' }}">
                <i class="fa-solid fa-star w-5 text-center"></i><span>Reviews</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center gap-3 mb-3 px-2">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-sm font-bold">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="w-full flex items-center gap-2 px-4 py-2 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white text-sm">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between flex-shrink-0">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                @hasSection('breadcrumb')
                    <nav class="text-sm text-gray-500 mt-1">@yield('breadcrumb')</nav>
                @endif
            </div>
            <a href="{{ config('app.frontend_url', 'http://localhost:5173') }}" target="_blank"
               class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i> View Store
            </a>
        </header>
        <main class="flex-1 overflow-y-auto p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
