<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role & Permission Matrix') }} Role : {{ auth('admin')->user()->getRoleNames()->first() }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-4">

        <div class="p-6">

            <h1 class="text-2xl font-bold mb-6">Role & Permission Matrix</h1>

            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.roles.permissions.update') }}">
                @csrf

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 border">Role / Permission</th>
                                @foreach ($permissions as $permission)
                                    <th class="px-4 py-2 border text-center">{{ $permission->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border font-medium">{{ $role->name }}</td>
                                    @foreach ($permissions as $permission)
                                        <td class="px-4 py-2 border text-center">
                                            @if ($role->name != 'super_admin')
                                                <input type="checkbox" name="permissions[{{ $role->name }}][]"
                                                    value="{{ $permission->name }}"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            @else
                                                <span class="text-gray-400">✔</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Permissions
                </button>
            </form>

        </div>
</x-app-layout>
