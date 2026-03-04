<h2>Create Admin</h2>

<form method="POST" action="{{ route('admin.admins.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">

    <select name="role">
        @foreach($roles as $role)
            <option value="{{ $role->name }}">
                {{ $role->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Save</button>
</form>
