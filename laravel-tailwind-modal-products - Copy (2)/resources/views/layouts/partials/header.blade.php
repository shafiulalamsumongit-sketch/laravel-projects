<header class="h-16 bg-white border-b flex items-center justify-between px-6">
    <!-- Left -->
    <div class="flex items-center gap-4">
        <button
            @click="sidebarOpen=true"
            class="lg:hidden text-gray-600 hover:text-gray-900">
            ☰
        </button>

        <h1 class="text-lg font-semibold">
            Dashboard
        </h1>
    </div>

    <!-- Right -->
    <div class="flex items-center gap-4">
        <span class="text-sm text-gray-600">
            {{ auth()->user()->name ?? 'Admin' }}
        </span>

        <img
            class="h-8 w-8 rounded-full object-cover"
            src="https://ui-avatars.com/api/?name=Admin"
        />
    </div>
</header>
