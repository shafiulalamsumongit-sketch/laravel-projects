<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Permissions</h1>
        <a href="{{ route('admin.permissions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Permission
        </a>
        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            <input type="text" name="name" class="border p-2 w-full" placeholder="Permission Name">
            <button class="bg-green-500 text-white px-4 py-2 mt-3">
                Save
            </button>
        </form>
    </div>
</x-app-layout>
