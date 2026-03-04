<h2>Edit Admin</h2>

<form method="POST" action="{{ route('admin.admins.update',$admin) }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $admin->name }}">
    <input type="email" name="email" value="{{ $admin->email }}">
    <input type="password" name="password" placeholder="New Password (optional)">

    <select name="role">
        @foreach($roles as $role)
            <option value="{{ $role->name }}"
                {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Update</button>
</form>
