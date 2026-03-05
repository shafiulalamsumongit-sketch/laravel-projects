<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

<div x-data="{ sidebarOpen: true }" class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <x-header />

        <!-- Content -->
        <main class="p-6 overflow-y-auto">
            {{ $slot }}
        </main>

    </div>
</div>

</body>
</html>
