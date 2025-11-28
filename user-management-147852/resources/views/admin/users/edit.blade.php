<x-guest-layout>
<div class="container mx-auto max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border rounded px-3 py-2">
            @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border rounded px-3 py-2">
            @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">
                Password (leave blank to keep)
            </label>
            <input type="password" name="password"
                   class="w-full border rounded px-3 py-2">
            @error('password')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Roles</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($roles as $id => $name)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="roles[]" value="{{ $name }}"
                               @checked(in_array($name, $userRoleIds))
                               class="mr-2">
                        <span>{{ $name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>

</x-guest-layout>
