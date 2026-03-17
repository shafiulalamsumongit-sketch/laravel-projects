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


    <div class="flex flex-1">

        {{-- Sidebar --}}


        {{-- Main Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    

</div>

</body>
</html>
