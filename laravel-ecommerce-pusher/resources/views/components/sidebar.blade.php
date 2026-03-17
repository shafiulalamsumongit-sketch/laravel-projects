<div
    x-data="{
        open: localStorage.getItem('sidebar') === 'true',
        toggle() {
            this.open = !this.open
            localStorage.setItem('sidebar', this.open)
        }
    }"
    :class="open ? 'w-64' : 'w-20'"
    class="h-screen bg-white dark:bg-gray-900 shadow-lg transition-all duration-300 flex flex-col border-r border-gray-200 dark:border-gray-800"
>

    <!-- Logo -->
    <div class="flex items-center justify-between px-6 py-5">
        <div class="flex items-center space-x-2">
           
            <span x-show="open" class="text-xl font-bold text-gray-800 dark:text-white">
                TailAdmin
            </span>
        </div>

        <button @click="toggle()" class="text-gray-500 hover:text-indigo-600">
            ☰
        </button>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">

        <p x-show="open"
           class="text-xs font-semibold text-gray-400 uppercase mt-4 mb-2">
            Menu
        </p>

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="group flex items-center px-3 py-2 rounded-lg transition
           {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800' }}">

            <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>

            <span x-show="open" class="ml-3">Dashboard</span>

            <!-- Tooltip -->
            <span x-show="!open"
                  class="absolute left-16 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100">
                Dashboard
            </span>
        </a>

{{-- Products Dropdown --}}
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full flex items-center p-2 rounded hover:bg-gray-800">

                <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>

                <span x-show="sidebarOpen" class="ml-3 flex-1 text-left">Products</span>

                <svg x-show="sidebarOpen"
                    :class="{'rotate-180': open}"
                    class="w-4 h-4 transition-transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open && sidebarOpen"
                x-transition
                class="ml-8 mt-2 space-y-1">

                <a href="#" class="block p-2 rounded hover:bg-gray-800">
                    All Products
                </a>

                <a href="#" class="block p-2 rounded hover:bg-gray-800">
                    Add Product
                </a>
            </div>
        </div>

        <!-- Ecommerce Dropdown -->
        <div x-data="{ dropdown: true }">

            <button @click="dropdown = !dropdown"
                class="group w-full flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">

                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                   
                    <span x-show="open" class="ml-3 flex-1 text-left">Ecommerce</span>
                </div>

                <svg x-show="sidebarOpen"
                    :class="{'rotate-180': open}"
                    class="w-4 h-4 transition-transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="dropdown && open"
                 x-transition
                 class="ml-8 mt-1 space-y-1">

                <a href="#"
                   class="block text-sm text-gray-600 hover:text-indigo-600">
                    Analytics
                </a>

                <a href="#"
                   class="block text-sm text-gray-600 hover:text-indigo-600">
                    Marketing
                </a>

                <a href="#"
                   class="block text-sm text-gray-600 hover:text-indigo-600">
                    CRM
                </a>
            </div>
        </div>

        <!-- Stocks with NEW badge -->
        <a href="#"
           class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">

            <div class="flex items-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor">
                    <path stroke-width="2" d="M5 12h14"/>
                </svg>
                <span x-show="open" class="ml-3">Stocks</span>
            </div>

            <span x-show="open"
                  class="text-xs bg-indigo-100 text-indigo-600 px-2 py-0.5 rounded-full">
                NEW
            </span>
        </a>

        <!-- SaaS -->
        <a href="#"
           class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">

            <div class="flex items-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor">
                    <path stroke-width="2" d="M3 3h18v18H3z"/>
                </svg>
                <span x-show="open" class="ml-3">SaaS</span>
            </div>

            <span x-show="open"
                  class="text-xs bg-indigo-100 text-indigo-600 px-2 py-0.5 rounded-full">
                NEW
            </span>
        </a>

        <!-- Support -->
        <p x-show="open"
           class="text-xs font-semibold text-gray-400 uppercase mt-6 mb-2">
            Support
        </p>

        <a href="#"
           class="flex items-center px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            <span x-show="open" class="ml-3">Chat</span>
        </a>

        <a href="#"
           class="flex items-center px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
            <span x-show="open" class="ml-3">Email</span>
        </a>

    </nav>

</div>
