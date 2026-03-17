<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }} Role : {{ auth('admin')->user()->getRoleNames()->first() }}
        </h2>
    </x-slot>

    <div class="m-8 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-4   bg-white p-16 overflow-hidden shadow-sm sm:rounded-lg">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-xl font-bold mb-4">{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h2>
        
        <form method="POST"
            action="{{ isset($role) ? route('admin.roles.update', $role) : route('admin.roles.store') }}">

            @csrf
            @if (isset($role))
                @method('PUT')
            @endif

            <input type="text" name="name" placeholder="Role Name" value="{{ old('name', $role->name ?? '') }}"
                class="border px-3 py-2 rounded w-full mb-4">

            <label class="font-semibold mb-2 block">Permissions:</label>
            <div class="grid grid-cols-3 gap-2 mb-4">
                @foreach ($permissions as $permission)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                            @if (isset($role) && $role->hasPermissionTo($permission->name)) checked @endif>
                        <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($role) ? 'Update Role' : 'Create Role' }}
            </button>
        </form>

    </div>



  
</x-app-layout>
