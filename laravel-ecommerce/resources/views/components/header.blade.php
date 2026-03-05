<header class="bg-white shadow px-6 py-4 flex justify-between items-center">

    <!-- Search -->
    <div class="flex items-center bg-gray-100 px-3 py-2 rounded-lg w-96">
        <input type="text" placeholder="Search..."
               class="bg-transparent outline-none w-full">
    </div>

    <!-- Right -->
    <div class="flex items-center space-x-6">

        <!-- Notification -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open">
                🔔
            </button>

            <div x-show="open"
                 class="absolute right-0 mt-2 w-60 bg-white shadow-lg rounded-lg p-4">
                <p class="text-sm">New order received</p>
                <p class="text-sm">New user registered</p>
            </div>
        </div>

        <!-- Profile -->
        <div class="flex items-center space-x-2">
            <img src="https://i.pravatar.cc/40"
                 class="w-10 h-10 rounded-full">
            <span class="font-medium">Admin</span>
        </div>

    </div>
</header>
