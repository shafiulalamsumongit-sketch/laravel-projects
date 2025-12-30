<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="d-flex">

    {{-- Sidebar --}}
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4 class="mb-4">Admin Panel</h4>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="#">
                    Users
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="#">
                    Roles
                </a>
            </li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="flex-grow-1 p-4">
        <nav class="navbar navbar-light bg-light mb-4">
            <span>Welcome, {{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </nav>

        @yield('content')
    </div>

</div>
</body>
</html>

</x-app-layout>
