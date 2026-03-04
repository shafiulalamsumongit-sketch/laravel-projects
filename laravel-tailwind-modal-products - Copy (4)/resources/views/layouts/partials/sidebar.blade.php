<aside
    x-show="sidebarOpen || window.innerWidth >= 1024"
    x-transition
    class="fixed lg:static z-30 w-64 h-full
           bg-white border-r border-gray-200
           flex flex-col"
>
    <!-- Brand -->
    <div class="h-16 flex items-center px-6 border-b">
        <span class="text-xl font-bold text-indigo-600">
            Enterprise
        </span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
        @php
            $menu = [
                ['route'=>'dashboard','label'=>'Dashboard','icon'=>'🏠'],
                ['route'=>'users-index','label'=>'Users','icon'=>'👥'],
                ['route'=>'users-index','label'=>'Products','icon'=>'📦'],
                ['route'=>'users-index','label'=>'Reports','icon'=>'📊'],
                ['route'=>'users-index','label'=>'Settings','icon'=>'⚙️'],
            ];
        @endphp

        @foreach($menu as $item)
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
               {{ request()->routeIs($item['route'].'*')
                   ? 'bg-indigo-50 text-indigo-600 font-medium'
                   : 'text-gray-700 hover:bg-gray-100' }}">
                <span class="text-lg">{{ $item['icon'] }}</span>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</aside>
