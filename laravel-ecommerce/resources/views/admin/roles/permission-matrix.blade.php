<x-app-layout>

    <div class="m-8 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-4   bg-white p-16 overflow-hidden shadow-sm sm:rounded-lg">

        <h1 class="text-2xl font-bold mb-6">
            Role Permission Matrix : {{ $role->name }}
        </h1>

        <form method="POST" action="{{ route('admin.roles.permissions.update', $role) }}">

            @csrf

            <table class="w-full border">

                <thead class="bg-gray-100">
                    <tr>

                        <th class="p-3 text-left">Model</th>

                        <th class="p-3">View</th>
                        <th class="p-3">Create</th>
                        <th class="p-3">Edit</th>
                        <th class="p-3">Delete</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach ($permissions as $model => $perms)
                        <tr class="border-t">

                            <td class="p-3 font-semibold capitalize">

                                {{ $model }}

                            </td>

                            @foreach (['view', 'create', 'edit', 'delete'] as $action)
                                <td class="text-center">

                                    @php
                                        $permissionName = $model . '.' . $action;
                                    @endphp

                                    @if ($perms->contains('name', $permissionName))
                                        <input type="checkbox" name="permissions[]" value="{{ $permissionName }}"
                                            {{ $role->hasPermissionTo($permissionName) ? 'checked' : '' }}>
                                    @endif

                                </td>
                            @endforeach

                        </tr>
                    @endforeach

                </tbody>

            </table>

            <button class="bg-blue-600 text-white px-6 py-2 mt-4 rounded">

                Update Permissions

            </button>

        </form>

    </div>

</x-app-layout>
