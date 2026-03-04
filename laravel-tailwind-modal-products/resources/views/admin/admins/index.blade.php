<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard Role : ') }} {{ auth('admin')->user()->getRoleNames()->first() }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Admin Users</h1>
            <a href="{{ route('admin.admins.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Create Admin
            </a>
        </div>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Role
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @forelse($admins as $admin)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">
                                    {{ $admin->name }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $admin->email }}
                            </td>

                            <td class="px-6 py-4">
                                @foreach ($admin->roles as $role)
                                    <span class="bg-indigo-100 text-indigo-700 px-2 py-1 text-xs rounded-full">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>

                            <td class="px-6 py-4 text-right space-x-2">

                                <a href="{{ route('admin.admins.edit', $admin) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Edit
                                </a>

                                @if (!$admin->hasRole('super_admin'))
                                    <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Are you sure?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Delete
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                No admins found
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $admins->links() }}
        </div>
    </div>
</x-app-layout>
