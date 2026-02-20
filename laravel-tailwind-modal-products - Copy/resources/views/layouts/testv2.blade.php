<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" class="h-full">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-gray-100 text-gray-800">
<div class="flex h-full">

    <!-- Mobile overlay -->
    <div
        x-show="sidebarOpen"
        x-transition
        @click="sidebarOpen=false"
        class="fixed inset-0 bg-black bg-opacity-40 z-20 lg:hidden">
    </div>

    <!-- Sidebar -->
    @include('layouts.partials.sidebar')

    <!-- Content area -->
    <div class="flex-1 flex flex-col min-w-0">
        @include('layouts.partials.header')

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>

</div>
</body>
</html>
