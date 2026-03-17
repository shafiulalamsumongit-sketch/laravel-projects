<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Admin') }} Role : {{ auth('admin')->user()->getRoleNames()->first() }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-4">
        <h2>Edit Admin</h2>
        <form method="POST" action="{{ route('admin.admins.update', $admin) }}">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $admin->name }}">
            <input type="email" name="email" value="{{ $admin->email }}">
            <input type="password" name="password" placeholder="New Password (optional)">
            <select name="role">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <button class='"bg-blue-600 text-white px-4 py-2 rounded-lg ' type="submit">Update</button>
        </form>
    </div>
</x-app-layout>