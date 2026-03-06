<x-app-layout>
    <div class="m-8 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-4 bg-white shadow rounded-xl overflow-hidden">
        <h1 class="text-2xl font-bold mb-4">Permissions</h1>
        <a href="{{ route('admin.permissions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Permission
        </a>
        <table class="w-full mt-4 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">ID</th>
                    <th class="p-2">Name</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr class="border-t">
                        <td class="p-2">{{ $permission->id }}</td>
                        <td class="p-2">{{ $permission->name }}</td>
                        <td class="p-2 flex gap-2">
                            <a href="{{ route('admin.permissions.edit', $permission) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
