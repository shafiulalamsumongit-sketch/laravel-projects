<header class="flex justify-between items-center bg-white dark:bg-gray-800 px-6 py-4 shadow">

    {{-- Mobile menu --}}
    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-700 dark:text-gray-200">
        ☰
    </button>

    <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
        {{ $title ?? 'Dashboard' }}
    </h1>

    <div class="flex items-center space-x-4">

        {{-- Dark mode --}}
        <button @click="darkMode = !darkMode"
                class="px-3 py-1 bg-indigo-500 text-white rounded">
            🌙
        </button>

        {{-- Notification --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="text-gray-700 dark:text-gray-200">
                🔔
            </button>

            <div x-show="open"
                 class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded shadow-lg">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                    New Order
                </a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                    New User
                </a>
            </div>
        </div>

        {{-- Profile --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="flex items-center space-x-2 text-gray-800 dark:text-white">
                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
            </button>

            <div x-show="open"
                 class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-700 rounded shadow-lg">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>


