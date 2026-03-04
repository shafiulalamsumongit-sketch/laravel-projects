<aside 
    class="bg-white dark:bg-gray-800 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform 
           md:relative md:translate-x-0 transition duration-200 ease-in-out"
    :class="{ '-translate-x-full': !sidebarOpen }"
>

    <div class="text-2xl font-bold text-center text-indigo-600">
        Laravel Admin
    </div>

    <nav class="mt-6">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 mt-2 rounded transition
           {{ request()->routeIs('dashboard') ? 'bg-indigo-500 text-white' : 'text-gray-700 dark:text-gray-200 hover:bg-indigo-500 hover:text-white' }}">
            Dashboard
        </a>

        {{-- Dropdown Menu --}}
        <div x-data="{ open: false }">

            <button @click="open = !open"
                class="w-full flex justify-between items-center px-4 py-2 mt-2 rounded
                text-gray-700 dark:text-gray-200 hover:bg-indigo-500 hover:text-white">
                Products
                <span>▼</span>
            </button>

            <div x-show="open" class="ml-4 mt-2 space-y-2">
                <a href="#" class="block px-4 py-2 hover:bg-indigo-500 hover:text-white rounded">
                    All Products
                </a>
                <a href="#" class="block px-4 py-2 hover:bg-indigo-500 hover:text-white rounded">
                    Add Product
                </a>
            </div>

        </div>

        <a href="#"
           class="block px-4 py-2 mt-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-500 hover:text-white rounded">
            Users
        </a>

    </nav>

</aside>

