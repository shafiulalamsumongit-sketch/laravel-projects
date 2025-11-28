<x-guest-layout>
<div class="container mx-auto">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Users</h1>
        <a href="{{ route('admin.users.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + New User
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Roles</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="px-4 py-2 border">{{ $user->id }}</td>
                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}
 <a href="{{ route('admin.users.edit', $user) }}"
                           class="text-blue-600">Edit</a>

                        <form action="{{ route('admin.users.destroy', $user) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 ml-2">
                                Delete
                            </button>
                        </form>





                    </td>
                    <td class="px-4 py-2 border">




                        {{ $user->roles->pluck('name')->join(', ') ?: '-' }}
                    </td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="text-blue-600">Edit</a>

                        <form action="{{ route('admin.users.destroy', $user) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 ml-2">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
</x-guest-layout>
