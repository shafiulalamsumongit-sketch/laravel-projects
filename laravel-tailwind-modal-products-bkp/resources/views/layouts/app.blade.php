<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ session('api_token') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-4">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <!-- Page Content -->
        <main class=''>
            {{ $slot }}
        </main>
        <!-- resources/views/layouts/partials/footer.blade.php -->
        <footer class="bg-white border-t border-gray-200">
            <div class="px-6 py-3 flex flex-col sm:flex-row items-center justify-between text-sm text-gray-600">
                <!-- Left -->
                <p>
                    © {{ date('Y') }}
                    <span class="font-medium text-gray-800">Admin Dashboard</span>.
                    All rights reserved.
                </p>
                <!-- Right -->
                <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                    <a href="#" class="hover:text-gray-900 transition">Docs</a>
                    <a href="#" class="hover:text-gray-900 transition">Support</a>
                    <a href="#" class="hover:text-gray-900 transition">Privacy</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
