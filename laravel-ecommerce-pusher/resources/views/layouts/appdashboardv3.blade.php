<!DOCTYPE html>
<html lang="en" 
      x-data="{ sidebarOpen: false, darkMode: false }" 
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 transition-all duration-300">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    @include('partials.adddashboard3.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Header --}}
        @include('partials.adddashboard3.header')

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.adddashboard3.footer')

    </div>

</div>

</body>
</html>

